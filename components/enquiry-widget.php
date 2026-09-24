<?php
/**
 * Floating "Enquire Now" widget: button, three-action panel and the enquiry
 * modal. Included once, from includes/footer.php, on every public page.
 *
 * - Without JavaScript the button is a plain link to the contact page.
 * - The phone number is never rendered: call and WhatsApp use the
 *   number-free /go/ redirects and the UI shows CONTACT_PHONE_DISPLAY.
 * - Styles and script are loaded here (end of body) so they never block
 *   first render; the button is position:fixed, so there is no layout shift.
 */
declare(strict_types=1);

$c = (array) acad_config('contact');
?>
<link rel="stylesheet" href="<?= e(asset('/assets/css/enquiry-widget.css')) ?>">
<aside class="acw" data-acw aria-label="Contact Acadlytic">
    <a class="acw-fab" href="/core/contact/" aria-controls="acw-panel" aria-expanded="false" aria-haspopup="dialog" data-acw-toggle>
        <span class="acw-fab-icon"><?= icon('message') ?></span>
        <span class="acw-fab-label">Enquire now</span>
        <span class="acw-tip" aria-hidden="true">Talk to Acadlytic</span>
    </a>

    <section class="acw-panel" id="acw-panel" role="dialog" aria-modal="false" aria-labelledby="acw-title" aria-describedby="acw-desc" hidden data-acw-panel>
        <div class="acw-head">
            <div>
                <h2 class="acw-title" id="acw-title">Let’s Connect</h2>
                <p class="acw-sub">How can we help you?</p>
            </div>
            <button type="button" class="acw-close" aria-label="Close enquiry options" data-acw-close><?= icon('close') ?></button>
        </div>
        <p class="acw-desc" id="acw-desc">Talk to the Acadlytic team about our AI-powered academic management platform.</p>
        <ul class="acw-actions">
            <li>
                <button type="button" class="acw-action" data-acw-open-form>
                    <span class="acw-action-icon acw-i-form"><?= icon('doc') ?></span>
                    <span class="acw-action-body"><strong>Fill Enquiry Form</strong><small>Share your requirements in a minute</small></span>
                    <span class="acw-action-arrow"><?= icon('arrow', 'icon icon-sm') ?></span>
                </button>
            </li>
            <li>
                <a class="acw-action" href="<?= e(acad_mailto((string) $c['CONTACT_EMAIL'], 'Enquiry from acadlytic.com')) ?>" data-acw-event="email_click">
                    <span class="acw-action-icon acw-i-mail"><?= icon('mail') ?></span>
                    <span class="acw-action-body"><strong>Email Us</strong><small>Open your email app →</small></span>
                    <span class="acw-action-arrow"><?= icon('arrow', 'icon icon-sm') ?></span>
                </a>
            </li>
            <li>
                <a class="acw-action" href="<?= e((string) $c['WHATSAPP_URL']) ?>" target="_blank" rel="noopener nofollow" data-acw-event="whatsapp_click">
                    <span class="acw-action-icon acw-i-wa"><?= icon('whatsapp') ?></span>
                    <span class="acw-action-body"><strong>WhatsApp Us</strong><small>Chat with our team (opens WhatsApp)</small></span>
                    <span class="acw-action-arrow"><?= icon('arrow', 'icon icon-sm') ?></span>
                </a>
            </li>
        </ul>
        <p class="acw-call">
            Prefer to talk?
            <a href="<?= e((string) $c['CALL_URL']) ?>" rel="nofollow" data-acw-event="call_click" aria-label="Call Acadlytic"><?= icon('phone', 'icon icon-xs') ?><span aria-hidden="true"><?= e((string) $c['CONTACT_PHONE_DISPLAY']) ?></span></a>
        </p>
    </section>

    <template data-acw-modal-tpl><?php require ACAD_ROOT . '/components/enquiry-modal.php'; ?></template>
</aside>
<script src="<?= e(asset('/assets/js/enquiry-widget.js')) ?>" defer></script>
