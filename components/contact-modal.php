<?php
/**
 * Enquiry form modal (native <dialog>: focus trapping and Escape handling
 * are built in). The form carries no session token in the cached page; the
 * widget script fetches one from /enquiry/token/ when the modal opens.
 */
declare(strict_types=1);

$formHtml = str_replace('action=""', 'action="/enquiry/"', acad_render_form('enquiry', [], 'Send Enquiry', [], false));
?>
<dialog class="acw-modal" id="acw-modal" aria-labelledby="acw-modal-title" data-acw-modal>
    <div class="acw-modal-inner">
        <div class="acw-modal-head">
            <div>
                <p class="acw-kicker">Acadlytic, Inc.</p>
                <h2 class="acw-modal-title" id="acw-modal-title">Send us an enquiry</h2>
                <p class="acw-modal-sub">Fields marked <span class="req">*</span> are required. We use these details only to respond to you.</p>
            </div>
            <button type="button" class="acw-close" aria-label="Close enquiry form" data-acw-modal-close><?= icon('close') ?></button>
        </div>
        <div data-acw-form-wrap>
            <div class="form-alert error" role="alert" tabindex="-1" hidden data-acw-alert></div>
            <?= $formHtml ?>
            <p class="acw-privacy">Read our <a href="/trust/privacy/">Privacy Policy</a>.</p>
        </div>
        <div class="acw-success" role="status" tabindex="-1" hidden data-acw-success>
            <span class="success-icon"><?= icon('check') ?></span>
            <h3>Enquiry received successfully.</h3>
            <p>Thank you for your interest in Acadlytic.<br>Our team will contact you shortly.</p>
            <button type="button" class="btn btn-outline" data-acw-modal-close>Close</button>
        </div>
    </div>
</dialog>
