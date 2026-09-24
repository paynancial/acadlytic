<?php
// Issues a CSRF token for the enquiry widget on demand (JSON).
declare(strict_types=1);
require dirname(__DIR__, 2) . '/includes/bootstrap.php';
acad_enquiry_token();
