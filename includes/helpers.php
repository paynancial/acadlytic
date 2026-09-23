<?php
declare(strict_types=1);

/** Merged site configuration (config/site.php overlaid with config/local.php). */
function acad_config(?string $key = null): mixed
{
    static $config = null;
    if ($config === null) {
        $config = require ACAD_ROOT . '/config/site.php';
        $local = ACAD_ROOT . '/config/local.php';
        if (is_file($local)) {
            $config = array_replace_recursive($config, (array) require $local);
        }
    }
    if ($key === null) {
        return $config;
    }
    $value = $config;
    foreach (explode('.', $key) as $part) {
        if (!is_array($value) || !array_key_exists($part, $value)) {
            return null;
        }
        $value = $value[$part];
    }
    return $value;
}

/** HTML-escape for text and attribute contexts. */
function e(null|string|int|float $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/** Absolute canonical URL for a root-relative path. */
function acad_url(string $path = '/'): string
{
    return rtrim((string) acad_config('url'), '/') . '/' . ltrim($path, '/');
}

/**
 * Root-relative, cache-busted asset URL. Root-relative paths work on any
 * host (apex, www, staging) so CSS/JS never fail because of a host mismatch.
 */
function asset(string $path): string
{
    $path = '/' . ltrim($path, '/');
    $file = ACAD_ROOT . $path;
    $version = is_file($file) ? (string) filemtime($file) : (string) acad_config('asset_version');
    return $path . '?v=' . rawurlencode($version);
}

function acad_mailto(string $email, string $subject = ''): string
{
    return 'mailto:' . $email . ($subject !== '' ? '?subject=' . rawurlencode($subject) : '');
}

/** Normalise a request path to the site's trailing-slash directory form. */
function acad_normalize_path(string $path): string
{
    $path = '/' . trim(preg_replace('#/+#', '/', $path) ?? '/', '/');
    if ($path !== '/' && !preg_match('#\.[a-z0-9]{2,5}$#i', $path)) {
        $path .= '/';
    }
    return strtolower($path);
}

function acad_request_path(): string
{
    $uri = (string) ($_SERVER['REQUEST_URI'] ?? '/');
    return (string) (parse_url($uri, PHP_URL_PATH) ?: '/');
}

function acad_is_post(): bool
{
    return ($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST';
}

function acad_redirect(string $location, int $status = 303): never
{
    header('Location: ' . $location, true, $status);
    exit;
}

/** Word count of visible text, used by QA. */
function acad_word_count(string $html): int
{
    return str_word_count(strip_tags($html));
}
