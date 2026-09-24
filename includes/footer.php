<?php
/**
 * Shared footer: trust bar, five-column navigation, trust & governance row,
 * direct contact and legal bar.
 *
 * Governance officers (DPO, Grievance Redressal Officer) come from
 * config/site.php → governance, as designated by Acadlytic, Inc.
 *
 * @var array $page
 * @var array $nav
 */
declare(strict_types=1);

$trustCards = [
    ['Data Protection', 'A privacy-first approach to institutional and student data.', 'lock', '/trust/data-protection-officer/'],
    ['Enterprise Security', 'Security designed into architecture, access and operations.', 'shield', '/core/security/'],
    ['Role-Based Access', 'Designed so people see only what their role requires.', 'key', '/core/security/'],
    ['Cloud Infrastructure', 'Designed for scalable, resilient cloud delivery.', 'cloud', '/core/cloud-platform/'],
    ['Responsible Support', 'Named routes for help, privacy and grievances.', 'support', '/trust/grievance-redressal/'],
];
?>
</main>

<section class="trust-bar" aria-labelledby="trust-bar-h">
    <div class="container">
        <div class="trust-bar-head">
            <h2 id="trust-bar-h" class="trust-bar-title">Secure <span>•</span> Scalable <span>•</span> AI-Powered <span>•</span> Cloud-Ready <span>•</span> Accessible</h2>
        </div>
        <ul class="trust-cards">
            <?php foreach ($trustCards as [$title, $text, $ic, $href]): ?>
            <li><a class="trust-card" href="<?= e($href) ?>"><span class="trust-icon"><?= icon($ic) ?></span><span><strong><?= e($title) ?></strong><small><?= e($text) ?></small></span></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>

<footer class="site-footer">
    <div class="container footer-grid">
        <div class="footer-brand">
            <a class="footer-logo" href="/" aria-label="Acadlytic, Inc. home"><?= $logo('brand-logo', false) ?></a>
            <p class="footer-tagline"><?= e(acad_config('tagline')) ?></p>
            <p class="footer-pillars">AI <span>|</span> CRM <span>|</span> Cloud <span>|</span> Academic Management</p>
            <ul class="social-list" aria-label="Acadlytic on social media">
                <?php foreach (acad_config('social') as $key => $s): ?>
                <li><a class="social-link" href="<?= e($s['url']) ?>" rel="noopener me" target="_blank"><?= icon($key) ?><span class="sr-only">Acadlytic on <?= e($s['label']) ?> (opens in a new tab)</span></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php foreach ($nav['footer'] as $heading => $links): ?>
        <nav class="footer-col" aria-label="<?= e($heading) ?>">
            <h2 class="footer-heading"><?= e($heading) ?></h2>
            <ul>
                <?php foreach ($links as [$label, $href]): ?>
                <li><a href="<?= e($href) ?>"><?= e($label) ?></a></li>
                <?php endforeach; ?>
            </ul>
        </nav>
        <?php endforeach; ?>
    </div>

    <div class="container footer-governance">
        <div class="gov-block">
            <h2 class="footer-heading">Trust &amp; Governance</h2>
            <ul class="gov-links">
                <?php foreach ($nav['trust'] as [$label, $href]): ?>
                <li><a href="<?= e(acad_nav_href($href)) ?>"><?= e($label) ?></a></li>
                <?php endforeach; ?>
            </ul>
            <?php $dpo = acad_config('governance.dpo'); $gro = acad_config('governance.grievance'); ?>
            <p class="gov-note">Data Protection Officer: <?= e($dpo['name']) ?>, <a href="<?= e(acad_mailto($dpo['email'], $dpo['subject'])) ?>"><?= e($dpo['email']) ?></a> · Grievance Redressal Officer: <?= e($gro['name']) ?>, <a href="<?= e(acad_mailto($gro['email'], $gro['subject'])) ?>"><?= e($gro['email']) ?></a> · <a href="/trust/grievance-redressal/">Grievance redressal process</a></p>
        </div>
        <div class="contact-block">
            <h2 class="footer-heading">Contact</h2>
            <a class="contact-pill" href="<?= e(acad_mailto((string) acad_config('email'))) ?>"><?= icon('mail', 'icon icon-sm') ?><span><small>Email</small><?= e(acad_config('email')) ?></span></a>
            <a class="contact-pill" href="<?= e(acad_config('phone_href')) ?>"><?= icon('phone', 'icon icon-sm') ?><span><small>Phone</small><?= e(acad_config('phone')) ?></span></a>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container footer-bottom-inner">
            <p>© <?= date('Y') ?> Acadlytic, Inc. All rights reserved.</p>
            <ul>
                <li><a href="/trust/privacy/">Privacy</a></li>
                <li><a href="/trust/terms/">Terms</a></li>
                <li><a href="/core/security/">Security</a></li>
                <li><a href="/trust/accessibility/">Accessibility</a></li>
                <li><a href="/sitemap/">Sitemap</a></li>
            </ul>
        </div>
    </div>
</footer>
<?php require ACAD_ROOT . '/components/enquiry-widget.php'; ?>
</body>
</html>
