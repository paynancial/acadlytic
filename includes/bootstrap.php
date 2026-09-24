<?php
/**
 * Acadlytic public site bootstrap.
 *
 * Every public entry point (index.php stubs, login.php, etc.) requires this
 * file. It loads configuration, helpers, the content registry and security
 * utilities. No output is produced here.
 */
declare(strict_types=1);

if (defined('ACAD_ROOT')) {
    return;
}

define('ACAD_ROOT', dirname(__DIR__));

error_reporting(E_ALL);
ini_set('display_errors', PHP_SAPI === 'cli' ? '1' : '0');
ini_set('log_errors', '1');

require ACAD_ROOT . '/includes/helpers.php';
require ACAD_ROOT . '/includes/icons.php';
require ACAD_ROOT . '/includes/security.php';
require ACAD_ROOT . '/includes/content-dsl.php';
require ACAD_ROOT . '/includes/registry.php';
require ACAD_ROOT . '/includes/blocks.php';
require ACAD_ROOT . '/includes/forms.php';
require ACAD_ROOT . '/includes/enquiry.php';
require ACAD_ROOT . '/includes/auth/AuthService.php';
require ACAD_ROOT . '/includes/auth/pages.php';
require ACAD_ROOT . '/seo/meta.php';
require ACAD_ROOT . '/includes/render.php';

date_default_timezone_set('Asia/Kolkata');

if (PHP_SAPI !== 'cli') {
    set_exception_handler(static function (Throwable $ex): void {
        error_log('Acadlytic uncaught ' . get_class($ex) . ': ' . $ex->getMessage() . ' in ' . $ex->getFile() . ':' . $ex->getLine());
        while (ob_get_level() > 0) {
            ob_end_clean();
        }
        if (!headers_sent()) {
            http_response_code(500);
            header('Content-Type: text/html; charset=utf-8');
            header('Cache-Control: no-store');
            header('X-Robots-Tag: noindex');
        }
        echo '<!doctype html><html lang="en-IN"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><meta name="robots" content="noindex"><title>Temporarily unavailable | Acadlytic</title></head>'
            . '<body style="font-family:system-ui,sans-serif;max-width:560px;margin:15vh auto;padding:0 20px;color:#0B1731;line-height:1.6">'
            . '<h1 style="font-size:28px">Something went wrong on our side.</h1><p>Please try again in a moment. If it keeps happening, email <a href="mailto:info@acadlytic.com">info@acadlytic.com</a> or <a href="/core/contact/">contact us</a>.</p><p><a href="/">Return to acadlytic.com</a></p></body></html>';
    });
}
