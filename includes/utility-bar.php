<?php
/**
 * Utility bar above the main navigation.
 * Desktop: positioning statement left; Support and the login selector right.
 * Mobile: Support and Login only. Phone and email are in the footer, the
 * enquiry widget and the navigation drawer.
 *
 * @var array $nav
 */
declare(strict_types=1);
?>
<div class="utility-bar" role="region" aria-label="Utility">
    <div class="container util-inner">
        <p class="util-brand">
            <span class="util-dot" aria-hidden="true"></span>
            <span class="util-kicker">AI-powered education platform</span>
            <span class="util-sep" aria-hidden="true"></span>
            <span class="util-tagline"><?= e(acad_config('tagline')) ?></span>
        </p>
        <ul class="util-links">
            <li><a class="util-link" href="/company/support/"><?= icon('support', 'icon icon-sm') ?><span>Support</span></a></li>
            <li><?php require ACAD_ROOT . '/includes/login-menu.php'; ?></li>
        </ul>
    </div>
</div>
