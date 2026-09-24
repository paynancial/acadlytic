<?php
/**
 * Local development router for PHP's built-in server, mimicking the
 * production .htaccess rules (internal folders denied, 404 handler):
 *
 *   php -S localhost:8080 bin/dev-router.php
 *
 * Not used in production.
 */
declare(strict_types=1);

$root = dirname(__DIR__);
$path = (string) parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);

if (preg_match('#^/(includes|components|config|data|seo|storage|bin|database|docs)(/|$)#', $path)
    || preg_match('#(^|/)\.|\.(md|sql|json|jsonl|log|key)$#', $path)) {
    http_response_code(403);
    require $root . '/404.php';
    return true;
}
if ($path !== '/' && is_file($root . $path)) {
    if (str_ends_with($path, '.php')) {
        chdir(dirname($root . $path));
        require $root . $path;
        return true;
    }
    return false; // static asset
}
$dir = rtrim($root . $path, '/');
if (is_file($dir . '/index.php')) {
    if (!str_ends_with($path, '/')) {
        header('Location: ' . $path . '/', true, 301);
        return true;
    }
    require $dir . '/index.php';
    return true;
}
require $root . '/404.php';
return true;
