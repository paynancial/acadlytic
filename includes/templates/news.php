<?php
/**
 * Company news from data/news.php.
 *
 * @var array $page
 */
declare(strict_types=1);

$items = require ACAD_ROOT . '/data/news.php';
?>
<section class="hero hero-page">
    <div class="hero-grid-bg" aria-hidden="true"></div>
    <div class="container"><?= acad_breadcrumb_html($page) ?></div>
    <div class="container hero-inner hero-compact">
        <div>
            <p class="eyebrow"><?= e($page['eyebrow']) ?></p>
            <h1><?= e($page['h1']) ?></h1>
            <p class="lead"><?= acad_inline($page['lead']) ?></p>
        </div>
    </div>
</section>
<div class="container article">
    <?php if ($items): ?>
    <ol class="news-list">
        <?php foreach ($items as $item): ?>
        <li class="news-item">
            <time datetime="<?= e($item['date']) ?>"><?= e(date('j F Y', (int) strtotime($item['date']))) ?></time>
            <h2><?php if (!empty($item['url'])): ?><a href="<?= e($item['url']) ?>"><?= e($item['title']) ?></a><?php else: ?><?= e($item['title']) ?><?php endif; ?></h2>
            <p><?= e($item['summary']) ?></p>
        </li>
        <?php endforeach; ?>
    </ol>
    <?php else: ?>
    <aside class="block note" aria-label="In preparation"><strong>No announcements yet</strong><p><?= acad_inline($page['empty_text']) ?></p></aside>
    <?php endif; ?>
    <?php if ($page['blocks']): ?>
    <div class="article-body hub-extra"><?= acad_render_blocks($page) ?></div>
    <?php endif; ?>
</div>
<?= acad_cta_band() ?>
