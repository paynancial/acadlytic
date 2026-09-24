<?php
/**
 * Pre-deployment quality gate (plain PHP).
 *
 *   php bin/qa.php
 *
 * Renders every page and checks: one H1, title/description present and
 * unique, canonical on indexable pages, internal links resolve, no
 * duplicate element IDs, redirect targets exist, sitemap consistency,
 * required assets present, thin content and paragraphs duplicated across
 * pages (a doorway-page signal). Also enforces the claims policy
 * (docs/CLAIMS_REGISTER.md): no unsupported statistics or superlatives,
 * planned notices on product pages, no present-tense availability claims,
 * and legal-draft markers. Exits non-zero on errors.
 *
 *   php bin/qa.php --launch   additionally fails while any legal page is
 *                             still a draft awaiting counsel sign-off.
 */
declare(strict_types=1);

if (PHP_SAPI !== 'cli') {
    http_response_code(404);
    exit;
}

require dirname(__DIR__) . '/includes/bootstrap.php';

$launch = in_array('--launch', $argv, true);
$errors = [];
$launchBlockers = [];
$claimVerbs = 'gives|keeps|models|makes|matches|stores|manages|replaces|evaluates|helps|answers|reads|suggests|presents|lets|runs|brings|connects|tracks|shows|sends|supports|uses|provides|combines|applies|offers|handles|captures|integrates|posts|records|prioritises|flags|drafts|summarises|forecasts|classifies|extracts';
$warnings = [];
$titles = [];
$descs = [];
$sentences = [];
$pages = acad_pages();
$redirects = acad_redirects();

$resolves = static function (string $href) use ($pages, $redirects): bool {
    $path = (string) parse_url($href, PHP_URL_PATH);
    if ($path === '') {
        return true; // pure fragment or query
    }
    if (isset($pages[$path]) && empty($pages[$path]['virtual'])) {
        return true;
    }
    if (isset($redirects[$path])) {
        return true;
    }
    if (in_array($path, ['/login.php', '/forgot-password.php', '/request-access.php', '/login/', '/sitemap.xml', '/robots.txt', '/llms.txt', '/go/call/', '/go/whatsapp/'], true)) {
        return true;
    }
    return is_file(ACAD_ROOT . $path);
};

$render = static function (array $page): string {
    if (in_array($page['path'], ['/login.php', '/forgot-password.php', '/request-access.php'], true)) {
        $ctx = [];
        $kind = substr($page['path'], 1, -4);
        $panel = $kind === 'login' ? acad_login_panel($ctx) : ($kind === 'forgot-password' ? acad_forgot_panel($ctx) : acad_access_panel($ctx));
        ob_start();
        require ACAD_ROOT . '/includes/auth-shell.php';
        return (string) ob_get_clean();
    }
    return acad_render_page($page, []);
};

foreach ($pages as $path => $page) {
    $html = $render($page);
    $where = $path;

    if (substr_count($html, '<h1') !== 1) {
        $errors[] = "{$where}: expected exactly one <h1>, found " . substr_count($html, '<h1');
    }
    if (!preg_match('#<title>(.+?)</title>#s', $html, $m) || trim($m[1]) === '') {
        $errors[] = "{$where}: missing <title>";
    } else {
        $t = html_entity_decode($m[1], ENT_QUOTES);
        $titles[$t][] = $path;
        if (mb_strlen($t) > 70) {
            $warnings[] = "{$where}: title is " . mb_strlen($t) . ' chars (>70): ' . $t;
        }
    }
    $d = $page['desc'];
    if ($d === '') {
        $errors[] = "{$where}: missing meta description";
    } else {
        $descs[$d][] = $path;
        $len = mb_strlen($d);
        if (empty($page['noindex']) && ($len < 70 || $len > 170)) {
            $warnings[] = "{$where}: description length {$len} (aim 70–170)";
        }
    }
    if (empty($page['noindex']) && !str_contains($html, '<link rel="canonical"')) {
        $errors[] = "{$where}: missing canonical";
    }
    if (!empty($page['noindex']) && !str_contains($html, 'noindex')) {
        $errors[] = "{$where}: noindex page without robots noindex";
    }

    preg_match_all('#\shref="([^"]+)"#', $html, $links);
    foreach (array_unique($links[1]) as $href) {
        $href = html_entity_decode($href, ENT_QUOTES);
        if (preg_match('#^(https?:|mailto:|tel:|\#)#', $href)) {
            continue;
        }
        if (!$resolves($href)) {
            $errors[] = "{$where}: broken internal link {$href}";
        }
    }
    preg_match_all('#\sid="([^"]+)"#', $html, $ids);
    foreach (array_count_values($ids[1]) as $id => $n) {
        if ($n > 1) {
            $errors[] = "{$where}: duplicate id \"{$id}\" ({$n}x)";
        }
    }
    $types = array_column($page['blocks'], 'type');
    if (in_array('faq', $types, true) && empty($page['noindex']) && !str_contains($html, '"FAQPage"')) {
        $errors[] = "{$where}: visible FAQ without FAQPage schema";
    }
    if ($page['template'] === 'article' && empty($page['noindex']) && !in_array('faq', $types, true) && !in_array($page['section'], ['utility'], true)) {
        $warnings[] = "{$where}: article page without an FAQ (AEO)";
    }
    if (acad_is_editorial($page) && $page['section'] !== 'glossary' && (!str_contains($html, '"Article"') || !in_array('takeaways', $types, true))) {
        $errors[] = "{$where}: guide/comparison missing Article schema or key takeaways";
    }
    if (acad_is_editorial($page) && !str_contains($html, 'class="page-meta"')) {
        $errors[] = "{$where}: editorial page missing visible last-updated line";
    }
    // Contact number must never appear in public HTML (see config/contact.php).
    $digits = preg_replace('/\D/', '', (string) acad_config('contact.CONTACT_PHONE'));
    if ($digits !== '' && str_contains(preg_replace('/\D/', '', $html) ?? '', substr($digits, -10))) {
        $errors[] = "{$where}: full contact number found in page output";
    }
    if (!in_array($path, ['/login.php', '/forgot-password.php', '/request-access.php'], true) && substr_count($html, ' data-acw ') !== 1) {
        $errors[] = "{$where}: enquiry widget must appear exactly once";
    }
    // Claims policy.
    $visible = strip_tags(preg_replace('#<(script|style)\b.*?</\1>#s', '', $html) ?? '');
    if (preg_match('/\b\d[\d,.]*\s?[KkMm]?\+?\s*(institutions|students|countries|universities|colleges|customers|users)\b|\b\d{2}\.\d+%|\buptime\b|trusted by (leading|top|\d)|#1\b|number one|world-class|market-leading|best-in-class|industry-leading|fast-to-deploy/i', $visible, $cm)) {
        $errors[] = "{$where}: unsupported claim \"{$cm[0]}\" (see docs/CLAIMS_REGISTER.md)";
    }
    if (($page['status'] ?? null) === 'planned') {
        if (!str_contains($html, 'class="status-notice"')) {
            $errors[] = "{$where}: planned page without the Planned / In development notice";
        }
        $strings = [$page['lead']];
        array_walk_recursive($page['blocks'], static function ($v, $k) use (&$strings) { if (is_string($v) && $k !== 'type') { $strings[] = $v; } });
        foreach ($strings as $str) {
            if (preg_match("/\bAcadlytic(?: AI)?(?:’s [a-z ]{2,30}?)? ({$claimVerbs})\b/", $str, $vm) || preg_match('/^Yes\.\s/', $str)) {
                $errors[] = "{$where}: present-tense availability claim \"" . mb_substr($str, 0, 70) . "…\"";
            }
        }
    }
    if (!empty($page['legal_draft'])) {
        if (!str_contains($html, 'LEGAL REVIEW REQUIRED — NOT FINAL') || empty($page['noindex'])) {
            $errors[] = "{$where}: legal draft missing marker or not noindex";
        }
        $launchBlockers[] = "{$where}: legal page awaiting counsel sign-off (legal_draft)";
    }
    if (!empty($page['draft'])) {
        $launchBlockers[] = "{$where}: page marked draft";
    }
    if (preg_match('#lorem ipsum|TODO|\{\{#i', strip_tags($html))) {
        $errors[] = "{$where}: placeholder text found";
    }

    // Content depth and cross-page duplication (article pages only).
    if ($page['template'] === 'article' && empty($page['noindex'])) {
        $text = acad_page_text($page);
        $words = str_word_count(strip_tags($text));
        $min = $page['section'] === 'glossary' ? 100 : 180;
        if ($words < $min) {
            $warnings[] = "{$where}: thin content ({$words} words, min {$min})";
        }
        foreach (preg_split('/(?<=[.!?])\s+/', $text) ?: [] as $s) {
            $s = trim($s);
            if (mb_strlen($s) >= 90) {
                $sentences[$s][$path] = true;
            }
        }
    }
}

foreach ($titles as $t => $paths) {
    if (count($paths) > 1) {
        $errors[] = 'Duplicate title "' . $t . '": ' . implode(', ', $paths);
    }
}
foreach ($descs as $d => $paths) {
    if (count($paths) > 1) {
        $errors[] = 'Duplicate description on ' . implode(', ', $paths);
    }
}
foreach ($sentences as $s => $paths) {
    if (count($paths) > 1) {
        $warnings[] = 'Sentence repeated on ' . implode(', ', array_keys($paths)) . ': "' . mb_substr($s, 0, 80) . '…"';
    }
}

foreach ($redirects as $from => $to) {
    if (!isset($pages[$to]) || !empty($pages[$to]['virtual'])) {
        $errors[] = "Redirect {$from} -> {$to}: target is not a page";
    }
    if (isset($redirects[$to])) {
        $errors[] = "Redirect chain {$from} -> {$to} -> {$redirects[$to]}";
    }
    if (!str_ends_with($from, '.php') && !is_file(ACAD_ROOT . rtrim($from, '/') . '/index.php')) {
        $errors[] = "Redirect {$from}: stub missing (run php bin/build.php)";
    }
}
foreach ($pages as $path => $page) {
    if (empty($page['virtual']) && !is_file(ACAD_ROOT . ($path === '/' ? '' : rtrim($path, '/')) . '/index.php')) {
        $errors[] = "{$path}: directory stub missing (run php bin/build.php)";
    }
}

// Navigation targets.
$nav = require ACAD_ROOT . '/data/nav.php';
array_walk_recursive($nav, static function ($v) use (&$errors, $resolves) {
    if (is_string($v) && str_starts_with($v, '/') && !$resolves($v)) {
        $errors[] = "nav.php: unresolved link {$v}";
    }
});

// Sitemap.
$sitemap = (string) @file_get_contents(ACAD_ROOT . '/sitemap.xml');
preg_match_all('#<loc>([^<]+)</loc>#', $sitemap, $locs);
$expected = array_filter(acad_public_pages(), static fn($p) => empty($p['virtual']) && $p['template'] !== 'search');
if (count($locs[1]) !== count($expected)) {
    $errors[] = 'sitemap.xml has ' . count($locs[1]) . ' URLs, expected ' . count($expected) . ' (run php bin/build.php)';
}
foreach ($locs[1] as $loc) {
    $p = (string) parse_url($loc, PHP_URL_PATH);
    if (!isset($pages[$p]) || !empty($pages[$p]['noindex'])) {
        $errors[] = "sitemap.xml lists non-indexable {$loc}";
    }
}

// Assets required by the deployment brief.
$llms = (string) @file_get_contents(ACAD_ROOT . '/llms.txt');
foreach ($expected as $p => $pg) {
    if ($pg['section'] !== 'home' && $pg['section'] !== 'utility' && !str_contains($llms, '(' . acad_url($p) . ')')) {
        $errors[] = "llms.txt missing {$p} (run php bin/build.php)";
    }
}
foreach (['/llms.txt', '/sitemap.xml', '/robots.txt'] as $pub) {
    $digits = substr(preg_replace('/\D/', '', (string) acad_config('contact.CONTACT_PHONE')), -10);
    if ($digits !== '' && str_contains(preg_replace('/\D/', '', (string) @file_get_contents(ACAD_ROOT . $pub)) ?? '', $digits)) {
        $errors[] = "{$pub}: contains the full contact number";
    }
}
foreach (['/assets/css/enquiry-widget.css', '/assets/js/enquiry-widget.js', '/components/enquiry-widget.php', '/components/enquiry-modal.php', '/config/contact.php', '/llms.txt', '/assets/css/main.css', '/assets/js/app.js', '/assets/img/logo-acadlytic.png', '/assets/img/logo-acadlytic.webp', '/assets/img/icons.svg', '/assets/img/og-image.png', '/favicon.ico', '/site.webmanifest', '/assets/img/favicon-32.png', '/assets/img/icon-192.png', '/assets/img/icon-512.png', '/assets/img/icon-maskable-512.png', '/assets/img/apple-touch-icon.png', '/assets/img/logo-square.png', '/assets/fonts/inter-var-latin.woff2', '/assets/fonts/manrope-var-latin.woff2', '/robots.txt', '/.htaccess'] as $a) {
    if (!is_file(ACAD_ROOT . $a)) {
        $errors[] = "Missing asset {$a}";
    }
}
if ((string) @file_get_contents(ACAD_ROOT . '/assets/img/icons.svg') !== acad_icon_sprite()) {
    $errors[] = 'assets/img/icons.svg is out of date (run php bin/build.php)';
}

// Icon names referenced in code and data.
$known = array_keys(acad_icon_paths());
$scan = array_merge(glob(ACAD_ROOT . '/includes/*.php') ?: [], glob(ACAD_ROOT . '/includes/*/*.php') ?: [], glob(ACAD_ROOT . '/data/*.php') ?: [], glob(ACAD_ROOT . '/data/pages/*.php') ?: []);
foreach ($scan as $file) {
    $src = (string) file_get_contents($file);
    preg_match_all("#icon\\('([a-z-]+)'#", $src, $m1);
    preg_match_all("#'icon'\\s*=>\\s*'([a-z-]+)'#", $src, $m2);
    foreach (array_merge($m1[1], $m2[1]) as $name) {
        if (!in_array($name, $known, true)) {
            $errors[] = basename($file) . ": unknown icon \"{$name}\"";
        }
    }
}

if ($launch) {
    foreach ($launchBlockers as $b) {
        $errors[] = 'LAUNCH BLOCKER ' . $b;
    }
}

$indexable = count($expected);
printf("Pages: %d (indexable in sitemap: %d) · Redirects: %d\n", count($pages), $indexable, count($redirects));
foreach ($warnings as $w) {
    echo "WARN  {$w}\n";
}
foreach (array_unique($errors) as $e) {
    echo "ERROR {$e}\n";
}
if (!$launch && $launchBlockers) {
    printf("Launch blockers (enforced with --launch): %d\n", count($launchBlockers));
}
printf("\n%d error(s), %d warning(s)\n", count(array_unique($errors)), count($warnings));
exit($errors ? 1 : 0);
