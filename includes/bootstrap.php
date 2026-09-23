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
require ACAD_ROOT . '/includes/auth/AuthService.php';
require ACAD_ROOT . '/includes/auth/pages.php';
require ACAD_ROOT . '/seo/meta.php';
require ACAD_ROOT . '/includes/render.php';

date_default_timezone_set('Asia/Kolkata');
