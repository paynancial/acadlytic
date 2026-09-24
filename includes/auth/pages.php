<?php
/**
 * Controllers for the standalone auth pages: /login.php (and /login/),
 * /forgot-password.php and /request-access.php.
 *
 * Credentials are only ever sent by POST over the session-bound, CSRF-
 * protected form; they are never logged, stored or echoed back.
 */
declare(strict_types=1);

function acad_auth_page(string $kind): never
{
    $page = acad_page('/' . $kind . '.php');
    acad_session_start();
    $ctx = [];

    if ($kind === 'login') {
        if (acad_is_post()) {
            $ctx = acad_handle_login();
        }
        $panel = acad_login_panel($ctx);
    } else {
        $form = $kind === 'forgot-password' ? 'reset' : 'access';
        if (acad_is_post()) {
            $ctx = acad_handle_form($form, '/' . $kind . '.php');
        }
        $ctx['sent'] = acad_flash_take('sent_' . $form);
        $panel = $kind === 'forgot-password' ? acad_forgot_panel($ctx) : acad_access_panel($ctx);
    }

    ob_start();
    require ACAD_ROOT . '/includes/auth-shell.php';
    acad_output((string) ob_get_clean(), $page, (int) ($ctx['status'] ?? 200));
}

function acad_workspace_options(): array
{
    return [
        'institution' => 'Institution Admin',
        'faculty'     => 'Faculty & Staff',
        'student'     => 'Student',
        'parent'      => 'Parent',
        'partner'     => 'Partner',
    ];
}

function acad_handle_login(): array
{
    $email = trim((string) (is_string($_POST['email'] ?? null) ? $_POST['email'] : ''));
    $password = (string) (is_string($_POST['password'] ?? null) ? $_POST['password'] : '');
    $workspace = (string) (is_string($_POST['workspace'] ?? null) ? $_POST['workspace'] : '');
    if (!array_key_exists($workspace, acad_workspace_options())) {
        $workspace = '';
    }
    $old = ['email' => mb_substr($email, 0, 190), 'workspace' => $workspace];

    if (!acad_csrf_valid($_POST['_token'] ?? null)) {
        return ['status' => 419, 'form_error' => 'Your session expired. Please sign in again.', 'old' => $old];
    }
    if (!acad_rate_limit('login-ip', acad_client_fingerprint(), 30, 900)) {
        return ['status' => 429, 'form_error' => 'Too many sign-in attempts from this connection. Please wait 15 minutes and try again.', 'old' => $old];
    }

    $errors = [];
    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Enter the work email address for your Acadlytic account.';
    }
    if ($password === '') {
        $errors['password'] = 'Enter your password.';
    } elseif (strlen($password) > 1024) {
        $errors['password'] = 'That password is too long.';
    }
    if ($errors) {
        return ['status' => 422, 'errors' => $errors, 'old' => $old];
    }

    $result = (new AuthService())->attempt($email, $password, $workspace);
    return match ($result->status) {
        AuthResult::OK => acad_redirect(AuthService::WORKSPACE_HOME[$workspace] ?? '/admin/'),
        AuthResult::MFA_REQUIRED => acad_redirect('/login/verify/'),
        AuthResult::LOCKED => ['status' => 429, 'form_error' => 'Too many unsuccessful attempts for this account. Please wait 15 minutes or reset your password.', 'old' => $old],
        AuthResult::INVALID => ['status' => 401, 'form_error' => 'The email or password you entered is incorrect.', 'old' => $old],
        default => ['status' => 503, 'form_info' => true, 'old' => $old],
    };
}

function acad_login_panel(array $ctx): string
{
    $old = $ctx['old'] ?? [];
    $errors = $ctx['errors'] ?? [];
    $ws = (string) ($old['workspace'] ?? (is_string($_GET['workspace'] ?? null) ? $_GET['workspace'] : ''));
    $email = (string) ($old['email'] ?? '');
    $enabled = AuthService::enabled();
    $oauth = (array) acad_config('auth.oauth');

    $err = static function (string $field) use ($errors): array {
        if (!isset($errors[$field])) {
            return ['', ''];
        }
        return [' aria-invalid="true" aria-describedby="login-' . $field . '-error"', '<p class="field-error" id="login-' . $field . '-error">' . e($errors[$field]) . '</p>'];
    };
    [$emailAria, $emailErr] = $err('email');
    [$pwAria, $pwErr] = $err('password');

    ob_start(); ?>
<div class="auth-card">
    <h2>Sign in</h2>
    <p class="auth-sub">Access your Acadlytic workspace</p>

    <?php if (!empty($ctx['form_error'])): ?>
    <div class="form-alert error" role="alert"><?= e($ctx['form_error']) ?></div>
    <?php elseif (!empty($ctx['form_info']) || !$enabled): ?>
    <div class="form-alert info" role="<?= !empty($ctx['form_info']) ? 'alert' : 'note' ?>">
        <?php if (!empty($ctx['form_info'])): ?><strong>Workspace sign-in isn't open yet.</strong> <?php endif; ?>
        Online sign-in is opening in phases. <a href="/request-access.php">Request access</a> and our team will set up your workspace, or email <a href="<?= e(acad_mailto((string) acad_config('support_email'), 'Account access')) ?>"><?= e(acad_config('support_email')) ?></a>.
    </div>
    <?php endif; ?>

    <form class="form" method="post" action="/login.php" novalidate data-enhance="form">
        <?= acad_csrf_field() ?>
        <div class="form-grid">
            <div class="field">
                <label for="login-workspace">Workspace <span class="optional">(optional)</span></label>
                <select id="login-workspace" name="workspace" autocomplete="off">
                    <option value="">Detect from my account</option>
                    <?php foreach (acad_workspace_options() as $key => $label): ?>
                    <option value="<?= e($key) ?>"<?= $ws === $key ? ' selected' : '' ?>><?= e($label) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="field<?= $emailErr ? ' has-error' : '' ?>">
                <label for="login-email">Work email</label>
                <input type="email" id="login-email" name="email" value="<?= e($email) ?>" autocomplete="username" inputmode="email" autocapitalize="off" spellcheck="false" required aria-required="true"<?= $emailAria ?><?= $email === '' ? ' autofocus' : '' ?>>
                <?= $emailErr ?>
            </div>
            <div class="field<?= $pwErr ? ' has-error' : '' ?>">
                <label for="login-password">Password</label>
                <div class="pw-wrap">
                    <input type="password" id="login-password" name="password" autocomplete="current-password" required aria-required="true"<?= $pwAria ?><?= $email !== '' ? ' autofocus' : '' ?>>
                    <button type="button" class="pw-toggle" aria-controls="login-password" aria-pressed="false" aria-label="Show password" data-pw-toggle>
                        <span data-eye><?= icon('eye') ?></span><span data-eye-off hidden><?= icon('eye-off') ?></span>
                    </button>
                </div>
                <?= $pwErr ?>
            </div>
            <div class="auth-row">
                <label class="remember"><input type="checkbox" name="remember" value="1"> Remember me</label>
                <a href="/forgot-password.php">Forgot password?</a>
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary btn-lg" data-loading-text="Signing in…">Sign In <?= icon('arrow') ?></button>
        </div>
    </form>

    <div class="divider" role="separator">OR</div>
    <div class="sso-stack">
        <?php foreach (['google' => 'Google', 'microsoft' => 'Microsoft'] as $key => $label): $on = !empty($oauth[$key]); ?>
        <?php if ($on): ?>
        <a class="btn btn-sso btn-lg" href="/login/oauth/<?= e($key) ?>/"><?= icon($key) ?> Continue with <?= e($label) ?></a>
        <?php else: ?>
        <button type="button" class="btn btn-sso btn-lg" disabled aria-describedby="sso-note"><?= icon($key) ?> Continue with <?= e($label) ?></button>
        <?php endif; ?>
        <?php endforeach; ?>
        <?php if (empty($oauth['google']) || empty($oauth['microsoft'])): ?>
        <p class="sso-note" id="sso-note">Single sign-on becomes available once it is enabled for your institution.</p>
        <?php endif; ?>
    </div>

    <div class="auth-alt">
        <p>Don't have access yet?</p>
        <a class="btn btn-outline btn-block" href="/request-access.php">Request Access</a>
    </div>
</div>
<?php
    return (string) ob_get_clean();
}

function acad_forgot_panel(array $ctx): string
{
    ob_start(); ?>
<div class="auth-card">
    <a class="auth-back" href="/login.php"><?= icon('arrow', 'icon icon-sm') ?> Back to Login</a>
    <?php if (!empty($ctx['sent'])): ?>
    <div class="success-panel" role="status" tabindex="-1" data-success-focus>
        <span class="success-icon"><?= icon('mail') ?></span>
        <h2>Check your inbox</h2>
        <p class="muted">Check your inbox for password reset instructions. If the email is linked to an Acadlytic workspace, our team will verify the request and send reset instructions to that address.</p>
        <p class="muted">Nothing after a few minutes? Check spam, or email <a href="<?= e(acad_mailto((string) acad_config('support_email'), 'Password reset')) ?>"><?= e(acad_config('support_email')) ?></a>.</p>
        <a class="btn btn-outline btn-block" href="/login.php">Back to Login</a>
    </div>
    <?php else: ?>
    <h2>Reset your password</h2>
    <p class="auth-sub">Enter the work email for your account and we'll send reset instructions.</p>
    <?= acad_render_form('reset', $ctx, 'Send Reset Link') ?>
    <?php endif; ?>
</div>
<?php
    return (string) ob_get_clean();
}

function acad_access_panel(array $ctx): string
{
    ob_start(); ?>
<div class="auth-card auth-wide">
    <a class="auth-back" href="/login.php"><?= icon('arrow', 'icon icon-sm') ?> Back to Login</a>
    <?php if (!empty($ctx['sent'])): ?>
    <div class="success-panel" role="status" tabindex="-1" data-success-focus>
        <span class="success-icon"><?= icon('check') ?></span>
        <h2>Request received</h2>
        <p class="muted">Thank you. Our team will review your request and contact you.</p>
        <p class="muted">Questions in the meantime: <a href="<?= e(acad_mailto((string) acad_config('email'), 'Access request')) ?>"><?= e(acad_config('email')) ?></a></p>
        <a class="btn btn-outline btn-block" href="/">Back to acadlytic.com</a>
    </div>
    <?php else: ?>
    <h2>Request access</h2>
    <p class="auth-sub">Tell us who you are and which workspace you need. We review every request.</p>
    <?= acad_render_form('access', $ctx, 'Request Access') ?>
    <?php endif; ?>
</div>
<?php
    return (string) ob_get_clean();
}
