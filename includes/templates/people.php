<?php
/**
 * Leadership / team listing from data/people.php (page key: people_group).
 *
 * @var array $page
 */
declare(strict_types=1);

$people = (require ACAD_ROOT . '/data/people.php')[$page['people_group']] ?? [];
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
    <?php if ($people): ?>
    <ul class="people-grid" aria-label="<?= e($page['h1']) ?>">
        <?php foreach ($people as $person): ?>
        <li class="person-card">
            <?php if (!empty($person['photo'])): ?>
            <img class="person-photo" src="<?= e(asset($person['photo'])) ?>" width="96" height="96" alt="<?= e($person['name']) ?>" loading="lazy" decoding="async">
            <?php else: ?>
            <span class="person-initials" aria-hidden="true"><?= e(implode('', array_map(static fn($w) => mb_substr($w, 0, 1), array_slice(preg_split('/\s+/', $person['name']) ?: [], 0, 2)))) ?></span>
            <?php endif; ?>
            <h2 class="person-name"><?= e($person['name']) ?></h2>
            <p class="person-role"><?= e($person['role']) ?></p>
            <?php if (!empty($person['bio'])): ?><p class="person-bio"><?= e($person['bio']) ?></p><?php endif; ?>
            <?php if (!empty($person['linkedin'])): ?><a class="person-link" href="<?= e($person['linkedin']) ?>" rel="noopener" target="_blank"><?= icon('linkedin', 'icon icon-sm') ?> LinkedIn<span class="sr-only"> profile of <?= e($person['name']) ?> (opens in a new tab)</span></a><?php endif; ?>
        </li>
        <?php endforeach; ?>
    </ul>
    <?php else: ?>
    <aside class="block note" aria-label="In preparation"><strong>In preparation</strong><p><?= acad_inline($page['empty_text']) ?></p></aside>
    <?php endif; ?>
    <?php if ($page['blocks']): ?>
    <div class="article-body hub-extra"><?= acad_render_blocks($page) ?></div>
    <?php endif; ?>
</div>
<?= acad_cta_band() ?>
