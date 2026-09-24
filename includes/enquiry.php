<?php
/**
 * JSON endpoints for the floating enquiry widget.
 *
 *   GET  /enquiry/token/  → { token, ts }   (starts a session only on demand)
 *   POST /enquiry/        → { ok, message, errors? }
 *
 * Security: same-origin check, CSRF token, honeypot, signed timing token,
 * per-IP rate limit and the same server-side validation as page forms.
 * Responses never include internal error details.
 */
declare(strict_types=1);

function acad_json(array $payload, int $status = 200): never
{
    http_response_code($status);
    header('Content-Type: application/json; charset=utf-8');
    header('Cache-Control: no-store');
    header('X-Content-Type-Options: nosniff');
    header('X-Robots-Tag: noindex, nofollow');
    echo json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP);
    exit;
}

/** Reject cross-site requests (defence in depth on top of CSRF tokens). */
function acad_same_origin(): bool
{
    $site = strtolower((string) ($_SERVER['HTTP_SEC_FETCH_SITE'] ?? ''));
    if ($site !== '' && !in_array($site, ['same-origin', 'none'], true)) {
        return false;
    }
    $origin = (string) ($_SERVER['HTTP_ORIGIN'] ?? '');
    if ($origin !== '') {
        return strcasecmp((string) parse_url($origin, PHP_URL_HOST), (string) strtok((string) ($_SERVER['HTTP_HOST'] ?? ''), ':')) === 0;
    }
    return true;
}

function acad_enquiry_token(): never
{
    if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'GET' || !acad_same_origin()) {
        acad_json(['ok' => false], 403);
    }
    acad_session_start();
    $ts = (string) time();
    acad_json([
        'ok'    => true,
        'token' => acad_csrf_token(),
        'ts'    => $ts . '.' . substr(hash_hmac('sha256', $ts, acad_secret('ts')), 0, 16),
    ]);
}

function acad_enquiry_submit(): never
{
    $fail = 'We couldn’t submit your enquiry right now. Please try again or contact us by email or WhatsApp.';
    if (!acad_is_post() || !acad_same_origin()) {
        acad_json(['ok' => false, 'message' => $fail], 403);
    }
    acad_session_start();
    try {
        $r = acad_process_form('enquiry');
    } catch (Throwable $ex) {
        error_log('Acadlytic enquiry widget error: ' . $ex->getMessage());
        acad_json(['ok' => false, 'message' => $fail], 500);
    }
    if ($r['result'] !== 'error') {
        acad_json(['ok' => true, 'message' => 'Enquiry received successfully.']);
    }
    acad_json([
        'ok'      => false,
        'message' => $r['form_error'] ?? 'Please correct the highlighted fields.',
        'errors'  => $r['errors'] ?? (object) [],
    ], (int) $r['status']);
}
