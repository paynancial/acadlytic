<?php
/**
 * Shared document head, utility bar and primary navigation.
 *
 * Navigation works without JavaScript: panels open on hover and
 * :focus-within via CSS. app.js upgrades this to click/keyboard control
 * (aria-expanded, Escape, arrow keys) and the mobile drawer.
 *
 * @var array $page
 * @var array $nav
 */
declare(strict_types=1);

$coreMenu = ['/core/ai-assistant/' => 'ai', '/core/about/' => 'company', '/core/contact/' => 'company', '/core/security/' => 'company'];
$activeTop = match ($page['section']) {
    'core' => $coreMenu[$page['path']] ?? 'platform',
    'platform' => 'platform',
    'ai' => 'ai',
    'solutions', 'industries' => 'solutions',
    'integrations' => 'integrations',
    'resources', 'glossary', 'comparisons' => 'resources',
    'company', 'trust' => 'company',
    default => '',
};
?><!doctype html>
<html lang="en-IN" class="no-js">
<head>
<?= acad_head_common($page) ?>
</head>
<body class="tpl-<?= e($page['template']) ?> sec-<?= e($page['section']) ?>">
<a class="skip-link" href="#main">Skip to main content</a>
<?php require ACAD_ROOT . '/includes/utility-bar.php'; ?>
<header class="site-header" data-header>
    <div class="container nav-wrap">
        <a class="brand" href="/" aria-label="Acadlytic, Inc. home"><?= acad_logo_html() ?></a>

        <nav class="primary-nav" aria-label="Primary">
            <ul class="nav-list">
                <?php foreach ($nav['mega'] as $key => $menu): ?>
                <li class="nav-item<?= $activeTop === $key ? ' is-current' : '' ?>" data-mega>
                    <button type="button" class="nav-trigger" aria-expanded="false" aria-controls="mega-<?= e($key) ?>" data-mega-trigger>
                        <?= e($menu['label']) ?><?= icon('chevron', 'icon icon-xs chev') ?>
                    </button>
                    <div class="mega" id="mega-<?= e($key) ?>" data-mega-panel><noscript data-mega-src>
                        <div class="container mega-inner">
                            <div class="mega-intro">
                                <p class="mega-kicker"><?= e($menu['label']) ?></p>
                                <?php if (!empty($menu['intro']['status'])): ?><p class="mega-status"><?= e($menu['intro']['status']) ?></p><?php endif; ?>
                                <p class="mega-title"><?= e($menu['intro']['title']) ?></p>
                                <p class="mega-text"><?= e($menu['intro']['text']) ?></p>
                                <a class="mega-cta" href="<?= e($menu['intro']['cta'][1]) ?>"><?= e($menu['intro']['cta'][0]) ?> <?= icon('arrow', 'icon icon-sm') ?></a>
                            </div>
                            <div class="mega-groups<?= count($menu['groups']) > 1 ? ' two-groups' : '' ?>">
                                <?php foreach ($menu['groups'] as $group): ?>
                                <div class="mega-group">
                                    <p class="mega-group-title"><?= e($group['title']) ?></p>
                                    <ul class="mega-links">
                                        <?php foreach ($group['links'] as [$label, $href, $desc, $ic]): ?>
                                        <li><a class="mega-link" href="<?= e($href) ?>"><span class="mega-link-icon"><?= icon($ic) ?></span><span><strong><?= e($label) ?></strong><small><?= e($desc) ?></small></span></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                                <?php endforeach; ?>
                                <?php if (!empty($menu['more'])): ?>
                                <p class="mega-more"><span>Also explore</span><?php foreach ($menu['more'] as [$label, $href]): ?><a href="<?= e($href) ?>"><?= e($label) ?></a><?php endforeach; ?></p>
                                <?php endif; ?>
                            </div>
                            <?php $card = $menu['card']; ?>
                            <div class="mega-card mega-card-<?= e($card['kind']) ?>">
                                <?php if ($card['kind'] === 'dashboard'): ?>
                                <div class="mini-dash" aria-hidden="true">
                                    <div class="md-row"><span class="md-pill"></span><span class="md-pill short"></span></div>
                                    <div class="md-bars"><i class="b1"></i><i class="b2"></i><i class="b3"></i><i class="b4"></i><i class="b5"></i><i class="b6"></i></div>
                                    <div class="md-row"><span class="md-chip"></span><span class="md-chip"></span><span class="md-chip"></span></div>
                                </div>
                                <?php elseif ($card['kind'] === 'assistant'): ?>
                                <div class="mini-ai" aria-hidden="true"><span class="mini-ai-orb"><?= icon('ai') ?></span><span class="mini-ai-line"></span><span class="mini-ai-line short"></span></div>
                                <?php else: ?>
                                <span class="mega-card-icon"><?= icon(match ($card['kind']) { 'integration' => 'plug', 'resource' => 'book', 'contact' => 'support', default => 'compass' }) ?></span>
                                <?php endif; ?>
                                <p class="mega-card-title"><?= e($card['title']) ?></p>
                                <p class="mega-card-text"><?= e($card['text']) ?></p>
                                <a class="btn btn-primary btn-sm" href="<?= e($card['cta'][1]) ?>"><?= e($card['cta'][0]) ?> <?= icon('arrow', 'icon icon-sm') ?></a>
                            </div>
                        </div>
                    </noscript></div>
                </li>
                <?php endforeach; ?>
            </ul>
        </nav>

        <div class="nav-actions">
            <a class="icon-btn" href="/search/" aria-label="Search the site"><?= icon('search') ?></a>
            <a class="btn btn-primary nav-demo" href="/company/request-demo/"><span class="demo-long">Request a Demo</span><span class="demo-short">Demo</span> <?= icon('arrow', 'icon icon-sm') ?></a>
            <a class="icon-btn menu-btn" href="/sitemap/" aria-controls="mobile-drawer" aria-expanded="false" data-drawer-open><?= icon('menu') ?><span class="sr-only">Open menu</span></a>
        </div>
    </div>
</header>
<div class="mega-backdrop" data-mega-backdrop></div>

<div class="drawer" id="mobile-drawer" role="dialog" aria-modal="true" aria-label="Site menu" data-drawer hidden>
    <div class="drawer-head">
        <a class="brand" href="/" aria-label="Acadlytic, Inc. home"><?= acad_logo_html('brand-logo', false) ?></a>
        <button type="button" class="icon-btn" data-drawer-close><?= icon('close') ?><span class="sr-only">Close menu</span></button>
    </div>
    <form class="drawer-search" action="/search/" method="get" role="search">
        <label class="sr-only" for="drawer-q">Search</label>
        <?= icon('search', 'icon icon-sm') ?><input id="drawer-q" type="search" name="q" placeholder="Search Acadlytic" autocomplete="off">
    </form>
    <!-- Built from the mega menu by app.js on first open (the drawer needs JS to open; keeps DOM small). -->
    <nav class="drawer-nav" aria-label="Mobile" data-drawer-nav></nav>
    <div class="drawer-foot">
        <a class="btn btn-primary btn-block" href="/company/request-demo/">Request a Demo <?= icon('arrow') ?></a>
        <a class="btn btn-outline btn-block" href="/login.php"><?= icon('lock', 'icon icon-sm') ?> Login</a>
        <a class="drawer-contact" href="<?= e(acad_config('phone_href')) ?>"><?= icon('phone', 'icon icon-sm') ?><?= e(acad_config('phone')) ?></a>
        <a class="drawer-contact" href="<?= e(acad_mailto((string) acad_config('email'))) ?>"><?= icon('mail', 'icon icon-sm') ?><?= e(acad_config('email')) ?></a>
    </div>
</div>

<main id="main" tabindex="-1">
