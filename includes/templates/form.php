<?php
/**
 * Enquiry page (Request a Demo, Contact): short hero, form card with
 * validation and success state, contact aside, then supporting blocks.
 *
 * @var array $page
 * @var array $ctx
 */
declare(strict_types=1);

$form = (string) $page['form'];
$sent = !empty($ctx['sent']);
$prefill = [];
$interestMap = ['integrations' => 'Integrations', 'ai' => 'Analytics & AI', 'admissions' => 'Admissions & CRM', 'finance' => 'Finance & fees'];
if (isset($_GET['interest']) && is_string($_GET['interest']) && isset($interestMap[$_GET['interest']])) {
    $prefill['interest'] = $interestMap[$_GET['interest']];
}
if (isset($_GET['topic']) && is_string($_GET['topic']) && isset(acad_form_options()['topics'][$_GET['topic']])) {
    $prefill['topic'] = $_GET['topic'];
}
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
    <div class="form-layout" id="form">
        <div class="form-card">
            <?php if ($sent): ?>
            <div class="success-panel" role="status" tabindex="-1" data-success-focus>
                <span class="success-icon"><?= icon('check') ?></span>
                <h2><?= e($page['success_title']) ?></h2>
                <p class="muted"><?= e($page['success_text']) ?></p>
                <p><a class="btn btn-outline" href="/">Back to home</a></p>
            </div>
            <?php else: ?>
            <h2><?= e($page['form_title']) ?></h2>
            <p class="muted">Fields marked <span class="req">*</span> are required. We use these details only to respond to your request.</p>
            <?= acad_render_form($form, $ctx, (string) $page['submit'], $prefill) ?>
            <?php endif; ?>
        </div>
        <aside class="aside-card">
            <h2><?= e($page['aside_title']) ?></h2>
            <ul>
                <?php foreach ($page['aside_points'] as $pt): ?>
                <li><?= icon('check', 'icon check-icon') ?><span><?= e($pt) ?></span></li>
                <?php endforeach; ?>
            </ul>
            <div class="aside-contact">
                <a href="<?= e(acad_config('phone_href')) ?>"><?= icon('phone', 'icon icon-sm') ?><?= e(acad_config('phone')) ?></a>
                <a href="<?= e(acad_mailto((string) acad_config('email'))) ?>"><?= icon('mail', 'icon icon-sm') ?><?= e(acad_config('email')) ?></a>
            </div>
        </aside>
    </div>

    <?php if ($page['blocks']): ?>
    <div class="article-body hub-extra">
        <?= acad_render_blocks($page) ?>
    </div>
    <?php endif; ?>
</div>
