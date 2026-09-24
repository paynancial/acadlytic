<?php
/**
 * Human-readable sitemap grouped by section (also the no-JS fallback for
 * the mobile menu button).
 *
 * @var array $page
 */
declare(strict_types=1);

$bySection = [];
foreach (acad_public_pages() as $p) {
    $bySection[$p['section']][] = $p;
}
$order = ['home', 'core', 'platform', 'ai', 'solutions', 'industries', 'integrations', 'resources', 'comparisons', 'glossary', 'company', 'trust', 'utility'];
$labels = ['home' => 'Home', 'core' => 'Company & platform essentials', 'utility' => 'Site tools'] + array_map(static fn($s) => $s['label'], acad_sections());
?>
<section class="hero hero-page">
    <div class="hero-grid-bg" aria-hidden="true"></div>
    <div class="container"><?= acad_breadcrumb_html($page) ?></div>
    <div class="container hero-inner hero-compact">
        <div>
            <p class="eyebrow"><?= e($page['eyebrow']) ?></p>
            <h1><?= e($page['h1']) ?></h1>
            <p class="lead"><?= e($page['lead']) ?></p>
        </div>
    </div>
</section>
<div class="container article">
    <div class="sitemap-cols">
        <?php foreach ($order as $key): if (empty($bySection[$key])) { continue; } ?>
        <section class="sitemap-group" aria-labelledby="sm-<?= e($key) ?>">
            <h2 id="sm-<?= e($key) ?>"><?= e($labels[$key] ?? ucfirst($key)) ?></h2>
            <ul>
                <?php foreach ($bySection[$key] as $p): ?>
                <li><a href="<?= e($p['path']) ?>"><?= e($p['nav_label'] ?: $p['h1']) ?></a></li>
                <?php endforeach; ?>
            </ul>
        </section>
        <?php endforeach; ?>
    </div>
</div>
