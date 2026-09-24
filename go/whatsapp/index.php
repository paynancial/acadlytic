<?php
// Number-free contact redirect (see config/contact.php). Hand-written; not a content page.
declare(strict_types=1);
require dirname(__DIR__, 2) . '/includes/bootstrap.php';
acad_contact_redirect('whatsapp');
