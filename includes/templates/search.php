<?php
/**
 * Site search over the content registry (server-side, no external service).
 *
 * @var array $page
 */
declare(strict_types=1);

$q = trim((string) (is_string($_GET['q'] ?? null) ? $_GET['q'] : ''));
$q = mb_substr($q, 0, 100);
$results = [];
if ($q !== '') {
    $terms = array_filter(preg_split('/\s+/', mb_strtolower($q)) ?: [], static fn($t) => mb_strlen($t) > 1);
    foreach (acad_public_pages() as $candidate) {
        if ($candidate['template'] === 'search') {
            continue;
        }
        $title = mb_strtolower($candidate['h1'] . ' ' . $candidate['title']);
        $body = mb_strtolower(acad_page_text($candidate));
        $score = 0;
        foreach ($terms as $term) {
            $score += substr_count($title, $term) * 8 + min(substr_count($body, $term), 10);
        }
        if ($score > 0) {
            $results[] = [$score, $candidate];
        }
    }
    usort($results, static fn($a, $b) => $b[0] <=> $a[0]);
    $results = array_slice($results, 0, 20);
}
?>
<section class="hero hero-page">
    <div class="hero-grid-bg" aria-hidden="true"></div>
    <div class="container"><?= acad_breadcrumb_html($page) ?></div>
    <div class="container hero-inner hero-compact">
        <div>
            <p class="eyebrow">Search</p>
            <h1><?= e($page['h1']) ?></h1>
            <form class="search-form" action="/search/" method="get" role="search">
                <label class="sr-only" for="site-q">Search Acadlytic</label>
                <input id="site-q" type="search" name="q" value="<?= e($q) ?>" placeholder="Try “admissions”, “SSO” or “student success”" autofocus>
                <button class="btn btn-primary btn-lg" type="submit"><?= icon('search', 'icon icon-sm') ?> Search</button>
            </form>
        </div>
    </div>
</section>
<div class="container article">
    <?php if ($q === ''): ?>
    <p class="muted">Search across <?= count(acad_public_pages()) ?> pages covering the platform, AI, solutions, integrations and resources.</p>
    <?php elseif (!$results): ?>
    <p role="status">No pages matched “<?= e($q) ?>”. Try a broader term, browse the <a href="/sitemap/">sitemap</a> or <a href="/core/contact/">ask our team</a>.</p>
    <?php else: ?>
    <p class="muted" role="status"><?= count($results) ?> result<?= count($results) > 1 ? 's' : '' ?> for “<?= e($q) ?>”</p>
    <ul class="result-list">
        <?php foreach ($results as [, $r]): ?>
        <li><?= acad_link_card($r) ?></li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>
</div>
