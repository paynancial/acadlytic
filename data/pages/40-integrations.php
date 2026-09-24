<?php
/**
 * Integrations hub and pages. Named third-party connectors are not claimed;
 * pages describe supported patterns, and specific providers are confirmed
 * during evaluation.
 */
declare(strict_types=1);

return [
    '/integrations/' => [
        'title' => 'Integrations: SIS, LMS, ERP, SSO & More',
        'desc'  => 'Connect Acadlytic with student information systems, LMS, ERP, payment gateways, single sign-on, email, WhatsApp and your own apps via APIs, webhooks and exports.',
        'h1'    => 'Integrations that fit your existing stack',
        'nav_label' => 'Integrations',
        'lead'  => 'Acadlytic is designed to connect to the systems you keep through documented APIs, event webhooks and scheduled exports, so data flows once and stays consistent.',
        'groups' => [
            ['title' => 'Academic systems', 'paths' => ['/integrations/sis-integration/', '/integrations/lms-integration/', '/integrations/erp-integration/', '/integrations/crm-integration/']],
            ['title' => 'Identity, payments & productivity', 'paths' => ['/integrations/sso-integration/', '/integrations/payment-integration/', '/integrations/calendar-integration/']],
            ['title' => 'Communication channels', 'paths' => ['/integrations/email-integration/', '/integrations/whatsapp-integration/', '/integrations/messaging-integration/']],
            ['title' => 'Developer tools', 'paths' => ['/integrations/api/', '/integrations/webhooks/', '/integrations/data-export/']],
        ],
        'blocks' => [
            steps('How we plan an integration', [
                'Inventory' => 'List your systems, their owners and which data each should be authoritative for.',
                'Design' => 'Agree data flows, direction, frequency and error handling in a short integration specification.',
                'Build & test' => 'Configure connectors or build against the API in a sandbox, with test data.',
                'Monitor' => 'Integration health, failures and retries are visible to administrators.',
            ]),
            note('Specific vendor connectors vary by region and edition. We confirm supported providers for your systems in writing during evaluation.'),
        ],
    ],

    '/integrations/sis-integration/' => [
        'title' => 'SIS Integration',
        'desc'  => 'Integrate Acadlytic with your student information system to sync student records, enrolments and results, avoid duplicate entry and keep one source of truth.',
        'h1'    => 'Student information system (SIS) integration',
        'nav_label' => 'SIS Integration',
        'lead'  => 'Keep your existing SIS as the system of record, or phase it out gradually. Either way, Acadlytic is designed to keep student data consistent across both.',
        'icon'  => 'database',
        'blocks' => [
            sec('Two common approaches',
                'Two patterns are planned. An institution can keep its SIS for records and results and use Acadlytic for CRM, communication, engagement and analytics, or adopt Acadlytic’s planned student management and migrate away from the SIS over time. The integration pattern differs for each.'),
            table('Planned data flows', ['Data', 'Direction when SIS is the record', 'Frequency'], [
                ['New students from admissions', 'Acadlytic → SIS', 'On enrolment'],
                ['Student profiles & status', 'SIS → Acadlytic', 'Near real time or scheduled'],
                ['Programme & section enrolment', 'SIS → Acadlytic', 'Scheduled'],
                ['Results', 'SIS → Acadlytic', 'On publication'],
                ['Contact detail updates', 'Either, with agreed ownership', 'Near real time'],
            ]),
            checks('Planned integration safeguards', [
                'Clear ownership of each field to prevent overwrite conflicts',
                'Matching rules and identifiers agreed up front',
                'Error queues with alerts rather than silent failures',
                'Reconciliation reports during rollout',
            ]),
            faq([
                'Do we have to replace our SIS?' => 'No. Keeping an existing SIS as the system of record and integrating it with Acadlytic is one planned pattern; migrating over time is another. We will help you choose.',
                'How are students matched between systems?' => 'By an agreed unique identifier, typically the institution’s student ID, with fallback matching rules reviewed during setup.',
            ]),
        ],
        'related' => ['/glossary/student-information-system/', '/comparisons/academic-crm-vs-sis/', '/platform/student-management/', '/integrations/api/'],
    ],

    '/integrations/lms-integration/' => [
        'title' => 'LMS Integration',
        'desc'  => 'Connect Acadlytic with your learning management system: provision courses and enrolments, bring back grades and activity, and use LMS signals for student support.',
        'h1'    => 'Learning management system (LMS) integration',
        'nav_label' => 'LMS Integration',
        'lead'  => 'Your LMS delivers learning. Acadlytic is designed to run operations. Integration keeps course enrolments aligned and brings learning activity into student support.',
        'icon'  => 'book',
        'blocks' => [
            table('What is planned to flow', ['Data', 'Direction', 'Why'], [
                ['Courses & sections', 'Acadlytic → LMS', 'Create course shells for each teaching section'],
                ['Enrolments', 'Acadlytic → LMS', 'Students and faculty see the right courses automatically'],
                ['Grades', 'LMS → Acadlytic', 'Consolidate into official results where configured'],
                ['Activity & submissions', 'LMS → Acadlytic', 'Engagement signals for [student success](/ai/ai-for-student-success/)'],
            ]),
            sec('Standards and methods',
                'LMS integrations typically use the LMS’s own APIs, interoperability standards such as LTI where supported, or scheduled file exchange. We agree the method with your LMS administrators based on the platform and version you run.'),
            checks('Benefits', [
                'No manual course enrolment at term start',
                'Faculty avoid entering grades twice',
                'Advisors see learning engagement alongside attendance',
                'Changes in timetables reflect in the LMS promptly',
            ]),
            faq([
                'Which LMS platforms do you support?' => 'Integration depends on the LMS and version you run, and the methods it exposes. We confirm the approach for your LMS during evaluation.',
                'Will faculty have to enter grades twice?' => 'Not once grade sync is available and configured: grades entered in the LMS are planned to flow to Acadlytic for consolidation and moderation.',
            ]),
        ],
        'related' => ['/solutions/for-faculty/', '/platform/academic-operations/', '/glossary/learning-analytics/', '/industries/online-education/'],
    ],

    '/integrations/erp-integration/' => [
        'title' => 'ERP Integration',
        'desc'  => 'Integrate Acadlytic with your ERP or accounting system for fee postings, general ledger summaries, HR and staff data, while keeping student-facing finance in Acadlytic.',
        'h1'    => 'ERP and accounting integration',
        'nav_label' => 'ERP Integration',
        'lead'  => 'Acadlytic is designed to manage student-facing finance. Your ERP keeps the books. Integration posts the right summaries across without re-keying.',
        'icon'  => 'layers',
        'blocks' => [
            sec('Dividing responsibilities',
                'ERP systems excel at general ledger, procurement, payroll and HR. They are rarely designed for student-level fee plans, concessions and parent-friendly receipts. The planned pattern keeps student billing in Acadlytic and posts summarised, reconciled entries to the ERP.'),
            table('Planned flows', ['Data', 'Direction'], [
                ['Fee invoices and receipts (summarised by account code)', 'Acadlytic → ERP'],
                ['Refunds and adjustments', 'Acadlytic → ERP'],
                ['Chart of accounts and cost centres', 'ERP → Acadlytic'],
                ['Staff directory and departments', 'ERP/HR → Acadlytic'],
            ]),
            checks('Planned controls', [
                'Posting batches with approval before export',
                'Account mapping maintained by finance, not IT',
                'Reconciliation reports for every posting period',
                'Audit trail for mapping changes',
            ]),
            faq([
                'Do we still need our ERP?' => 'Usually yes, for the general ledger, payroll, HR and procurement. Acadlytic is designed to handle student-facing finance and post summaries to the ERP.',
                'How often are entries posted?' => 'Posting frequency is agreed with your finance team; daily or per accounting period are common, always with a reconciliation report.',
                'Who maintains account code mappings?' => 'Your finance team maintains mappings through the administration screens, with every change recorded.',
            ]),
        ],
        'related' => ['/platform/finance-fees/', '/solutions/for-finance-teams/', '/comparisons/academic-crm-vs-erp/', '/glossary/academic-erp/'],
    ],

    '/integrations/crm-integration/' => [
        'title' => 'CRM Integration',
        'desc'  => 'Connect Acadlytic with an existing enterprise CRM or marketing platform: sync contacts, campaigns and outcomes so recruitment and marketing share one picture.',
        'h1'    => 'Integration with existing CRM and marketing tools',
        'nav_label' => 'CRM Integration',
        'lead'  => 'Some institutions already use an enterprise CRM or marketing automation platform for campaigns. Acadlytic is designed to work alongside it, sharing contacts and outcomes.',
        'icon'  => 'users',
        'blocks' => [
            sec('When you already have a CRM',
                'A marketing team may run campaigns in a general-purpose CRM, while admissions and student teams need education-specific workflows. Rather than forcing one tool to do both jobs badly, the systems can share data with clear ownership.'),
            table('Common patterns', ['Pattern', 'How it works'], [
                ['Marketing upstream', 'Campaign leads flow from the marketing platform into Acadlytic for admissions follow-up'],
                ['Outcomes back', 'Application and enrolment outcomes flow back so marketing can measure campaign quality'],
                ['Shared suppression', 'Opt-outs are synchronised in both directions'],
                ['Gradual consolidation', 'Move admissions workflows into Acadlytic first, then decide on the long-term role of each tool'],
            ]),
            note('Consent and opt-out status must be synchronised reliably across systems. We treat this as a mandatory part of any CRM integration.'),
            faq([
                'Should we keep our existing CRM?' => 'It depends on how well it serves admissions and student teams today. A common approach is to keep marketing tools and move admissions workflows into a dedicated education platform.',
                'How are duplicates avoided across systems?' => 'By agreeing a primary identifier and which system creates new contacts, and by deduplicating on email and phone at the point of entry.',
            ]),
        ],
        'related' => ['/core/edtech-crm/', '/platform/admissions-crm/', '/integrations/webhooks/', '/integrations/api/'],
    ],

    '/integrations/sso-integration/' => [
        'title' => 'Single Sign-On (SSO) Integration',
        'desc'  => 'Let staff and students sign in to Acadlytic with your institution’s identity provider via SAML 2.0 or OpenID Connect, with centralised access and deprovisioning.',
        'h1'    => 'Single sign-on with your identity provider',
        'nav_label' => 'SSO Integration',
        'lead'  => 'Staff and students use the institutional account they already have. IT keeps control of authentication, password policy and multi-factor requirements.',
        'icon'  => 'key',
        'blocks' => [
            sec('Why SSO matters',
                'Separate passwords for every system lead to reuse, resets and risk. Single sign-on centralises authentication in your identity provider, so when someone leaves the institution, disabling one account removes access everywhere.'),
            cards('Planned approaches', [
                'SAML 2.0' => 'Widely supported by institutional identity providers.',
                'OpenID Connect' => 'Modern standard used by many cloud identity services.',
                'Role mapping' => 'Map directory groups to Acadlytic roles, reviewed by administrators.',
                'MFA via your IdP' => 'Multi-factor authentication enforced by your identity provider’s policies.',
            ]),
            checks('Implementation checklist', [
                'Choose the protocol your identity provider supports best',
                'Agree attribute mapping (email, identifiers, roles)',
                'Test with pilot users in a sandbox',
                'Define fallback access for break-glass administrator accounts',
                'Plan deprovisioning and periodic access reviews',
            ]),
            faq([
                'Can students use SSO too?' => 'That is the plan, if students have institutional accounts in your identity provider. Otherwise they will use Acadlytic credentials.',
                'What happens if the identity provider is down?' => 'We agree a break-glass procedure for designated administrators during setup, so critical operations can continue.',
            ]),
        ],
        'related' => ['/glossary/single-sign-on/', '/core/security/', '/solutions/for-it-teams/'],
    ],

    '/integrations/payment-integration/' => [
        'title' => 'Payment Gateway Integration',
        'desc'  => 'Collect application and tuition fees online through payment gateways, with automatic invoice matching, instant receipts and daily settlement reconciliation.',
        'h1'    => 'Payment gateway integration for fees',
        'nav_label' => 'Payment Gateways',
        'lead'  => 'Students and parents pay online in a few taps. Payments are matched to invoices automatically and reconciled against gateway settlements.',
        'icon'  => 'rupee',
        'blocks' => [
            steps('Planned payment flow', [
                'Invoice' => 'Acadlytic is designed to issue an invoice or payment request with a secure payment link.',
                'Pay' => 'The payer completes payment on the gateway’s hosted page using the methods the gateway supports.',
                'Confirm' => 'The gateway notifies Acadlytic; the invoice is marked paid and a receipt is issued.',
                'Reconcile' => 'Daily settlement files are matched to payments; exceptions are flagged for finance.',
            ]),
            cards('Security by design', [
                'Hosted payment pages' => 'Card and bank details are entered on the gateway’s page, not stored by Acadlytic.',
                'Signed notifications' => 'Payment confirmations are verified before invoices are updated.',
                'Idempotency' => 'Duplicate notifications cannot mark an invoice paid twice.',
                'Refund controls' => 'Refunds require authorised roles and are logged.',
            ]),
            note('Supported gateways depend on your country and banking relationships. We confirm the providers available for your institution during evaluation.'),
            faq([
                'Does Acadlytic store card details?' => 'No. By design, payment details are entered on the gateway’s hosted page and Acadlytic will receive only the payment confirmation and reference.',
                'Can parents pay on behalf of students?' => 'Yes, that is the plan. Payment links can be shared with linked parent or guardian contacts, and receipts go to the payer and the student record.',
                'How are failed payments handled?' => 'Failed or pending payments are shown clearly to the payer and flagged for finance if they remain unresolved.',
            ]),
        ],
        'related' => ['/platform/finance-fees/', '/solutions/for-finance-teams/', '/integrations/erp-integration/'],
    ],

    '/integrations/email-integration/' => [
        'title' => 'Email Integration',
        'desc'  => 'Connect Acadlytic with institutional email: send from your domain with proper authentication, log staff emails on records and keep deliverability healthy.',
        'h1'    => 'Email integration',
        'nav_label' => 'Email',
        'lead'  => 'Send institutional email from your own domain, log correspondence on the right records and protect deliverability for time-sensitive messages.',
        'icon'  => 'mail',
        'blocks' => [
            cards('Planned capabilities', [
                'Send from your domain' => 'Messages come from your institution’s addresses, configured with SPF, DKIM and DMARC.',
                'Mailbox logging' => 'Staff correspondence with applicants and students can be logged on records.',
                'Shared inboxes' => 'Team inboxes such as admissions@ routed into queues with owners.',
                'Bounce handling' => 'Invalid addresses are flagged so staff can update contact details.',
            ]),
            sec('Deliverability matters',
                'Offer letters, fee reminders and deadline notices must reach inboxes, not spam folders. Correct domain authentication, separate streams for bulk and transactional email, and list hygiene all matter. We help your IT team configure these during onboarding.'),
            checks('Setup checklist', [
                'Authorise sending via SPF and DKIM records',
                'Publish or review your DMARC policy',
                'Separate transactional and bulk sending where possible',
                'Agree which mailboxes are logged and who can see them',
            ]),
            faq([
                'Will emails come from our own domain?' => 'That is the plan, once your IT team authorises Acadlytic to send on your behalf through SPF and DKIM records.',
                'Can staff reply from their own mailbox?' => 'Yes, that is the plan. Where mailbox logging is enabled, replies can be captured on the relevant record, subject to your privacy settings.',
            ]),
        ],
        'related' => ['/platform/communication-hub/', '/integrations/messaging-integration/', '/ai/ai-communications/'],
    ],

    '/integrations/whatsapp-integration/' => [
        'title' => 'WhatsApp Integration for Education',
        'desc'  => 'Use WhatsApp Business messaging for admissions, reminders and parent updates, with approved templates, opt-in consent and conversations logged on each record.',
        'h1'    => 'WhatsApp integration for institutions',
        'nav_label' => 'WhatsApp',
        'lead'  => 'Reach applicants, students and parents on the channel many of them check most, through the WhatsApp Business Platform with templates and consent.',
        'icon'  => 'message',
        'blocks' => [
            sec('Why WhatsApp, and why it needs care',
                'For many families, WhatsApp is the most reliable way to receive a message quickly. That makes it valuable for reminders and updates, and also means misuse quickly erodes trust. Institutional WhatsApp should be opt-in, relevant and easy to stop.'),
            cards('Planned capabilities', [
                'Approved templates' => 'Business-initiated messages use templates approved through the WhatsApp Business Platform.',
                'Opt-in management' => 'Consent is recorded per contact and respected automatically.',
                'Two-way conversations' => 'Replies route to the right staff member and are logged on the record.',
                'Rich messages' => 'Links, documents and quick replies where the platform supports them.',
            ]),
            table('Good uses', ['Audience', 'Examples'], [
                ['Applicants', 'Application received, missing documents, interview scheduling'],
                ['Students', 'Class changes, deadlines, event reminders'],
                ['Parents', 'Fee reminders, attendance alerts where permitted, meeting invitations'],
            ]),
            note('WhatsApp messaging is provided through a WhatsApp Business Platform provider. Message charges and template approval rules are set by the provider and Meta.'),
            faq([
                'Do we need a WhatsApp Business account?' => 'Yes, that is the plan. Messaging runs through the WhatsApp Business Platform via a provider, using your institution’s verified business profile.',
                'Can we send messages to anyone with a phone number?' => 'Only to contacts who have opted in. Acadlytic is designed to record consent and prevent sending to contacts who have not opted in or have opted out.',
            ]),
        ],
        'related' => ['/integrations/messaging-integration/', '/platform/communication-hub/', '/solutions/for-parents/'],
    ],

    '/integrations/messaging-integration/' => [
        'title' => 'SMS & Messaging Integration',
        'desc'  => 'Send SMS and in-app notifications through connected providers for alerts and reminders, with sender registration, delivery reports and consent rules.',
        'h1'    => 'SMS and notification integration',
        'nav_label' => 'SMS & Messaging',
        'lead'  => 'SMS remains the most universal channel for short, urgent messages. Acadlytic is designed to connect to messaging providers and add in-app notifications for portal users.',
        'icon'  => 'bell',
        'blocks' => [
            cards('Planned channels', [
                'SMS' => 'Short alerts and reminders through connected SMS providers, including registered sender IDs and templates where regulations require them.',
                'In-app notifications' => 'Portal notifications for students and parents who are signed in.',
                'Email fallback' => 'Automatic fallback when a mobile number is invalid.',
            ]),
            sec('Regulatory considerations',
                'Commercial and transactional SMS are regulated in many countries, including sender registration, template approval and consent requirements. Acadlytic is designed to support these through provider integrations; your institution remains responsible for the content and consent of messages it sends.'),
            checks('Best practices in the design', [
                'Quiet hours to avoid late-night messages',
                'Clear identification of the sending institution',
                'Delivery reports to spot invalid numbers',
                'Opt-out handling for non-essential messages',
            ]),
            faq([
                'Do we need our own SMS provider?' => 'The plan is to support a provider contracted by your institution or one arranged with us. Sender registration and template rules depend on your country.',
                'Can students choose SMS over email?' => 'Yes, that is the plan. Channel preferences are stored per contact and respected by the Communication Hub, except for designated emergency messages.',
                'How do we know if messages were delivered?' => 'Delivery reports from the provider are shown on each message and on the recipient’s timeline.',
            ]),
        ],
        'related' => ['/integrations/whatsapp-integration/', '/integrations/email-integration/', '/platform/communication-hub/'],
    ],

    '/integrations/calendar-integration/' => [
        'title' => 'Calendar Integration',
        'desc'  => 'Sync timetables, advising appointments, interviews and events between Acadlytic and staff and student calendars, with booking links and reminders.',
        'h1'    => 'Calendar integration',
        'nav_label' => 'Calendar',
        'lead'  => 'Classes, interviews, advising appointments and events appear in the calendars people already use, and stay updated when plans change.',
        'icon'  => 'calendar',
        'blocks' => [
            table('What is planned to sync', ['Item', 'Who sees it'], [
                ['Timetabled classes', 'Students and faculty, as a subscribable calendar feed'],
                ['Admission interviews', 'Applicants and interview panels'],
                ['Advising appointments', 'Students and advisors, via booking links'],
                ['Events & open days', 'Registered attendees'],
            ]),
            cards('Planned capabilities', [
                'Booking links' => 'Advisors and counsellors share availability; bookings avoid conflicts.',
                'Change notifications' => 'Room or time changes update calendars and notify attendees.',
                'Standard formats' => 'Calendar feeds in standard formats that major calendar apps can subscribe to.',
            ]),
            sec('Why calendar sync matters',
                'Students and staff live in their personal calendars. When timetables, interviews and appointments exist only inside an institutional portal, people miss changes and double-book. Publishing them as calendar feeds and invitations puts institutional schedules where people already look, and updates arrive automatically when rooms or times change.'),
            faq([
                'Which calendar apps are supported?' => 'Calendar feeds use standard formats that common calendar applications can subscribe to. Two-way sync for bookings depends on your institution’s calendar platform.',
                'Do students see other students’ appointments?' => 'No. Booking pages are designed to show only available time slots, never who booked the other slots.',
                'What happens when a class is moved?' => 'In the design, the change is published once in Acadlytic; subscribed calendars then update and affected students are notified.',
            ]),
        ],
        'related' => ['/solutions/for-advisors/', '/platform/academic-operations/', '/solutions/for-operations/'],
    ],

    '/integrations/api/' => [
        'title' => 'Acadlytic API for Developers',
        'desc'  => 'The planned Acadlytic REST API, designed to let institutions and partners read and write platform data securely with scoped credentials, rate limits and versioning.',
        'h1'    => 'The Acadlytic API',
        'nav_label' => 'REST API',
        'lead'  => 'Acadlytic is building a REST API so you can create your own integrations and tools on Acadlytic data, designed for security, stability and clear documentation.',
        'icon'  => 'code',
        'blocks' => [
            cards('Design principles', [
                'Resource-oriented' => 'Predictable endpoints for people, applications, students, programmes, invoices and more.',
                'Scoped credentials' => 'API clients are designed to receive only the permissions they need, and to be revocable at any time.',
                'Versioned' => 'Breaking changes are introduced in new versions with deprecation notice.',
                'Rate-limited' => 'Fair-use limits protect platform performance for everyone.',
                'Audited' => 'API access is logged like user access.',
                'Sandbox' => 'Test against a sandbox environment before production.',
            ]),
            table('Common use cases', ['Use case', 'Approach'], [
                ['Website application forms', 'Submit enquiries or applications directly from your website'],
                ['Data warehouse', 'Read data on a schedule for institutional analytics; see [data export](/integrations/data-export/)'],
                ['Custom portals', 'Build specialised experiences on top of Acadlytic data'],
                ['Partner systems', 'Exchange data with approved partners under agreed scopes'],
            ]),
            note('API documentation and sandbox access will be shared with customers and approved partners when the API is released. [Contact us](/core/contact/?topic=partnership) to discuss access.'),
            faq([
                'Is there an API for our website forms?' => 'Yes, that is the plan. Enquiry and application endpoints let your website submit directly to Acadlytic, with validation and spam protection.',
                'How do we get API credentials?' => 'Administrators create API clients with specific scopes in a sandbox first, then in production after testing.',
            ]),
        ],
        'related' => ['/integrations/webhooks/', '/glossary/education-api/', '/solutions/for-it-teams/', '/integrations/data-export/'],
    ],

    '/integrations/webhooks/' => [
        'title' => 'Webhooks & Events',
        'desc'  => 'Subscribe to Acadlytic events such as application submitted, student enrolled or payment received, and trigger your own systems in near real time.',
        'h1'    => 'Webhooks and events',
        'nav_label' => 'Webhooks & Events',
        'lead'  => 'Acadlytic is designed to tell your systems when something happens, with signed, retried event notifications, so they do not need to poll for changes.',
        'icon'  => 'link',
        'blocks' => [
            table('Planned example events', ['Event', 'Typical use'], [
                ['enquiry.created', 'Notify a marketing platform or regional office'],
                ['application.submitted', 'Start an external assessment process'],
                ['student.enrolled', 'Provision accounts in other systems'],
                ['payment.received', 'Update an accounting or ERP system'],
                ['document.verified', 'Trigger downstream checks'],
            ]),
            checks('Planned reliability and security', [
                'Signed payloads so receivers can verify authenticity',
                'Automatic retries with backoff when a receiver is unavailable',
                'Delivery logs visible to administrators',
                'Minimal payloads, with details fetched through the scoped [API](/integrations/api/)',
                'Subscriptions managed per environment',
            ]),
            sec('Webhooks or polling?',
                'Polling asks “has anything changed?” every few minutes, which wastes resources and still arrives late. Webhooks send a notification the moment an event happens. For most integrations, webhooks for timely signals combined with the API for details is the most reliable and efficient pattern.'),
            faq([
                'What if our system is down when an event is sent?' => 'Deliveries are designed to be retried with increasing delays, and administrators will be able to see failed deliveries and replay them once the receiver is available.',
                'How do we verify a webhook really came from Acadlytic?' => 'Each payload is signed with a secret shared only with your endpoint. Your receiver checks the signature before processing.',
            ]),
        ],
        'related' => ['/integrations/api/', '/platform/workflow-automation/', '/integrations/data-export/'],
    ],

    '/integrations/data-export/' => [
        'title' => 'Data Export & Portability',
        'desc'  => 'Export Acadlytic data on demand or on a schedule for analytics, archiving and portability, in open formats, with permissions and export logging.',
        'h1'    => 'Data export and portability',
        'nav_label' => 'Data Export',
        'lead'  => 'Your institution’s data belongs to your institution. Export it on demand or on a schedule for analytics, archiving or migration.',
        'icon'  => 'database',
        'blocks' => [
            cards('Planned export options', [
                'Report exports' => 'Download any report in spreadsheet-friendly formats.',
                'Scheduled extracts' => 'Regular extracts delivered to secure storage for your data warehouse.',
                'Full export' => 'A complete export of your institution’s data in documented, open formats.',
                'API access' => 'Programmatic access through the [API](/integrations/api/).',
            ]),
            checks('Planned controls', [
                'Bulk exports restricted to authorised roles',
                'Every export logged with who, what and when',
                'Personal data minimisation options for analytics extracts',
                'Encryption in transit for delivered extracts',
            ]),
            sec('Portability as a principle',
                'Choosing a platform should never mean being locked in. During evaluation we describe our export formats and data-return terms in writing, so you can assess Acadlytic on its merits rather than on switching costs.'),
            faq([
                'Can we feed our own data warehouse?' => 'Yes, that is the plan. Scheduled extracts or the API can feed your warehouse, with options to minimise personal data for analytics.',
                'What formats are available?' => 'Reports export to common spreadsheet formats; full exports use documented, open formats agreed during onboarding.',
            ]),
        ],
        'related' => ['/platform/data-management/', '/resources/academic-data-strategy/', '/integrations/api/', '/trust/privacy/'],
    ],
];
