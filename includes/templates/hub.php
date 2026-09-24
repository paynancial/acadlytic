<?php
/**
 * Section hub: introduction, optional grouped listings (page `groups`) or
 * all child pages, then any additional explanatory blocks.
 *
 * @var array $page
 */
declare(strict_types=1);

$children = acad_children($page['path']);
$groups = $page['groups'] ?? [['title' => null, 'text' => null, 'paths' => array_keys($children)]];
?>
<section class="hero hero-page">
    <div class="hero-grid-bg" aria-hidden="true"></div>
    <div class="container"><?= acad_breadcrumb_html($page) ?></div>
    <div class="container hero-inner">
        <div>
            <p class="eyebrow"><?= e($page['eyebrow']) ?></p>
            <h1><?= e($page['h1']) ?></h1>
            <p class="lead"><?= acad_inline($page['lead']) ?></p>
            <?= acad_status_notice($page) ?>
            <?= acad_legal_marker($page) ?>
            <div class="hero-actions">
                <a class="btn btn-primary btn-lg" href="/company/request-demo/">Request a Demo <?= icon('arrow') ?></a>
                <a class="btn btn-outline btn-lg" href="/core/contact/">Talk to Our Team</a>
            </div>
        </div>
        <aside class="glance" aria-label="In this section">
            <div class="glance-head">
                <span class="glance-icon"><?= icon($page['icon']) ?></span>
                <p>In this section<small><?= count(array_merge(...array_map(static fn($g) => $g['paths'], $groups))) ?> pages</small></p>
            </div>
            <ol>
                <?php foreach ($groups as $gi => $group): if (!$group['title']) { continue; } ?>
                <li><a href="#g<?= $gi ?>"><?= e($group['title']) ?></a></li>
                <?php endforeach; ?>
                <?php if (count($groups) === 1): foreach (array_slice($groups[0]['paths'], 0, 6) as $p): $t = acad_page($p); if (!$t) { continue; } ?>
                <li><a href="<?= e($p) ?>"><?= e($t['nav_label'] ?: $t['h1']) ?></a></li>
                <?php endforeach; endif; ?>
            </ol>
        </aside>
    </div>
</section>

<div class="container article">
    <?php foreach ($groups as $gi => $group): ?>
    <section class="hub-group" id="g<?= $gi ?>"<?= $group['title'] ? ' aria-labelledby="g' . $gi . '-h"' : ' aria-label="' . e($page['h1']) . '"' ?>>
        <?php if ($group['title']): ?>
        <h2 id="g<?= $gi ?>-h"><?= e($group['title']) ?></h2>
        <?php endif; ?>
        <?php if (!empty($group['text'])): ?>
        <p><?= acad_inline($group['text']) ?></p>
        <?php endif; ?>
        <div class="link-grid">
            <?php foreach ($group['paths'] as $p): $target = acad_page($p); if (!$target) { continue; } ?>
            <?= acad_link_card($target) ?>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endforeach; ?>

    <?php if ($page['blocks']): ?>
    <div class="article-body hub-extra">
        <?= acad_render_blocks($page) ?>
    </div>
    <?php endif; ?>
</div>

<?= acad_cta_band() ?>
