<?php
/** Institution types (industries). Universities and colleges live under /solutions/. */
declare(strict_types=1);

return [
    '/industries/' => [
        'title' => 'Institution Types We Serve',
        'desc'  => 'How Acadlytic adapts to universities, colleges, community colleges, private and public institutions, online and lifelong learning, and multi-campus groups.',
        'h1'    => 'Built for every kind of institution',
        'nav_label' => 'Institutions',
        'lead'  => 'Institutions differ in size, funding, regulation and learners. Acadlytic’s configuration is designed to adapt to each while keeping one connected platform underneath.',
        'groups' => [
            ['title' => 'Degree-granting institutions', 'paths' => [
                '/solutions/for-universities/', '/solutions/for-colleges/', '/industries/community-colleges/', '/industries/private-institutions/', '/industries/public-institutions/',
            ]],
            ['title' => 'Flexible and lifelong learning', 'paths' => [
                '/industries/professional-education/', '/industries/continuing-education/', '/industries/online-education/',
            ]],
            ['title' => 'Scale and reach', 'paths' => [
                '/industries/multi-campus/', '/industries/international-education/',
            ]],
            ['title' => 'Regional focus', 'paths' => ['/industries/higher-education-india/']],
        ],
    ],

    '/industries/community-colleges/' => [
        'title' => 'Community College Management Software',
        'desc'  => 'Acadlytic for community colleges: open-access enrolment, part-time and returning learners, workforce programmes and student support on one connected platform.',
        'h1'    => 'Technology for community colleges',
        'nav_label' => 'Community Colleges',
        'lead'  => 'Community colleges serve learners with diverse goals and busy lives. Acadlytic is designed to help small teams enrol quickly, support students proactively and report outcomes clearly.',
        'blocks' => [
            sec('Serving learners with complicated lives',
                'Many community college students work, care for family or return to study after years away. They enrol late, study part-time and may pause and resume. Systems designed for traditional full-time cohorts struggle with this reality.'),
            cards('Where Acadlytic is designed to help', [
                'Rolling enrolment' => 'Short enquiry-to-enrolment paths for open-access and late-start programmes.',
                'Part-time schedules' => 'Evening, weekend and modular timetables.',
                'Stop-out and return' => 'Records that handle pauses gracefully, with re-engagement outreach.',
                'Workforce programmes' => 'Short courses and employer-sponsored cohorts alongside degree programmes.',
                'Proactive support' => 'Early-warning signals for students balancing study with work.',
                'Outcome reporting' => 'Completion and progression data for funders and boards.',
            ]),
            checks('Practical considerations', [
                'Mobile-first communication for students who rarely check email',
                'SMS and WhatsApp reminders for deadlines and classes',
                'Simple self-service for common requests',
                'Clear dashboards for small administrative teams',
            ]),
            faq([
                'Can Acadlytic handle students who pause and return?' => 'Yes, that is the plan. A student’s record keeps its full history through breaks in study, and returning learners can be re-enrolled without creating a duplicate record.',
                'Do we need a large IT team?' => 'No. Acadlytic is being built as a managed cloud service. Most configuration is designed to be done by trained administrators, and integration work will be scoped with you up front.',
                'Can short workforce courses sit alongside credit programmes?' => 'Yes, that is the plan. Programme structures can differ, so short non-credit courses and full qualifications can be managed on the same platform with separate rules.',
            ]),
        ],
        'related' => ['/solutions/for-colleges/', '/industries/continuing-education/', '/platform/student-engagement/', '/ai/ai-for-student-success/'],
    ],

    '/industries/private-institutions/' => [
        'title' => 'Software for Private Institutions',
        'desc'  => 'Acadlytic for private colleges and universities: competitive recruitment, fee-dependent operations, brand-consistent communication and fast decision cycles.',
        'h1'    => 'Technology for private institutions',
        'nav_label' => 'Private Institutions',
        'lead'  => 'Private institutions compete for students and depend on fee income. Acadlytic is designed to strengthen recruitment, sharpen the student experience and keep finances visible.',
        'blocks' => [
            sec('Recruitment and experience are strategic',
                'For a private institution, each enrolment affects the budget directly and each student’s experience shapes word-of-mouth for future cycles. Speed of response, clarity of communication and a smooth administrative experience are competitive advantages.'),
            table('Priorities and planned capabilities', ['Priority', 'Planned Acadlytic capability'], [
                ['Win more of the right applicants', '[Admissions CRM](/platform/admissions-crm/) with source attribution and fast follow-up'],
                ['Predictable revenue', '[Finance & fees](/platform/finance-fees/) with instalments, reminders and collections dashboards'],
                ['Premium student experience', 'Self-service portals and consistent, personalised communication'],
                ['Brand consistency', 'Approved templates across every team and channel'],
                ['Owner and board reporting', 'Timely dashboards with consistent definitions'],
            ]),
            checks('What private institutions often start with', [
                'Enquiry management and counsellor productivity',
                'Online application with fee collection',
                'Parent communication and fee reminders',
                'Leadership dashboard for admissions and collections',
            ]),
            faq([
                'How quickly can we be ready for the next admission cycle?' => 'It depends on scope and data readiness. Starting with admissions and CRM is usually the fastest route; we agree a written timeline during the proposal stage.',
                'Can each programme have its own fee structure and concessions?' => 'Yes, that is the plan. Fee structures, instalments and concession rules are configured per programme, year and category, with approval workflows.',
                'Can we keep our brand consistent across departments?' => 'Yes, that is the plan. Approved templates for email, SMS and WhatsApp keep tone and branding consistent, and broadcast messages can require approval.',
            ]),
        ],
        'related' => ['/solutions/for-colleges/', '/platform/enrollment-analytics/', '/solutions/for-finance-teams/', '/core/pricing/'],
    ],

    '/industries/public-institutions/' => [
        'title' => 'Software for Public Institutions',
        'desc'  => 'Acadlytic for public colleges and universities: transparency, regulatory reporting, reservation and eligibility rules, large-scale admissions and accountable processes.',
        'h1'    => 'Technology for public institutions',
        'nav_label' => 'Public Institutions',
        'lead'  => 'Public institutions carry obligations of transparency, fairness and accountability. Acadlytic is designed to support rule-based processes, auditable decisions and reliable statutory reporting.',
        'blocks' => [
            sec('Accountability in the design',
                'Public institutions must be able to show how decisions were made, apply eligibility and reservation rules consistently, and report accurately to government bodies. Processes must be fair to every applicant and demonstrably so.'),
            cards('Planned capabilities for public institutions', [
                'Rule-based eligibility' => 'Configurable eligibility and category rules applied consistently to every application.',
                'Merit lists & allocation' => 'Transparent ranking and seat allocation according to published criteria, with audit trails.',
                'Statutory reporting' => 'Consistent data for government and regulatory returns.',
                'Grievance handling' => 'Structured intake and tracking of applicant and student grievances.',
                'Audit trails' => 'Every change to an application or record is attributed and time-stamped.',
                'Accessibility' => 'Interfaces designed to meet accessibility expectations for public services.',
            ]),
            note('Selection rules and merit criteria are configured by the institution according to its published policies. Acadlytic is designed to apply them consistently; it does not make selection judgements.'),
            faq([
                'Can we publish merit lists from the platform?' => 'Ranked lists are designed to be generated from the criteria your institution configures and exported for publication through your official channels, with an audit trail of how they were produced.',
                'How are reservation or category rules handled?' => 'Category rules are configured by the institution according to its published policy and applied consistently to every application.',
                'Can applicants track grievances online?' => 'Yes, that is the plan. Grievances can be submitted and tracked, with every action recorded for accountability.',
            ]),
        ],
        'related' => ['/solutions/for-registrars/', '/trust/grievance-redressal/', '/trust/accessibility/', '/platform/data-management/'],
    ],

    '/industries/professional-education/' => [
        'title' => 'Software for Professional Education',
        'desc'  => 'Acadlytic for professional and executive education: short programmes, corporate cohorts, certifications, fast enrolment and B2B relationships in one platform.',
        'h1'    => 'Technology for professional and executive education',
        'nav_label' => 'Professional Education',
        'lead'  => 'Professional education runs on short cycles, working learners and corporate relationships. Acadlytic is designed to manage individuals and organisations on one CRM.',
        'blocks' => [
            sec('Two kinds of customer',
                'Professional education providers serve individual learners and the organisations that sponsor them. An effective CRM tracks both: the learner’s journey and the corporate account’s contracts, cohorts, invoices and reporting needs.'),
            cards('Planned capabilities', [
                'Short-cycle enrolment' => 'Fast registration and payment for short courses and certificates.',
                'Corporate accounts' => 'Organisations, sponsors, contracts and cohort rosters.',
                'Cohort scheduling' => 'Intensive, weekend and blended schedules.',
                'Certification tracking' => 'Completion requirements and certificate issuance.',
                'Sponsor reporting' => 'Attendance and completion reports for corporate clients.',
                'Repeat learners' => 'Recommend the next programme to alumni based on history.',
            ]),
            checks('Why it matters', [
                'Faster time from enquiry to enrolled learner',
                'Clear visibility into corporate pipeline and renewals',
                'Consistent learner experience across programme types',
            ]),
            faq([
                'Can a company enrol a group of employees at once?' => 'Yes, that is the plan. Corporate accounts can register cohorts, and sponsors can receive consolidated invoices and progress reports.',
                'Do you support certificates for short programmes?' => 'Yes, that is the plan. Completion rules and certificate templates can be defined per programme, and certificates are issued from verified completion data.',
                'Can learners pay individually for open programmes?' => 'Yes, that is the plan. Individual learners can register and pay online, while corporate cohorts are invoiced to the sponsoring organisation.',
            ]),
        ],
        'related' => ['/industries/continuing-education/', '/core/edtech-crm/', '/integrations/crm-integration/', '/industries/online-education/'],
    ],

    '/industries/continuing-education/' => [
        'title' => 'Continuing Education Software',
        'desc'  => 'Acadlytic for continuing and lifelong learning: flexible enrolment, modular credentials, returning learners, stackable programmes and adult-learner communication.',
        'h1'    => 'Technology for continuing education and lifelong learning',
        'nav_label' => 'Continuing Education',
        'lead'  => 'Lifelong learners enrol, pause and return over years. Acadlytic is designed to keep one relationship record so each return is recognised and each next step is easy.',
        'blocks' => [
            sec('A long relationship, not a single enrolment',
                'Continuing education learners may take a short course this year, a certificate next year and a diploma later. Each interaction should build on the last: credits recognised, preferences remembered and relevant offerings suggested.'),
            steps('The lifelong learner journey', [
                'Discover' => 'Find relevant short courses through search, newsletters and recommendations.',
                'Enrol' => 'Quick registration with saved details from previous study.',
                'Learn' => 'Flexible schedules and online or blended delivery.',
                'Recognise' => 'Credits and micro-credentials recorded on one learner record.',
                'Return' => 'Personalised suggestions for the next step, stacking toward larger awards.',
            ]),
            checks('Planned capabilities', [
                'Modular and stackable programme structures',
                'Rolling start dates and self-paced options',
                'Alumni and returning-learner recognition',
                'Adult-appropriate communication preferences',
            ]),
            faq([
                'Will a returning learner need to register again from scratch?' => 'No. The design recognises their existing record, so they confirm details rather than re-entering them, and their previous study remains visible.',
                'Can small credentials count toward a larger award?' => 'Programme rules can recognise completed modules toward a larger qualification where your institution’s regulations allow it.',
                'How do we reach past learners with relevant offers?' => 'Segments based on previous study and stated interests let you send relevant suggestions, always respecting communication preferences and opt-outs.',
            ]),
        ],
        'related' => ['/industries/professional-education/', '/platform/student-lifecycle/', '/ai/ai-personalization/', '/industries/online-education/'],
    ],

    '/industries/online-education/' => [
        'title' => 'Online Education Management Software',
        'desc'  => 'Acadlytic for online and distance programmes: digital-first admissions, remote identity and document checks, LMS integration and engagement tracking for remote learners.',
        'h1'    => 'Technology for online and distance education',
        'nav_label' => 'Online Education',
        'lead'  => 'When every interaction is digital, the administrative experience is the institution. Acadlytic is designed to help online programmes recruit, enrol and support learners who may never visit campus.',
        'blocks' => [
            sec('Digital-first from enquiry to graduation',
                'Online learners compare programmes quickly and expect instant, accurate answers. They submit documents remotely, pay online and learn in an LMS. Their engagement is visible only through digital signals, which makes those signals especially important for support.'),
            cards('Planned capabilities', [
                'Always-on admissions' => 'Instant acknowledgements, clear next steps and multiple start dates.',
                'Remote document checks' => 'Upload quality checks and structured verification.',
                'LMS connection' => 'Enrolments to the LMS and activity back for engagement insight.',
                'Engagement signals' => 'Log-ins, submissions and participation combined to spot learners drifting away.',
                'Time-zone aware messaging' => 'Communication scheduled for each learner’s local time.',
                'Online payments' => 'International payment options through connected gateways.',
            ]),
            note('Engagement signals for online learners are especially useful for early support. See [AI for Student Success](/ai/ai-for-student-success/).'),
            faq([
                'Does Acadlytic replace our LMS?' => 'No. Your LMS delivers teaching and learning. Acadlytic is designed to manage recruitment, records, fees, communication and support, and integrate with the LMS.',
                'How do we verify documents from remote applicants?' => 'Applicants upload documents through their portal; upload checks catch unreadable or incorrect files immediately, and staff verify through a structured workflow.',
                'Can we run multiple intakes a year?' => 'Yes, that is the plan. Programmes can have several start dates, each with its own deadlines and communication schedule.',
            ]),
        ],
        'related' => ['/integrations/lms-integration/', '/platform/student-engagement/', '/industries/international-education/', '/core/cloud-platform/'],
    ],

    '/industries/multi-campus/' => [
        'title' => 'Multi-Campus Management Software',
        'desc'  => 'Manage multiple campuses and institutions on one platform: shared standards, local configuration, campus-scoped access and consolidated group reporting.',
        'h1'    => 'Multi-campus and group management',
        'nav_label' => 'Multi-Campus Groups',
        'lead'  => 'Run several campuses or institutions with shared standards and consolidated reporting, while each campus keeps the flexibility it needs locally.',
        'blocks' => [
            sec('Consistency without rigidity',
                'Education groups want consistent processes, brand and reporting across campuses. Each campus still has its own programmes, calendars, fee structures and local regulations. The platform must support both.'),
            table('Group vs campus configuration', ['Configured at group level', 'Configured at campus level'], [
                ['Data model and reporting definitions', 'Programmes and intakes offered'],
                ['Brand templates and communication standards', 'Local contacts and signatures'],
                ['Security policies and roles', 'Staff assignments'],
                ['Core workflows', 'Local approval steps'],
                ['Group dashboards', 'Campus fee structures and calendars'],
            ]),
            cards('Planned capabilities', [
                'Campus-scoped access' => 'Staff see their campus; group leaders see all.',
                'Consolidated reporting' => 'Compare campuses on consistent indicators.',
                'Shared services' => 'Central admissions or finance teams can serve multiple campuses.',
                'Transfers' => 'Move students between campuses with history intact.',
            ]),
            faq([
                'Can each campus keep its own fee structures?' => 'Yes, that is the plan. Fees, calendars and programmes can be configured per campus while reporting definitions stay consistent across the group.',
                'Can a central admissions team work for several campuses?' => 'Yes, that is the plan. Shared teams can be given access to several campuses, while campus teams see only their own records.',
                'How do we compare campuses fairly?' => 'Group dashboards use the same indicator definitions for every campus, so comparisons reflect performance rather than differences in how data is recorded.',
            ]),
        ],
        'related' => ['/solutions/for-universities/', '/platform/institutional-dashboard/', '/solutions/for-leadership/', '/industries/international-education/'],
    ],

    '/industries/international-education/' => [
        'title' => 'International Student Recruitment Software',
        'desc'  => 'Acadlytic for international education: global recruitment, agent management, document verification, visa-related milestones and communication across time zones.',
        'h1'    => 'Technology for international education',
        'nav_label' => 'International Education',
        'lead'  => 'Recruiting and supporting international students involves more parties, more documents and more deadlines. Acadlytic is designed to keep them organised in one place.',
        'blocks' => [
            sec('More moving parts',
                'International applicants may work with agents, submit documents issued in other countries, need visa-support letters and arrive on specific dates. Missing any step can cost an enrolment. Clear, organised processes matter even more than usual.'),
            cards('Planned capabilities', [
                'Agent management' => 'Agent onboarding, referrals, performance and commission tracking, with data boundaries.',
                'Country-specific checklists' => 'Document requirements by country of qualification.',
                'Milestone tracking' => 'Offer, deposit, visa-support letter and arrival milestones.',
                'Multilingual communication' => 'Templates in the languages your applicants use.',
                'Time-zone scheduling' => 'Calls and messages scheduled appropriately.',
                'Pre-arrival support' => 'Accommodation, orientation and arrival checklists.',
            ]),
            note('Acadlytic is designed to track visa-related milestones for planning and support. Visa decisions and immigration advice are outside its scope and remain with the relevant authorities and qualified advisors.'),
            faq([
                'Can agents see applicant data?' => 'Agents see only the applicants they referred, and only the fields your institution allows, under an agreed data-sharing arrangement.',
                'Can applicants upload documents issued in other countries?' => 'Yes, that is the plan. Checklists can vary by country of qualification, and staff verify each document through the standard verification workflow.',
                'Do you support payments from other countries?' => 'International payments depend on the payment gateways available to your institution. We confirm options during evaluation.',
            ]),
        ],
        'related' => ['/solutions/for-universities/', '/platform/post-secondary-school-database/', '/ai/ai-document-intelligence/', '/industries/online-education/'],
    ],

    // ---------- SEO Phase 2, batch 3 ----------
    '/industries/higher-education-india/' => [
        'title' => 'Academic Management Software for Indian Colleges',
        'desc'  => 'Acadlytic for colleges and universities in India: admissions, CBCS and outcome-based education records, fee collection, parent communication and accreditation data.',
        'h1'    => 'Academic management for Indian higher education',
        'nav_label' => 'Higher Education in India',
        'lead'  => 'Acadlytic has an office in Patna, Bihar, and is designing its platform with the realities of Indian colleges and universities in mind.',
        'blocks' => [
            sec('What is different about Indian higher education',
                'Indian institutions work within an affiliating-university system, semester and credit frameworks such as the [choice-based credit system](/glossary/choice-based-credit-system/), [outcome-based education](/glossary/outcome-based-education/) requirements for many professional programs, and periodic accreditation. Admissions often involve entrance examinations, counselling rounds, reserved categories and scholarships, and parents are closely involved in fees and communication.'),
            table('Needs and planned capabilities', ['Need', 'Planned Acadlytic capability'], [
                ['High-volume admissions seasons', '[Admissions CRM](/platform/admissions-crm/) with enquiry capture, counsellor follow-up and source tracking'],
                ['Credit and semester structures', '[Academic operations](/platform/academic-operations/) designed for programs, semesters, courses and credits'],
                ['Course and program outcomes', 'Outcome mapping and attainment records to support OBE reporting'],
                ['Fees, instalments and scholarships', '[Finance & fees](/platform/finance-fees/) with reminders and online payment'],
                ['Parents who prefer WhatsApp and SMS', '[WhatsApp integration](/integrations/whatsapp-integration/) and SMS, with consent and templates'],
                ['Accreditation evidence', 'Structured data and reports to help prepare accreditation submissions'],
            ]),
            checks('Practical considerations for Indian institutions', [
                'Where student data will be hosted; an Indian cloud region is the recommended option for Indian institutions',
                'Mobile-first access for students and parents',
                'Data protection designed to support institutions’ obligations under the Digital Personal Data Protection Act, 2023',
                'Pricing per institution, with a written proposal',
            ]),
            faq([
                'Where is Acadlytic based?' => 'Acadlytic has an office in Patna, Bihar. See [our Patna office](/company/offices/patna/).',
                'Will Acadlytic support CBCS and OBE?' => 'That is the plan. Programs, semesters, credits and course outcomes are part of the planned academic data model.',
                'Does Acadlytic replace university examination systems?' => 'Not necessarily. Many affiliated colleges must use their university’s systems for examinations and results; Acadlytic is designed to integrate with or complement them.',
            ]),
        ],
        'related' => ['/company/offices/patna/', '/glossary/outcome-based-education/', '/glossary/choice-based-credit-system/', '/resources/accreditation-data-guide/', '/integrations/whatsapp-integration/'],
    ],
];
