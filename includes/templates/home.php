<?php
/**
 * Homepage. Follows the approved reference layout but deliberately omits
 * unverified proof (customer logos, counts, percentages, testimonials).
 * The product preview is labelled as sample data.
 *
 * @var array $page
 */
declare(strict_types=1);

$modules = [
    ['Admissions & CRM', 'Capture, nurture and convert enquiries with a complete applicant timeline.', 'users', '/platform/admissions-crm/'],
    ['Student Management', 'One trusted record for every student, from enrolment to completion.', 'cap', '/platform/student-management/'],
    ['Academic Operations', 'Timetables, attendance, assessments and academic calendars.', 'calendar', '/platform/academic-operations/'],
    ['Finance & Fees', 'Fee structures, invoices, payments and reconciliation.', 'rupee', '/platform/finance-fees/'],
    ['Communication Hub', 'Email, SMS and WhatsApp with context and consent.', 'message', '/platform/communication-hub/'],
    ['Analytics & AI', 'Dashboards, reports and AI-generated insights.', 'chart', '/platform/reports-insights/'],
    ['Document Management', 'Collect, verify and share documents securely.', 'doc', '/platform/electronic-document-sharing/'],
    ['Integrations', 'Connect your SIS, LMS, ERP, payments and identity.', 'plug', '/integrations/'],
];
$stakeholders = [
    ['For Institutions', 'Institution-wide visibility and consistent processes across departments and campuses.', 'building', '/industries/'],
    ['For Administrators', 'Fewer spreadsheets, fewer hand-offs, clearer ownership of every task.', 'dashboard', '/solutions/for-administrators/'],
    ['For Faculty', 'Attendance, assessments and student context without the admin drag.', 'book', '/solutions/for-faculty/'],
    ['For Students', 'One place for applications, documents, deadlines and updates.', 'cap', '/solutions/for-students/'],
    ['For Parents', 'Timely, relevant information about progress, fees and events.', 'message', '/solutions/for-parents/'],
];
$measures = [
    ['Enquiry response time', 'How quickly every enquiry receives a first, relevant reply.', 'message'],
    ['Application completion', 'Where applicants stall, and which follow-ups move them forward.', 'task'],
    ['Student engagement', 'Attendance, participation and support signals in one view.', 'users'],
    ['Reporting effort', 'Hours your teams spend compiling reports by hand.', 'chart'],
];
?>
<section class="hero home-hero">
    <div class="hero-grid-bg" aria-hidden="true"></div>
    <div class="container hero-inner">
        <div>
            <p class="eyebrow">AI-powered academic management platform</p>
            <h1><span class="nowrap">Smarter Education.</span><br><span class="gradient-text nowrap">Intelligent Operations.</span></h1>
            <p class="lead"><?= e($page['lead']) ?></p>
            <div class="hero-actions">
                <a class="btn btn-primary btn-lg" href="/company/request-demo/">Request a Demo <?= icon('arrow') ?></a>
                <a class="btn btn-outline btn-lg" href="/ai/">Explore Acadlytic AI <?= icon('arrow') ?></a>
            </div>
            <ul class="hero-pillars" aria-label="Platform pillars">
                <li><?= icon('ai', 'icon icon-sm') ?>AI insights</li>
                <li><?= icon('users', 'icon icon-sm') ?>Unified CRM</li>
                <li><?= icon('cloud', 'icon icon-sm') ?>Cloud platform</li>
                <li><?= icon('trend', 'icon icon-sm') ?>Built to scale</li>
            </ul>
        </div>

        <div class="product-stage">
            <figure class="app-window" aria-label="Illustrative preview of the Acadlytic dashboard using sample data">
                <div class="app-top" aria-hidden="true"><i></i><i></i><i></i><span>Acadlytic · Institution dashboard</span><span class="sample-tag">SAMPLE DATA</span></div>
                <div class="app-body" aria-hidden="true">
                    <div class="app-side">
                        <span class="on"><?= icon('dashboard') ?>Dashboard</span>
                        <span><?= icon('users') ?>Admissions</span>
                        <span><?= icon('cap') ?>Students</span>
                        <span><?= icon('calendar') ?>Academics</span>
                        <span><?= icon('rupee') ?>Finance</span>
                        <span><?= icon('message') ?>Communication</span>
                        <span><?= icon('chart') ?>Reports</span>
                        <span><?= icon('doc') ?>Documents</span>
                    </div>
                    <div class="app-main">
                        <p class="app-greet">Good morning<small>Here is what needs attention today</small></p>
                        <div class="kpis">
                            <div class="kpi"><small>New enquiries</small><b>64</b><em>This week</em></div>
                            <div class="kpi"><small>Applications</small><b>218</b><em>In progress</em></div>
                            <div class="kpi"><small>Fees due</small><b>37</b><em>Reminders queued</em></div>
                            <div class="kpi"><small>Open tasks</small><b>12</b><em>Assigned to you</em></div>
                        </div>
                        <div class="app-panels">
                            <div class="app-panel">
                                <p>Enrolment pipeline</p>
                                <svg class="line-chart" viewBox="0 0 300 110" preserveAspectRatio="none">
                                    <defs><linearGradient id="lg-fill" x1="0" y1="0" x2="0" y2="1"><stop offset="0" stop-color="#168AF7" stop-opacity=".28"/><stop offset="1" stop-color="#168AF7" stop-opacity="0"/></linearGradient></defs>
                                    <path d="M0 88 L50 76 L100 80 L150 58 L200 50 L250 34 L300 22 L300 110 L0 110Z" fill="url(#lg-fill)"/>
                                    <path d="M0 88 L50 76 L100 80 L150 58 L200 50 L250 34 L300 22" fill="none" stroke="#0B63F6" stroke-width="2.5" stroke-linejoin="round"/>
                                    <path d="M0 96 L50 92 L100 90 L150 82 L200 78 L250 70 L300 64" fill="none" stroke="#14CFE8" stroke-width="2" stroke-dasharray="4 4"/>
                                </svg>
                            </div>
                            <div class="app-panel">
                                <p>Students by programme</p>
                                <svg class="donut" viewBox="0 0 42 42">
                                    <circle cx="21" cy="21" r="15.9" fill="none" stroke="#EAF4FF" stroke-width="6"/>
                                    <circle cx="21" cy="21" r="15.9" fill="none" stroke="#0B63F6" stroke-width="6" stroke-dasharray="58 42" stroke-dashoffset="25"/>
                                    <circle cx="21" cy="21" r="15.9" fill="none" stroke="#14CFE8" stroke-width="6" stroke-dasharray="27 73" stroke-dashoffset="-33"/>
                                    <circle cx="21" cy="21" r="15.9" fill="none" stroke="#9CC2FB" stroke-width="6" stroke-dasharray="15 85" stroke-dashoffset="-60"/>
                                </svg>
                                <ul class="legend"><li><i></i>Undergraduate</li><li><i class="c2"></i>Postgraduate</li><li><i class="c3"></i>Other</li></ul>
                            </div>
                        </div>
                    </div>
                </div>
            </figure>
            <div class="ai-float" aria-label="Acadlytic AI Assistant example prompts">
                <div class="ai-float-head"><span class="ai-orb"><?= icon('ai') ?></span><span><strong>Acadlytic AI</strong><small>Assistant</small></span><span class="ai-live" aria-hidden="true"></span></div>
                <p class="ai-q">How can I help today?</p>
                <ul class="ai-chips">
                    <li><?= icon('trend') ?>Show admissions trends</li>
                    <li><?= icon('flag') ?>Find at-risk students</li>
                    <li><?= icon('doc') ?>Generate report</li>
                    <li><?= icon('message') ?>Draft communication</li>
                    <li><?= icon('chart') ?>Explain analytics</li>
                </ul>
                <div class="ai-input" aria-hidden="true">Ask anything…<b><?= icon('arrow') ?></b></div>
            </div>
        </div>
    </div>
</section>

<section class="fit-strip" aria-label="Who Acadlytic is built for">
    <div class="container fit-inner">
        <p>Built for modern education</p>
        <ul class="fit-list">
            <li><?= icon('building', 'icon icon-sm') ?>Universities</li>
            <li><?= icon('cap', 'icon icon-sm') ?>Colleges</li>
            <li><?= icon('globe', 'icon icon-sm') ?>Multi-campus groups</li>
            <li><?= icon('cloud', 'icon icon-sm') ?>Online &amp; professional education</li>
            <li><?= icon('handshake', 'icon icon-sm') ?>EdTech partners</li>
        </ul>
    </div>
</section>

<section class="section" aria-labelledby="eco-h">
    <div class="container">
        <div class="section-head">
            <p class="eyebrow">One intelligent academic ecosystem</p>
            <h2 id="eco-h">Everything your institution runs on.<br><span class="gradient-text">Connected by AI.</span></h2>
            <p>Eight connected modules on one data model, so admissions, academics, finance and communication stop living in separate spreadsheets.</p>
        </div>
        <div class="module-grid">
            <?php foreach ($modules as [$title, $text, $ic, $href]): ?>
            <a class="module" href="<?= e($href) ?>">
                <span class="info-icon"><?= icon($ic) ?></span>
                <h3><?= e($title) ?></h3>
                <p><?= e($text) ?></p>
                <span class="text-link">Explore <?= icon('arrow', 'icon icon-sm') ?></span>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section ai-section" aria-labelledby="ai-h">
    <div class="container ai-grid">
        <div>
            <p class="eyebrow on-dark">Acadlytic AI</p>
            <h2 id="ai-h">AI that works for education, <span class="gradient-text">not around it.</span></h2>
            <p>Acadlytic AI lives inside the workflows your teams already use. It reads context, drafts, summarises and flags, and it leaves consequential decisions with people.</p>
            <ul class="ai-list">
                <li><?= icon('check', 'icon check-icon') ?><span>Forecast enquiry and enrolment trends from your own history</span></li>
                <li><?= icon('check', 'icon check-icon') ?><span>Surface students who may need support, with the reasons shown</span></li>
                <li><?= icon('check', 'icon check-icon') ?><span>Draft personalised communications for staff to review</span></li>
                <li><?= icon('check', 'icon check-icon') ?><span>Turn dashboards into plain-language summaries for leadership</span></li>
                <li><?= icon('check', 'icon check-icon') ?><span>Recommend next-best actions for admissions and advising teams</span></li>
            </ul>
            <div class="hero-actions">
                <a class="btn btn-primary btn-lg" href="/ai/">Explore Acadlytic AI <?= icon('arrow') ?></a>
                <a class="btn btn-glass btn-lg" href="/ai/responsible-ai/">Our responsible AI approach</a>
            </div>
        </div>
        <div class="ai-cards">
            <div class="ai-card"><span class="info-icon"><?= icon('ai') ?></span><h3>AI Assistant</h3><p>Ask questions of your data in plain language and get answers with sources.</p></div>
            <div class="ai-card"><span class="info-icon"><?= icon('flag') ?></span><h3>Student success signals</h3><p>Early indicators from attendance, submissions and engagement.</p></div>
            <div class="ai-card"><span class="info-icon"><?= icon('chart') ?></span><h3>Narrative reporting</h3><p>Summaries that explain what changed and why it matters.</p></div>
            <div class="ai-card"><span class="info-icon"><?= icon('doc') ?></span><h3>Document intelligence</h3><p>Classify submitted documents and pre-fill checks for staff.</p></div>
            <div class="ai-card wide"><span class="info-icon"><?= icon('shield') ?></span><div><h3>People stay in control</h3><p>Every AI suggestion is explainable, reviewable and logged. Nothing is sent or decided automatically unless your institution chooses to allow it.</p></div></div>
        </div>
    </div>
</section>

<section class="section" aria-labelledby="stake-h">
    <div class="container">
        <div class="section-head">
            <p class="eyebrow">Designed for every stakeholder</p>
            <h2 id="stake-h">One platform. <span class="gradient-text">Everyone connected.</span></h2>
            <p>Role-based workspaces give each person the information and actions they need, and nothing they should not see.</p>
        </div>
        <div class="stake-grid">
            <?php foreach ($stakeholders as [$title, $text, $ic, $href]): ?>
            <a class="stake" href="<?= e($href) ?>">
                <span class="stake-art"><?= icon($ic) ?></span>
                <span class="stake-body"><h3><?= e($title) ?></h3><p><?= e($text) ?></p><span class="text-link">Learn more <?= icon('arrow', 'icon icon-sm') ?></span></span>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section section-soft" aria-labelledby="measure-h">
    <div class="container">
        <div class="section-head">
            <p class="eyebrow">Measurable impact</p>
            <h2 id="measure-h">Measure what matters, <span class="gradient-text">from day one.</span></h2>
            <p>We agree the baseline with you during onboarding, then track the operational measures your leadership cares about.</p>
        </div>
        <div class="measure-grid">
            <?php foreach ($measures as [$title, $text, $ic]): ?>
            <div class="measure"><span class="info-icon"><?= icon($ic) ?></span><h3><?= e($title) ?></h3><p><?= e($text) ?></p></div>
            <?php endforeach; ?>
        </div>
        <p class="honest-note">We publish outcome figures only when they are verified with the institutions involved.</p>
    </div>
</section>

<section class="section" aria-labelledby="sec-h">
    <div class="container sec-grid">
        <div>
            <p class="eyebrow">Secure. Scalable. Connected.</p>
            <h2 id="sec-h">Built for a <span class="gradient-text">connected world.</span></h2>
            <p class="lead">A cloud architecture designed around privacy, role-based access and integration with the systems you already run.</p>
            <div class="hero-actions">
                <a class="btn btn-outline btn-lg" href="/core/security/">Visit the Security Center</a>
                <a class="btn btn-ghost btn-lg" href="/integrations/">See integrations <?= icon('arrow') ?></a>
            </div>
        </div>
        <div class="sec-cards">
            <div class="sec-card"><span class="info-icon"><?= icon('cloud') ?></span><div><h3>Cloud infrastructure</h3><p>Scalable, resilient and available wherever your teams work.</p></div></div>
            <div class="sec-card"><span class="info-icon"><?= icon('shield') ?></span><div><h3>Data security</h3><p>Encryption in transit, least-privilege access and audit trails.</p></div></div>
            <div class="sec-card"><span class="info-icon"><?= icon('key') ?></span><div><h3>Role-based access</h3><p>Permissions by role, department and campus.</p></div></div>
            <div class="sec-card"><span class="info-icon"><?= icon('plug') ?></span><div><h3>Integrations</h3><p>SIS, LMS, ERP, payments, SSO and messaging.</p></div></div>
        </div>
    </div>
</section>

<section class="section section-soft" aria-labelledby="global-h">
    <div class="container">
        <div class="global-band">
            <div class="global-copy">
                <p class="eyebrow">Education without borders</p>
                <h2 id="global-h">Our commitments to every institution we work with</h2>
                <ul class="principles">
                    <li><?= icon('check', 'icon check-icon') ?><span><strong>Your data stays yours.</strong> Export it any time, in open formats.</span></li>
                    <li><?= icon('check', 'icon check-icon') ?><span><strong>Honest AI.</strong> Suggestions are explained, and people make the decisions.</span></li>
                    <li><?= icon('check', 'icon check-icon') ?><span><strong>Real proof only.</strong> No invented statistics or testimonials.</span></li>
                    <li><?= icon('check', 'icon check-icon') ?><span><strong>Reachable people.</strong> Named routes for support, privacy and grievances.</span></li>
                </ul>
            </div>
            <div class="global-visual" aria-hidden="true">
                <svg viewBox="0 0 400 260" fill="none">
                    <g stroke="rgba(20,207,232,.35)" stroke-width="1.2">
                        <path d="M60 170 Q140 60 220 110"/><path d="M220 110 Q290 40 340 90"/><path d="M60 170 Q200 230 330 180"/><path d="M120 80 Q180 150 220 110"/><path d="M220 110 Q270 170 330 180"/><path d="M120 80 Q230 20 340 90"/>
                    </g>
                    <g fill="rgba(255,255,255,.12)">
                        <?php for ($y = 30; $y < 240; $y += 16): for ($x = 20; $x < 390; $x += 16): if ((($x * 7 + $y * 3) % 5) === 0): ?><circle cx="<?= $x ?>" cy="<?= $y ?>" r="1.6"/><?php endif; endfor; endfor; ?>
                    </g>
                    <g fill="#14CFE8"><circle cx="60" cy="170" r="5"/><circle cx="220" cy="110" r="6"/><circle cx="340" cy="90" r="5"/><circle cx="330" cy="180" r="4"/><circle cx="120" cy="80" r="4"/></g>
                    <g fill="none" stroke="#14CFE8" stroke-opacity=".35"><circle cx="220" cy="110" r="14"/><circle cx="220" cy="110" r="24"/></g>
                </svg>
            </div>
        </div>
    </div>
</section>

<?= acad_cta_band("Let's build a smarter academic future together.", 'Discover how Acadlytic can connect your people, processes and intelligence on one platform.') ?>
