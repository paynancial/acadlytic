<?php
// ErrorDocument handler (see .htaccess). Also resolves redirects for URLs
// that have no directory stub, e.g. mixed-case or trailing-slash variants.
declare(strict_types=1);
require __DIR__ . '/includes/bootstrap.php';
$path = acad_normalize_path(acad_request_path());
if ($path !== '/404.php' && (isset(acad_redirects()[$path]) || acad_page($path))) {
    $target = acad_redirects()[$path] ?? $path;
    acad_redirect($target, 301);
}
acad_not_found();
