<?php
/**
 * Enquiry forms: demo requests, contact, request access and password help.
 *
 * Pipeline: CSRF check → honeypot → minimum fill time → per-IP rate limit →
 * server-side validation → store (MySQL via PDO if configured, otherwise an
 * append-only JSONL file outside public access) → optional email
 * notification → Post/Redirect/Get with a one-time flash message.
 */
declare(strict_types=1);

function acad_form_options(): array
{
    return [
        'roles' => ['Leadership / Management', 'Admissions', 'Academic Administration', 'Faculty', 'IT / Technology', 'Finance', 'Student Services', 'Partner / Vendor', 'Other'],
        'org_types' => ['University', 'College', 'Higher education group / Multi-campus', 'Professional / Continuing education', 'Online education provider', 'School', 'EdTech / Partner organisation', 'Other'],
        'enquiry_interests' => ['Academic Management', 'Admissions & CRM', 'Student Management', 'AI & Analytics', 'Cloud Platform', 'Integrations', 'Partnership', 'Other'],
        'interests' => ['Full platform', 'Admissions & CRM', 'Student management', 'Academic operations', 'Finance & fees', 'Communication', 'Analytics & AI', 'Integrations'],
        'topics' => [
            'sales'         => 'Product & sales',
            'support'       => 'Customer support',
            'partnership'   => 'Partnerships',
            'press'         => 'Press & media',
            'careers'       => 'Careers',
            'privacy'       => 'Privacy / Data Protection Officer',
            'grievance'     => 'Grievance redressal',
            'accessibility' => 'Accessibility',
            'other'         => 'Something else',
        ],
    ];
}

/** Field specs per form: [label, type, required, autocomplete, extra]. */
function acad_form_spec(string $form): array
{
    $o = acad_form_options();
    $common = [
        'name'        => ['Full name', 'text', true, 'name', ['max' => 120]],
        'email'       => ['Work email', 'email', true, 'email', ['max' => 190]],
        'phone'       => ['Phone', 'tel', false, 'tel', ['max' => 30]],
        'institution' => ['Institution / organisation', 'text', true, 'organization', ['max' => 190]],
    ];
    return match ($form) {
        'demo' => $common + [
            'role'     => ['Your role', 'select', true, 'organization-title', ['options' => $o['roles']]],
            'country'  => ['Country', 'text', true, 'country-name', ['max' => 80]],
            'org_type' => ['Institution type', 'select', true, 'off', ['options' => $o['org_types']]],
            'interest' => ['Primary interest', 'select', false, 'off', ['options' => $o['interests']]],
            'message'  => ['What would you like to see?', 'textarea', false, 'off', ['max' => 3000, 'hint' => 'Current systems, team size, timelines or specific workflows.']],
            'consent'  => ['I agree that Acadlytic may contact me about this request, as described in the Privacy Policy.', 'checkbox', true, 'off', []],
        ],
        'contact' => [
            'name'        => $common['name'],
            'email'       => ['Email', 'email', true, 'email', ['max' => 190]],
            'phone'       => $common['phone'],
            'institution' => ['Organisation', 'text', false, 'organization', ['max' => 190]],
            'topic'       => ['Topic', 'select', true, 'off', ['options' => $o['topics']]],
            'message'     => ['Message', 'textarea', true, 'off', ['max' => 4000]],
            'consent'     => ['I agree that Acadlytic may use these details to respond, as described in the Privacy Policy.', 'checkbox', true, 'off', []],
        ],
        'access' => [
            'name'        => $common['name'],
            'email'       => $common['email'],
            'institution' => ['Institution', 'text', true, 'organization', ['max' => 190]],
            'designation' => ['Designation', 'text', true, 'organization-title', ['max' => 120]],
            'phone'       => ['Phone', 'tel', true, 'tel', ['max' => 30]],
            'country'     => ['Country', 'text', true, 'country-name', ['max' => 80]],
            'org_type'    => ['Organization type', 'select', true, 'off', ['options' => $o['org_types']]],
            'message'     => ['Message', 'textarea', false, 'off', ['max' => 3000, 'hint' => 'Which workspace you need and who invited you, if applicable.']],
            'consent'     => ['I agree that Acadlytic may contact me about this request, as described in the Privacy Policy.', 'checkbox', true, 'off', []],
        ],
        'reset' => [
            'email' => ['Work email', 'email', true, 'email', ['max' => 190]],
        ],
        'enquiry' => [
            'name'        => ['Full name', 'text', true, 'name', ['max' => 120]],
            'email'       => ['Work email', 'email', true, 'email', ['max' => 190, 'required_msg' => 'Please enter your work email address.', 'invalid_msg' => 'Please enter a valid work email address.']],
            'institution' => ['Institution / Organization', 'text', false, 'organization', ['max' => 190]],
            'designation' => ['Designation', 'text', false, 'organization-title', ['max' => 120]],
            'phone'       => ['Phone number', 'tel', false, 'tel', ['max' => 30]],
            'interest'    => ['What are you interested in?', 'select', false, 'off', ['options' => $o['enquiry_interests']]],
            'message'     => ['Message', 'textarea', false, 'off', ['max' => 3000]],
            'consent'     => ['I agree to be contacted by Acadlytic regarding my enquiry.', 'checkbox', true, 'off', []],
        ],
        default => throw new InvalidArgumentException("Unknown form {$form}"),
    };
}

/** Signed render timestamp; lets us reject instant bot submissions without JS. */
function acad_form_ts_field(): string
{
    $ts = (string) time();
    return '<input type="hidden" name="_ts" value="' . $ts . '.' . substr(hash_hmac('sha256', $ts, acad_secret('ts')), 0, 16) . '">';
}

/** Returns 'ok', 'fast' (likely a bot) or 'stale' (tampered or older than a day). */
function acad_form_ts_check(string $value): string
{
    [$ts, $sig] = array_pad(explode('.', $value, 2), 2, '');
    if (!ctype_digit($ts) || !hash_equals(substr(hash_hmac('sha256', $ts, acad_secret('ts')), 0, 16), $sig)) {
        return 'stale';
    }
    $age = time() - (int) $ts;
    if ($age < (int) acad_config('forms.min_fill_secs')) {
        return 'fast';
    }
    return $age < 86400 ? 'ok' : 'stale';
}

/**
 * Validate and process a submission without producing output.
 * Returns ['result' => 'ok'|'bot'|'error', 'status' => int, 'errors' => [],
 * 'form_error' => ?string, 'old' => []]. Shared by page forms (PRG) and the
 * enquiry widget (JSON).
 */
function acad_process_form(string $form): array
{
    $spec = acad_form_spec($form);
    $old = [];
    $errors = [];

    if (!acad_csrf_valid($_POST['_token'] ?? null)) {
        return ['result' => 'error', 'status' => 419, 'form_error' => 'Your session expired. Please submit the form again.', 'old' => acad_form_old($spec)];
    }
    // Honeypot and instant submissions: real people never trigger these.
    $timing = acad_form_ts_check((string) ($_POST['_ts'] ?? ''));
    if (trim((string) ($_POST['website'] ?? '')) !== '' || $timing === 'fast') {
        return ['result' => 'bot', 'status' => 200]; // silently accept to avoid teaching bots
    }
    if ($timing === 'stale') {
        return ['result' => 'error', 'status' => 422, 'form_error' => 'This form was open for a long time. Please review and submit it again.', 'old' => acad_form_old($spec)];
    }
    $limit = acad_config('forms.rate_limit');
    if (!acad_rate_limit('form:' . $form, acad_client_fingerprint(), (int) $limit['max'], (int) $limit['window'])) {
        return ['result' => 'error', 'status' => 429, 'form_error' => 'Too many submissions from this connection. Please try again later or email ' . acad_config('email') . '.', 'old' => acad_form_old($spec)];
    }

    foreach ($spec as $name => [$label, $type, $required, , $extra]) {
        $raw = $_POST[$name] ?? '';
        $value = is_string($raw) ? trim(str_replace("\0", '', $raw)) : '';
        if ($type === 'checkbox') {
            $value = $value !== '' ? 'yes' : '';
        }
        if ($type !== 'textarea') {
            $value = preg_replace('/\s+/u', ' ', $value) ?? '';
        }
        $old[$name] = $value;

        if ($required && $value === '') {
            $errors[$name] = $type === 'checkbox'
                ? 'Please confirm to continue.'
                : ($extra['required_msg'] ?? 'Please enter your ' . strtolower(trim((string) strtok($label, '/('))) . '.');
            continue;
        }
        if ($value === '') {
            continue;
        }
        if (isset($extra['max']) && mb_strlen($value) > $extra['max']) {
            $errors[$name] = "Please keep this under {$extra['max']} characters.";
        } elseif ($type === 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $errors[$name] = $extra['invalid_msg'] ?? 'Please enter a valid email address, like name@institution.edu.';
        } elseif ($type === 'tel' && !preg_match('/^\+?[0-9 ()\-]{7,20}$/', $value)) {
            $errors[$name] = 'Please enter a valid phone number, including country code if outside India.';
        } elseif ($type === 'select') {
            $options = $extra['options'];
            $valid = array_is_list($options) ? in_array($value, $options, true) : array_key_exists($value, $options);
            if (!$valid) {
                $errors[$name] = 'Please choose one of the listed options.';
            }
        }
    }

    if ($errors) {
        return ['result' => 'error', 'status' => 422, 'errors' => $errors, 'old' => $old];
    }

    $stored = acad_store_enquiry($form, $old);
    $mailed = acad_notify_enquiry($form, $old);
    if (!$stored && !$mailed) {
        error_log('Acadlytic enquiry LOST: storage and mail both failed for form ' . $form);
        return ['result' => 'error', 'status' => 503, 'form_error' => 'We couldn’t submit your enquiry right now. Please try again, or contact us by email or WhatsApp.', 'old' => $old];
    }
    return ['result' => 'ok', 'status' => 200];
}

/**
 * Page forms: process, then Post/Redirect/Get with a one-time flash on
 * success. On failure returns render context (errors, old input, status).
 */
function acad_handle_form(string $form, string $returnPath): array
{
    $r = acad_process_form($form);
    if ($r['result'] === 'error') {
        return $r;
    }
    acad_flash_set('sent_' . $form, true);
    acad_redirect($returnPath . '?sent=1#form');
}

function acad_form_old(array $spec): array
{
    $old = [];
    foreach (array_keys($spec) as $name) {
        $old[$name] = is_string($_POST[$name] ?? null) ? trim((string) $_POST[$name]) : '';
    }
    return $old;
}

/** Returns true when the enquiry was durably stored (database or file). */
function acad_store_enquiry(string $form, array $data): bool
{
    $record = [
        'type'       => $form,
        'data'       => $data,
        // Widget submissions post to /enquiry/; record the page they came from.
        'page'       => (is_string($_POST['_page'] ?? null) && preg_match('#^/[a-z0-9/._-]{0,200}$#', $_POST['_page'])) ? $_POST['_page'] : acad_request_path(),
        'ip_hash'    => acad_client_fingerprint(),
        'user_agent' => mb_substr((string) ($_SERVER['HTTP_USER_AGENT'] ?? ''), 0, 255),
        'created_at' => date('c'),
    ];
    $db = acad_db();
    if ($db) {
        try {
            $stmt = $db->prepare('INSERT INTO enquiries (type, email, payload, page, ip_hash, user_agent, created_at) VALUES (:type, :email, :payload, :page, :ip, :ua, NOW())');
            $stmt->execute([
                ':type'    => $form,
                ':email'   => $data['email'] ?? '',
                ':payload' => json_encode($data, JSON_UNESCAPED_UNICODE),
                ':page'    => $record['page'],
                ':ip'      => $record['ip_hash'],
                ':ua'      => $record['user_agent'],
            ]);
            return true;
        } catch (PDOException $ex) {
            error_log('Acadlytic enquiry insert failed, falling back to file: ' . $ex->getMessage());
        }
    }
    $file = acad_storage_path('enquiries') . '/' . date('Y-m') . '.jsonl';
    $new = !is_file($file);
    $ok = @file_put_contents($file, json_encode($record, JSON_UNESCAPED_UNICODE) . "\n", FILE_APPEND | LOCK_EX) !== false;
    if (!$ok) {
        error_log('Acadlytic enquiry could not be written to ' . $file . ' (check storage_path permissions)');
    } elseif ($new) {
        @chmod($file, 0600);
    }
    return $ok;
}

/** Returns true when a notification email was handed to the mail system. */
function acad_notify_enquiry(string $form, array $data): bool
{
    if (!acad_config('forms.send_mail') || !function_exists('mail')) {
        return false;
    }
    $labels = ['demo' => 'Demo request', 'contact' => 'Contact enquiry', 'access' => 'Access request', 'reset' => 'Password help request', 'enquiry' => 'Website enquiry (Enquire Now)'];
    $clean = static fn(string $v): string => str_replace(["\r", "\n"], ' ', $v);
    $subject = '[Acadlytic website] ' . ($labels[$form] ?? 'Enquiry') . (isset($data['institution']) && $data['institution'] !== '' ? ' — ' . $clean($data['institution']) : '');
    $body = ($labels[$form] ?? 'Enquiry') . " received " . date('Y-m-d H:i T') . "\n\n";
    foreach ($data as $key => $value) {
        $body .= str_pad(ucfirst(str_replace('_', ' ', $key)) . ':', 14) . $value . "\n";
    }
    $headers = [
        'From: Acadlytic Website <' . $clean((string) acad_config('forms.mail_from')) . '>',
        'Content-Type: text/plain; charset=UTF-8',
    ];
    if (!empty($data['email']) && filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $headers[] = 'Reply-To: ' . $clean($data['email']);
    }
    $encodedSubject = '=?UTF-8?B?' . base64_encode($subject) . '?=';
    // Privacy and grievance enquiries also reach the designated officer directly.
    $to = [(string) acad_config('forms.notify_email')];
    $officer = ['privacy' => 'dpo', 'grievance' => 'grievance'][$data['topic'] ?? ''] ?? null;
    if ($officer !== null && filter_var((string) acad_config("governance.{$officer}.email"), FILTER_VALIDATE_EMAIL)) {
        $to[] = (string) acad_config("governance.{$officer}.email");
    }
    $sent = @mail(implode(', ', array_unique($to)), $encodedSubject, $body, implode("\r\n", $headers));
    if (!$sent) {
        error_log('Acadlytic enquiry notification mail() failed for form ' . $form);
    }
    return $sent;
}

function acad_flash_set(string $key, mixed $value): void
{
    acad_session_start();
    $_SESSION['_flash'][$key] = $value;
}

function acad_flash_take(string $key): mixed
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        return null;
    }
    $value = $_SESSION['_flash'][$key] ?? null;
    unset($_SESSION['_flash'][$key]);
    return $value;
}

/**
 * Render a form from its spec. Errors are linked to fields with
 * aria-describedby; an error summary receives focus via app.js.
 */
function acad_render_form(string $form, array $ctx, string $submitLabel, array $prefill = [], bool $sessionTokens = true): string
{
    $spec = acad_form_spec($form);
    $old = ($ctx['old'] ?? []) + $prefill;
    $errors = $ctx['errors'] ?? [];
    $html = '<form class="form" method="post" action="" novalidate data-enhance="form">';
    // Pages that are publicly cached must not embed a session token; the
    // enquiry widget fetches one from /enquiry/token/ when it opens.
    $html .= $sessionTokens ? acad_csrf_field() . acad_form_ts_field() : '<input type="hidden" name="_token" value=""><input type="hidden" name="_ts" value="">';
    $html .= '<div class="hp" aria-hidden="true"><label for="' . $form . '-website">Website</label><input type="text" id="' . $form . '-website" name="website" tabindex="-1" autocomplete="off"></div>';

    if (!empty($ctx['form_error'])) {
        $html .= '<div class="form-alert error" role="alert">' . e($ctx['form_error']) . '</div>';
    }
    if ($errors) {
        $html .= '<div class="form-alert error" role="alert" tabindex="-1" data-error-summary><strong>Please correct ' . count($errors) . ' field' . (count($errors) > 1 ? 's' : '') . ':</strong><ul>';
        foreach ($errors as $name => $msg) {
            $html .= '<li><a href="#' . $form . '-' . $name . '">' . e($spec[$name][0]) . '</a></li>';
        }
        $html .= '</ul></div>';
    }

    $html .= '<div class="form-grid">';
    foreach ($spec as $name => [$label, $type, $required, $autocomplete, $extra]) {
        $id = $form . '-' . $name;
        $value = (string) ($old[$name] ?? '');
        $err = $errors[$name] ?? null;
        $describedBy = [];
        if (!empty($extra['hint'])) {
            $describedBy[] = $id . '-hint';
        }
        if ($err) {
            $describedBy[] = $id . '-error';
        }
        $aria = ($err ? ' aria-invalid="true"' : '') . ($describedBy ? ' aria-describedby="' . implode(' ', $describedBy) . '"' : '');
        $req = $required ? ' required aria-required="true"' : '';
        // Same human-friendly wording for client-side and server-side checks.
        if ($required) {
            $msg = $type === 'checkbox' ? 'Please confirm to continue.' : ($extra['required_msg'] ?? 'Please enter your ' . strtolower(trim((string) strtok($label, '/('))) . '.');
            $req .= ' data-required-msg="' . e($msg) . '"';
        }
        if ($type === 'email') {
            $req .= ' data-invalid-msg="' . e($extra['invalid_msg'] ?? 'Please enter a valid email address, like name@institution.edu.') . '"';
        }
        $wide = in_array($type, ['textarea', 'checkbox'], true) || $form === 'reset' ? ' field-wide' : '';
        $html .= '<div class="field' . $wide . ($err ? ' has-error' : '') . '">';

        if ($type === 'checkbox') {
            $labelHtml = str_replace('Privacy Policy', '<a href="/trust/privacy/">Privacy Policy</a>', e($label));
            $html .= '<label class="check-label" for="' . $id . '"><input type="checkbox" id="' . $id . '" name="' . $name . '" value="yes"' . ($value !== '' ? ' checked' : '') . $req . $aria . '><span>'
                . $labelHtml . '</span></label>';
        } else {
            $html .= '<label for="' . $id . '">' . e($label) . ($required ? ' <span class="req" aria-hidden="true">*</span>' : ' <span class="optional">(optional)</span>') . '</label>';
            if ($type === 'select') {
                $html .= '<select id="' . $id . '" name="' . $name . '"' . $req . $aria . '><option value="">Select…</option>';
                foreach ($extra['options'] as $k => $opt) {
                    $optValue = array_is_list($extra['options']) ? $opt : $k;
                    $html .= '<option value="' . e($optValue) . '"' . ($optValue === $value ? ' selected' : '') . '>' . e($opt) . '</option>';
                }
                $html .= '</select>';
            } elseif ($type === 'textarea') {
                $html .= '<textarea id="' . $id . '" name="' . $name . '" rows="4" maxlength="' . (int) $extra['max'] . '"' . $req . $aria . '>' . e($value) . '</textarea>';
            } else {
                $mode = $type === 'email' ? ' inputmode="email" autocapitalize="off" spellcheck="false"' : ($type === 'tel' ? ' inputmode="tel"' : '');
                $html .= '<input type="' . $type . '" id="' . $id . '" name="' . $name . '" value="' . e($value) . '" autocomplete="' . e($autocomplete) . '" maxlength="' . (int) ($extra['max'] ?? 190) . '"' . $mode . $req . $aria . '>';
            }
            if (!empty($extra['hint'])) {
                $html .= '<p class="field-hint" id="' . $id . '-hint">' . e($extra['hint']) . '</p>';
            }
        }
        if ($err) {
            $html .= '<p class="field-error" id="' . $id . '-error">' . e($err) . '</p>';
        }
        $html .= '</div>';
    }
    $html .= '</div><div class="form-actions"><button type="submit" class="btn btn-primary btn-lg" data-loading-text="Sending…">'
        . e($submitLabel) . ' ' . icon('arrow') . '</button></div></form>';
    return $html;
}
