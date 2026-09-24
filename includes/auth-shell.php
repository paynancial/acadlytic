<?php
/**
 * Standalone authentication shell (login, forgot password, request access).
 * Split-screen: brand storytelling on the left (~55%), the auth card on the
 * right (~45%). Uses the same assets, fonts and security headers as the
 * public site but not the marketing header/footer.
 *
 * @var array  $page
 * @var array  $ctx
 * @var string $panel  Rendered right-hand panel HTML.
 */
declare(strict_types=1);

$logoImg = '<picture><source type="image/webp" srcset="' . e(asset('/assets/img/logo-acadlytic-56.webp')) . ' 1x, ' . e(asset('/assets/img/logo-acadlytic.webp')) . ' 2x">'
    . '<img class="brand-logo" src="' . e(asset('/assets/img/logo-acadlytic.png')) . '" width="207" height="56" alt="Acadlytic, Inc." fetchpriority="high"></picture>';
?><!doctype html>
<html lang="en-IN" class="no-js">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<?= acad_head_meta($page) ?>
<meta name="theme-color" content="#071A3A">
<link rel="icon" href="/favicon.ico" sizes="32x32">
<link rel="icon" type="image/png" sizes="192x192" href="<?= e(asset('/assets/img/icon-192.png')) ?>">
<link rel="apple-touch-icon" href="<?= e(asset('/assets/img/apple-touch-icon.png')) ?>">
<link rel="preload" href="/assets/fonts/manrope-var-latin.woff2" as="font" type="font/woff2" crossorigin>
<link rel="preload" href="/assets/fonts/inter-var-latin.woff2" as="font" type="font/woff2" crossorigin>
<style><?= acad_critical_css() ?></style>
<link rel="stylesheet" href="<?= e(asset('/assets/css/main.css')) ?>">
<script src="<?= e(asset('/assets/js/app.js')) ?>" defer></script>
</head>
<body class="auth-body">
<a class="skip-link" href="#auth-main">Skip to form</a>
<div class="auth">
    <section class="auth-story" aria-label="About Acadlytic">
        <a class="auth-logo" href="/" aria-label="Acadlytic, Inc. home"><?= $logoImg ?></a>
        <p class="auth-tag"><?= e(acad_config('tagline')) ?></p>
        <div class="auth-story-main">
            <p class="eyebrow on-dark"><?= e($page['story_kicker'] ?? 'Secure workspace') ?></p>
            <h1><?= e($page['h1']) ?></h1>
            <p class="lead"><?= e($page['lead']) ?></p>
            <ul class="auth-pillars" aria-label="Platform pillars"><li>AI</li><li>CRM</li><li>Cloud</li><li>Academic Management</li></ul>
            <svg class="auth-visual" viewBox="0 0 560 250" fill="none" aria-hidden="true">
                <defs>
                    <linearGradient id="av-g" x1="0" x2="1"><stop offset="0" stop-color="#0B63F6"/><stop offset="1" stop-color="#14CFE8"/></linearGradient>
                    <radialGradient id="av-glow"><stop offset="0" stop-color="#14CFE8" stop-opacity=".45"/><stop offset="1" stop-color="#14CFE8" stop-opacity="0"/></radialGradient>
                </defs>
                <circle cx="280" cy="125" r="110" fill="url(#av-glow)"/>
                <g stroke="rgba(159,179,214,.35)" stroke-width="1.2">
                    <path d="M80 60 L280 125 L480 50"/><path d="M60 190 L280 125 L500 200"/><path d="M280 125 L280 20"/><path d="M280 125 L270 235"/><path d="M80 60 L60 190"/><path d="M480 50 L500 200"/>
                </g>
                <g stroke="url(#av-g)" stroke-width="2" stroke-dasharray="3 7" stroke-linecap="round">
                    <path d="M80 60 L280 125"/><path d="M280 125 L500 200"/>
                </g>
                <rect x="232" y="85" width="96" height="80" rx="18" fill="#0C2552" stroke="url(#av-g)" stroke-width="1.5"/>
                <path d="M262 142 L280 102 L298 142 M268 130 H292" stroke="url(#av-g)" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                <g>
                    <rect x="30" y="36" width="100" height="48" rx="12" fill="rgba(255,255,255,.06)" stroke="rgba(255,255,255,.14)"/>
                    <rect x="44" y="50" width="44" height="6" rx="3" fill="rgba(255,255,255,.4)"/><rect x="44" y="64" width="70" height="6" rx="3" fill="rgba(20,207,232,.6)"/>
                    <rect x="430" y="26" width="104" height="48" rx="12" fill="rgba(255,255,255,.06)" stroke="rgba(255,255,255,.14)"/>
                    <rect x="444" y="56" width="10" height="10" rx="2" fill="#14CFE8"/><rect x="460" y="48" width="10" height="18" rx="2" fill="#168AF7"/><rect x="476" y="42" width="10" height="24" rx="2" fill="#0B63F6"/><rect x="492" y="38" width="10" height="28" rx="2" fill="#14CFE8"/>
                    <rect x="14" y="166" width="100" height="48" rx="12" fill="rgba(255,255,255,.06)" stroke="rgba(255,255,255,.14)"/>
                    <circle cx="38" cy="190" r="10" fill="rgba(20,207,232,.25)"/><rect x="56" y="184" width="44" height="6" rx="3" fill="rgba(255,255,255,.4)"/><rect x="56" y="196" width="30" height="5" rx="2.5" fill="rgba(255,255,255,.2)"/>
                    <rect x="448" y="176" width="100" height="48" rx="12" fill="rgba(255,255,255,.06)" stroke="rgba(255,255,255,.14)"/>
                    <path d="M462 208 L480 196 L494 202 L514 186 L532 192" stroke="#14CFE8" stroke-width="2" fill="none"/>
                </g>
                <g fill="#14CFE8"><circle cx="80" cy="60" r="4"/><circle cx="480" cy="50" r="4"/><circle cx="60" cy="190" r="4"/><circle cx="500" cy="200" r="4"/><circle cx="280" cy="20" r="3"/><circle cx="270" cy="235" r="3"/></g>
            </svg>
        </div>
        <p class="auth-story-foot">
            <span>© <?= date('Y') ?> Acadlytic, Inc.</span>
            <a href="/core/security/">Security Center</a>
            <a href="/trust/privacy/">Privacy</a>
            <a href="/company/support/">Support</a>
        </p>
    </section>

    <main class="auth-panel" id="auth-main" tabindex="-1">
        <?= $panel ?>
        <p class="auth-legal">By continuing, you agree to the <a href="/trust/terms/">Terms of Service</a> and <a href="/trust/privacy/">Privacy Policy</a>.</p>
        <p class="auth-secure"><?= icon('lock', 'icon icon-sm') ?> Secure enterprise access</p>
    </main>
</div>
</body>
</html>
