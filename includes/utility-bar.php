<?php
/**
 * Utility bar above the main navigation.
 * Desktop: positioning statement left; contact, support, resources and the
 * login selector right. Mobile: Support and Login only (phone and email move
 * into the navigation drawer).
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
            <li class="util-hide-sm"><a class="util-link" href="<?= e(acad_config('phone_href')) ?>"><?= icon('phone', 'icon icon-sm') ?><span><?= e(acad_config('phone')) ?></span></a></li>
            <li class="util-hide-sm"><a class="util-link" href="<?= e(acad_mailto((string) acad_config('email'))) ?>"><?= icon('mail', 'icon icon-sm') ?><span><?= e(acad_config('email')) ?></span></a></li>
            <li><a class="util-link" href="/company/support/"><?= icon('support', 'icon icon-sm') ?><span>Support</span></a></li>
            <li class="util-hide-sm"><a class="util-link" href="/resources/"><span>Resources</span></a></li>
            <li><?php require ACAD_ROOT . '/includes/login-menu.php'; ?></li>
        </ul>
    </div>
</div>
