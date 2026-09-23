<?php
/**
 * Standard content page: hero with "on this page" outline, content blocks,
 * contextual related links and the closing call to action.
 *
 * @var array $page
 * @var array $ctx
 */
declare(strict_types=1);

$outline = acad_outline($page);
$secondary = match ($page['section']) {
    'ai' => ['Explore Acadlytic AI', '/ai/'],
    'integrations' => ['All integrations', '/integrations/'],
    'resources', 'glossary', 'comparisons' => ['Explore the platform', '/platform/'],
    'solutions', 'industries' => ['Explore the platform', '/platform/'],
    'company', 'trust' => ['Talk to our team', '/core/contact/'],
    default => ['Explore the platform', '/platform/'],
};
$related = acad_related($page);
?>
<section class="hero hero-page">
    <div class="hero-grid-bg" aria-hidden="true"></div>
    <div class="container"><?= acad_breadcrumb_html($page) ?></div>
    <div class="container hero-inner">
        <div>
            <p class="eyebrow"><?= e($page['eyebrow']) ?></p>
            <h1><?= e($page['h1']) ?></h1>
            <p class="lead"><?= acad_inline($page['lead']) ?></p>
            <?php if (!empty($page['draft'])): ?>
            <p class="draft-banner" role="note"><?= icon('flag', 'icon icon-sm') ?><span><?= e($page['draft']) ?></span></p>
            <?php endif; ?>
            <?php if (empty($page['hide_cta'])): ?>
            <div class="hero-actions">
                <a class="btn btn-primary btn-lg" href="/company/request-demo/">Request a Demo <?= icon('arrow') ?></a>
                <a class="btn btn-outline btn-lg" href="<?= e($secondary[1]) ?>"><?= e($secondary[0]) ?></a>
            </div>
            <?php endif; ?>
        </div>
        <?php if (count($outline) >= 2): ?>
        <aside class="glance" aria-label="On this page">
            <div class="glance-head">
                <span class="glance-icon"><?= icon($page['icon']) ?></span>
                <p>On this page<small><?= count($outline) ?> sections</small></p>
            </div>
            <ol>
                <?php foreach ($outline as $anchor => $heading): ?>
                <li><a href="#<?= e($anchor) ?>"><?= e($heading) ?></a></li>
                <?php endforeach; ?>
            </ol>
        </aside>
        <?php endif; ?>
    </div>
</section>

<div class="container article">
    <div class="article-body">
        <?= acad_render_blocks($page) ?>
    </div>
</div>

<?php if ($related): ?>
<section class="related" aria-labelledby="related-h">
    <div class="container">
        <h2 id="related-h">Related reading</h2>
        <div class="link-grid">
            <?php foreach ($related as $target): ?>
            <?= acad_link_card($target) ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?= acad_cta_band() ?>
