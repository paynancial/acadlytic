<?php
// Clean URL /login/ serves the same sign-in page as /login.php (noindex).
declare(strict_types=1);
require dirname(__DIR__) . '/includes/bootstrap.php';
acad_auth_page('login');
