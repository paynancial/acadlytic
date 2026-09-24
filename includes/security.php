<?php
/**
 * Security primitives shared by public forms and the future auth layer:
 * security headers, hardened sessions, CSRF tokens and rate limiting.
 */
declare(strict_types=1);

/** Critical header CSS inlined in <head>; hashed into the CSP. */
function acad_critical_css(): string
{
    static $css = null;
    if ($css === null) {
        $css = trim((string) file_get_contents(ACAD_ROOT . '/includes/critical.css'));
    }
    return $css;
}

function acad_send_security_headers(bool $noindex = false): void
{
    if (headers_sent()) {
        return;
    }
    $styleHash = "'sha256-" . base64_encode(hash('sha256', acad_critical_css(), true)) . "'";
    $csp = implode('; ', [
        "default-src 'self'",
        "script-src 'self'",
        "style-src 'self' {$styleHash}",
        "img-src 'self' data:",
        "font-src 'self'",
        "connect-src 'self'",
        "form-action 'self'",
        "frame-ancestors 'none'",
        "base-uri 'self'",
        "object-src 'none'",
    ]);
    if (acad_is_https()) {
        $csp .= '; upgrade-insecure-requests';
    }
    // Do not advertise the PHP version.
    header_remove('X-Powered-By');
    header('Content-Security-Policy: ' . $csp);
    header('X-Content-Type-Options: nosniff');
    header('Referrer-Policy: strict-origin-when-cross-origin');
    header('X-Frame-Options: DENY');
    header('Permissions-Policy: camera=(), microphone=(), geolocation=(), payment=(), usb=()');
    header('Cross-Origin-Opener-Policy: same-origin');
    if (acad_is_https()) {
        // includeSubDomains deliberately omitted until every acadlytic.com subdomain is HTTPS-only.
        header('Strict-Transport-Security: max-age=31536000');
    }
    if ($noindex) {
        header('X-Robots-Tag: noindex, nofollow');
    }
}

function acad_is_https(): bool
{
    return (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
        || (($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '') === 'https')
        || ((int) ($_SERVER['SERVER_PORT'] ?? 0) === 443);
}

/**
 * Start a hardened session. Only called on pages that need one (forms,
 * auth), so ordinary content pages stay cookie-free and cache-friendly.
 */
function acad_session_start(): void
{
    if (session_status() === PHP_SESSION_ACTIVE || PHP_SAPI === 'cli') {
        return;
    }
    ini_set('session.use_strict_mode', '1');
    ini_set('session.use_only_cookies', '1');
    ini_set('session.cookie_httponly', '1');
    session_name(acad_is_https() ? '__Host-acad_sid' : 'acad_sid');
    session_set_cookie_params([
        'lifetime' => 0,
        'path'     => '/',
        'secure'   => acad_is_https(),
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
    session_start();

    // Idle timeout and periodic ID rotation.
    $now = time();
    $idle = (int) acad_config('auth.session_idle_secs');
    if (isset($_SESSION['_last']) && $now - (int) $_SESSION['_last'] > $idle) {
        $_SESSION = [];
        session_regenerate_id(true);
    }
    $_SESSION['_last'] = $now;
    if (!isset($_SESSION['_created']) || $now - (int) $_SESSION['_created'] > 900) {
        session_regenerate_id(true);
        $_SESSION['_created'] = $now;
    }
}

/** Per-session CSRF token. */
function acad_csrf_token(): string
{
    if (PHP_SAPI === 'cli') {
        return 'cli';
    }
    acad_session_start();
    if (empty($_SESSION['_csrf'])) {
        $_SESSION['_csrf'] = bin2hex(random_bytes(32));
    }
    return (string) $_SESSION['_csrf'];
}

function acad_csrf_field(): string
{
    return '<input type="hidden" name="_token" value="' . e(acad_csrf_token()) . '">';
}

function acad_csrf_valid(?string $token): bool
{
    acad_session_start();
    $expected = (string) ($_SESSION['_csrf'] ?? '');
    return $expected !== '' && is_string($token) && hash_equals($expected, $token);
}

/** Salted hash of the client IP; raw IPs are never stored. */
function acad_client_fingerprint(): string
{
    $ip = (string) ($_SERVER['REMOTE_ADDR'] ?? '0.0.0.0');
    return hash_hmac('sha256', $ip, acad_secret('ip'));
}

/**
 * Server-side secret for HMACs. Generated once and stored in the storage
 * directory (never in the web-visible code).
 */
function acad_secret(string $purpose): string
{
    static $key = null;
    if ($key === null) {
        $file = acad_storage_path('keys') . '/app.key';
        if (!is_file($file)) {
            @file_put_contents($file, bin2hex(random_bytes(32)), LOCK_EX);
            @chmod($file, 0600);
        }
        $key = is_file($file) ? trim((string) file_get_contents($file)) : hash('sha256', ACAD_ROOT);
    }
    return hash_hmac('sha256', $purpose, $key);
}

function acad_storage_path(string $sub = ''): string
{
    $base = rtrim((string) acad_config('storage_path'), '/');
    $dir = $sub === '' ? $base : $base . '/' . $sub;
    if (!is_dir($dir)) {
        @mkdir($dir, 0750, true);
    }
    return $dir;
}

/**
 * Fixed-window rate limiter backed by small files (no Redis needed on
 * shared hosting). Returns true when the action is allowed.
 */
function acad_rate_limit(string $bucket, string $key, int $max, int $window): bool
{
    $dir = acad_storage_path('ratelimit');
    $file = $dir . '/' . hash('sha256', $bucket . '|' . $key) . '.json';
    $now = time();
    $fh = @fopen($file, 'c+');
    if ($fh === false) {
        return true; // fail open rather than blocking legitimate users
    }
    flock($fh, LOCK_EX);
    $data = json_decode((string) stream_get_contents($fh), true);
    if (!is_array($data) || ($data['reset'] ?? 0) < $now) {
        $data = ['count' => 0, 'reset' => $now + $window];
    }
    $allowed = $data['count'] < $max;
    if ($allowed) {
        $data['count']++;
    }
    ftruncate($fh, 0);
    rewind($fh);
    fwrite($fh, (string) json_encode($data));
    flock($fh, LOCK_UN);
    fclose($fh);
    return $allowed;
}

/** Remaining attempts check without incrementing (used by auth throttling). */
function acad_rate_limited(string $bucket, string $key, int $max): bool
{
    $file = acad_storage_path('ratelimit') . '/' . hash('sha256', $bucket . '|' . $key) . '.json';
    if (!is_file($file)) {
        return false;
    }
    $data = json_decode((string) file_get_contents($file), true);
    return is_array($data) && ($data['reset'] ?? 0) >= time() && ($data['count'] ?? 0) >= $max;
}

/** Optional PDO connection (null when no database is configured). */
function acad_db(): ?PDO
{
    static $pdo = false;
    if ($pdo !== false) {
        return $pdo;
    }
    $dsn = (string) acad_config('db.dsn');
    if ($dsn === '') {
        return $pdo = null;
    }
    try {
        $pdo = new PDO($dsn, (string) acad_config('db.user'), (string) acad_config('db.password'), [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]);
    } catch (PDOException $ex) {
        error_log('Acadlytic DB connection failed: ' . $ex->getMessage());
        $pdo = null;
    }
    return $pdo;
}
