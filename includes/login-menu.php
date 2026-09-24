<?php
/**
 * Login access selector (utility bar popover). This only routes people to
 * the standalone sign-in page with a workspace hint. It never collects
 * credentials itself.
 *
 * @var array $nav
 */
declare(strict_types=1);
?>
<div class="login-menu" data-popover>
    <button type="button" class="util-link login-trigger" aria-expanded="false" aria-controls="login-popover" data-popover-trigger>
        <?= icon('lock', 'icon icon-sm') ?><span>Login</span><?= icon('chevron', 'icon icon-xs chev') ?>
    </button>
    <div class="login-popover" id="login-popover" data-popover-panel>
        <div class="login-pop-head">
            <p class="login-pop-kicker">Access your Acadlytic account</p>
            <p class="login-pop-title">Choose your workspace</p>
            <p class="login-pop-note">Workspace access is opening in phases.</p>
        </div>
        <ul class="workspace-list">
            <?php foreach ($nav['workspaces'] as $key => [$label, $text, $ic]): ?>
            <li>
                <a class="workspace-option" href="/login.php?workspace=<?= e($key) ?>">
                    <span class="ws-icon"><?= icon($ic) ?></span>
                    <span class="ws-body"><strong><?= e($label) ?></strong><span><?= e($text) ?></span></span>
                    <span class="ws-arrow"><?= icon('arrow', 'icon icon-sm') ?></span>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
        <div class="login-pop-foot">
            <p class="login-help">Need help? <a href="<?= e(acad_mailto((string) acad_config('support_email'), 'Account access help')) ?>"><?= e(acad_config('support_email')) ?></a></p>
            <a class="btn btn-primary btn-block" href="/login.php">Continue to Login <?= icon('arrow') ?></a>
            <p class="login-assure"><?= icon('shield', 'icon icon-xs') ?> Secure sign-in · Encrypted connection</p>
        </div>
    </div>
</div>
