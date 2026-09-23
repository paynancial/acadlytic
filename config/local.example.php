<?php
/**
 * Copy to config/local.php on the server and fill in real values.
 * config/local.php is git-ignored and denied by .htaccess. Values here are
 * merged over config/site.php.
 */
declare(strict_types=1);

return [
    // 'storage_path' => '/home/CPANEL_USER/acadlytic-storage',
    'db' => [
        'dsn'      => 'mysql:host=localhost;dbname=CPANEL_DB;charset=utf8mb4',
        'user'     => 'CPANEL_DB_USER',
        'password' => 'CHANGE_ME',
    ],
    // 'forms' => ['send_mail' => true, 'mail_from' => 'no-reply@acadlytic.com'],
];
