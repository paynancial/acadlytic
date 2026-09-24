<?php
/**
 * Shared footer: "Talk to Acadlytic" contact strip, brand column, four
 * navigation columns (data/nav.php → footer) and the legal bar.
 * Columns become accordions on phones (app.js); without JS they stay open.
 * The phone number is shown masked and dialled via /go/call/.
 *
 * @var array $page
 * @var array $nav
 */
declare(strict_types=1);

$social = acad_config('social');
$slug = static fn(string $s): string => trim((string) preg_replace('/[^a-z0-9]+/', '-', strtolower($s)), '-');
?>
</main>

<footer class="site-footer">
    <div class="container">
        <section class="footer-cta" aria-labelledby="footer-cta-h">
            <div class="footer-cta-intro">
                <h2 class="footer-cta-title" id="footer-cta-h">Talk to Acadlytic</h2>
                <p class="footer-cta-text">Questions about the platform, a demo or a partnership: our team will route your message to the right people.</p>
            </div>
            <ul class="footer-cta-contacts">
                <li><a href="<?= e(acad_mailto((string) acad_config('email'))) ?>"><span class="footer-cta-icon"><?= icon('mail', 'icon icon-sm') ?></span><span><small>Email</small><?= e(acad_config('email')) ?></span></a></li>
                <li><a href="<?= e(acad_config('phone_href')) ?>"><span class="footer-cta-icon"><?= icon('phone', 'icon icon-sm') ?></span><span><small>Phone</small><?= e(acad_config('phone')) ?></span></a></li>
                <li><a href="<?= e(acad_config('office.page')) ?>"><span class="footer-cta-icon"><?= icon('pin', 'icon icon-sm') ?></span><span><small>Office</small><?= e(acad_config('office.locality') . ', ' . acad_config('office.region') . ', ' . acad_config('office.country_name')) ?></span></a></li>
            </ul>
            <a class="btn footer-cta-btn" href="/company/request-demo/">Request a Demo <?= icon('arrow', 'icon icon-sm') ?></a>
        </section>

        <div class="footer-main">
            <div class="footer-brand">
                <a class="footer-logo" href="/" aria-label="Acadlytic, Inc. home"><?= acad_logo_light_html() ?></a>
                <p class="footer-tagline"><?= e(acad_config('tagline')) ?></p>
                <p class="footer-pillars">AI <span aria-hidden="true">|</span> CRM <span aria-hidden="true">|</span> Cloud <span aria-hidden="true">|</span> Academic Management</p>
                <p class="footer-about">Acadlytic, Inc. is building an AI-powered EdTech CRM and cloud platform that connects admissions, students, academics and operations for modern institutions.</p>
                <ul class="social-list" aria-label="Acadlytic on social media">
                    <?php foreach ($nav['footer_social'] as $key): if (empty($social[$key])) { continue; } ?>
                    <li><a class="social-link" href="<?= e($social[$key]['url']) ?>" rel="noopener me" target="_blank"><?= icon($key) ?><span class="sr-only">Acadlytic on <?= e($social[$key]['label']) ?> (opens in a new tab)</span></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php foreach ($nav['footer'] as $heading => $links): $id = 'fcol-' . $slug($heading); ?>
            <nav class="footer-col" aria-labelledby="<?= e($id) ?>-h" data-fcol>
                <h2 class="footer-heading" id="<?= e($id) ?>-h"><?= e($heading) ?></h2>
                <ul class="footer-links" id="<?= e($id) ?>">
                    <?php foreach ($links as [$label, $href]): ?>
                    <li><a href="<?= e($href) ?>"><?= e($label) ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </nav>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container footer-bottom-inner">
            <p>© <?= date('Y') ?> Acadlytic, Inc. All rights reserved.</p>
            <nav aria-label="Legal">
                <ul>
                    <?php foreach ($nav['footer_legal'] as [$label, $href]): ?>
                    <li><a href="<?= e($href) ?>"><?= e($label) ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </nav>
        </div>
    </div>
</footer>
<?php require ACAD_ROOT . '/components/enquiry-widget.php'; ?>
</body>
</html>
