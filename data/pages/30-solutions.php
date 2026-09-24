<?php
/** Solutions hub, role-based and institution-level solution pages. */
declare(strict_types=1);

return [
    '/solutions/' => [
        'title' => 'Solutions by Role and Institution',
        'desc'  => 'How Acadlytic is designed to support leadership, administrators, admissions, faculty, advisors, registrars, finance, IT, students and parents.',
        'h1'    => 'Solutions for every team on campus',
        'nav_label' => 'Solutions',
        'lead'  => 'The same platform, shaped around each person’s work. Find the role or institution closest to yours.',
        'groups' => [
            ['title' => 'By institution', 'text' => 'How Acadlytic fits different kinds of institutions. See also [all institution types](/industries/).', 'paths' => [
                '/solutions/for-universities/', '/solutions/for-colleges/', '/solutions/for-higher-education/',
            ]],
            ['title' => 'Leadership & administration', 'paths' => [
                '/solutions/for-leadership/', '/solutions/for-administrators/', '/solutions/for-operations/', '/solutions/for-registrars/', '/solutions/for-finance-teams/', '/solutions/for-it-teams/',
            ]],
            ['title' => 'Student-facing teams', 'paths' => [
                '/solutions/for-admissions-teams/', '/solutions/for-advisors/', '/solutions/for-student-services/', '/solutions/for-faculty/',
            ]],
            ['title' => 'Students & families', 'paths' => [
                '/solutions/for-students/', '/solutions/for-parents/',
            ]],
        ],
    ],

    '/solutions/for-universities/' => [
        'title' => 'CRM & Academic Management for Universities',
        'desc'  => 'Acadlytic for universities: CRM and academic management for multi-faculty operations, large admission cycles, international recruitment and complex progression rules.',
        'h1'    => 'Acadlytic for universities',
        'nav_label' => 'Universities',
        'lead'  => 'Universities combine the scale of a large organisation with the autonomy of many faculties. Acadlytic is designed to give central teams consistency and faculties the flexibility they need.',
        'icon'  => 'building',
        'blocks' => [
            sec('What makes universities different',
                'A university may run hundreds of programmes across several faculties, with separate admission rules, assessment regulations and calendars. Central functions (admissions, registry, finance and IT) need one view of the institution, while faculties need to run their own processes without waiting on central teams.'),
            table('University challenges and how Acadlytic is designed to help', ['Challenge', 'How Acadlytic is designed to help'], [
                ['Large, multi-programme admission cycles', '[Admissions CRM](/platform/admissions-crm/) with programme-specific forms, routing and reviewer workflows'],
                ['Faculty autonomy vs central oversight', 'Faculty-level configuration within institution-wide standards and permissions'],
                ['International recruitment', 'Agent management, time-zone aware communication and document verification'],
                ['Complex progression rules', 'Rules engine in [academic operations](/platform/academic-operations/) and [completion tracking](/platform/completion-tracking/)'],
                ['Many existing systems', 'Integration with SIS, LMS, ERP and identity providers'],
                ['Leadership reporting', 'Consistent definitions across faculties in the [institutional dashboard](/platform/institutional-dashboard/)'],
            ]),
            cards('The university CRM', [
                'Recruitment' => 'Manage domestic and international enquiries, events, school relationships and agents in one CRM.',
                'Postgraduate & research' => 'Supervisor matching, proposal documents and longer decision cycles.',
                'Continuing relationships' => 'Alumni, executive education and lifelong-learning relationships on the same record.',
            ]),
            steps('A phased rollout', [
                'Admissions & CRM first' => 'The highest-impact starting point, often ready for the next cycle.',
                'Student records & academics' => 'Extend to enrolled students, faculty by faculty if preferred.',
                'Finance & communication' => 'Connect fees and institution-wide messaging.',
                'Analytics & AI' => 'Leadership dashboards and AI features once data flows are established.',
            ]),
            faq([
                'Can each faculty configure its own admission process?' => 'Yes, that is the plan. Faculties can have programme-specific forms, criteria and reviewer workflows within institution-wide standards and permissions.',
                'Can a university keep its existing SIS?' => 'Yes, that is the plan. Acadlytic can run CRM, communication and analytics alongside an existing SIS through [SIS integration](/integrations/sis-integration/), or replace it in phases.',
                'Where do universities usually start?' => 'With admissions and CRM, because it has the fastest visible impact, then student records, academics, finance and analytics.',
            ]),
        ],
        'related' => ['/industries/multi-campus/', '/industries/international-education/', '/core/edtech-crm/', '/solutions/for-leadership/', '/integrations/sis-integration/'],
    ],

    '/solutions/for-colleges/' => [
        'title' => 'CRM & Academic Management for Colleges',
        'desc'  => 'Acadlytic for colleges: a CRM and academic management platform designed to let small teams run admissions, academics, fees and communication in one place.',
        'h1'    => 'Acadlytic for colleges',
        'nav_label' => 'Colleges',
        'lead'  => 'Colleges often run on small teams wearing many hats. Acadlytic is designed to replace spreadsheets and disconnected tools with one platform that is quick to set up and easy to run.',
        'icon'  => 'building',
        'blocks' => [
            sec('Lean teams, high expectations',
                'In many colleges the same few people handle enquiries, admissions, fee collection and parent queries, often from spreadsheets and personal phones. Students and parents still expect quick, accurate answers. The goal is not more software; it is fewer places to look.'),
            cards('What colleges typically start with', [
                'Enquiry to admission' => 'Capture enquiries, follow up automatically and track applications to enrolment.',
                'Student records' => 'One record per student with documents, attendance and results.',
                'Fee collection' => 'Fee plans, online payment and automatic reminders.',
                'Parent & student messaging' => 'SMS, WhatsApp and email from one place, with history.',
            ]),
            checks('Designed for smaller institutions', [
                'Pre-configured templates for common college processes',
                'Guided import from existing spreadsheets',
                'Training for staff who are not IT specialists',
                'Pricing scoped to your size; see [pricing](/core/pricing/)',
                'Grow into analytics and AI features when ready',
            ]),
            sec('The college CRM',
                'For colleges, the CRM is where growth starts: knowing which enquiries came from which school visit or campaign, following up every one, and seeing how many became students. Acadlytic’s planned [admissions CRM](/platform/admissions-crm/) is designed to give even a two-person admissions office that visibility.'),
            faq([
                'Is Acadlytic suitable for a small college?' => 'Yes, that is the plan. Colleges can start with enquiries, admissions, student records, fees and messaging, with pricing scoped to their size.',
                'Can we move from spreadsheets quickly?' => 'Guided imports map and validate existing spreadsheets, and common college processes come pre-configured as templates.',
            ]),
        ],
        'related' => ['/industries/private-institutions/', '/industries/community-colleges/', '/platform/admissions-crm/', '/comparisons/spreadsheets-vs-academic-platform/', '/core/pricing/'],
    ],

    '/solutions/for-higher-education/' => [
        'title' => 'Higher Education Technology Platform',
        'desc'  => 'How a connected higher education platform brings together CRM, student records, academic operations, finance and analytics, and where Acadlytic fits your stack.',
        'h1'    => 'A connected technology platform for higher education',
        'nav_label' => 'Higher Education',
        'lead'  => 'Higher education technology has grown one system at a time. Acadlytic is designed to help institutions connect the pieces, or replace several of them, around a single view of each student.',
        'icon'  => 'cap',
        'blocks' => [
            sec('The typical higher education stack',
                'Most institutions run some combination of a student information system, a learning management system, a finance or ERP package, a website and enquiry forms, messaging tools and spreadsheets for everything else. Each system has an owner and a purpose. The gaps between them are where students wait and staff re-key data.'),
            table('Where Acadlytic is designed to sit', ['Layer', 'Examples', 'Acadlytic’s role'], [
                ['Relationship & CRM', 'Enquiries, applicants, alumni', 'Core capability'],
                ['Student records', 'Profiles, enrolment, status', 'Core capability or [SIS integration](/integrations/sis-integration/)'],
                ['Academic operations', 'Timetables, attendance, results', 'Core capability'],
                ['Learning', 'Course content, online activities', 'Integrates with your [LMS](/integrations/lms-integration/)'],
                ['Finance', 'Fees, ledger, payroll', 'Student fees; integrates with [ERP](/integrations/erp-integration/)'],
                ['Identity', 'Single sign-on, directories', 'Integrates via [SSO](/integrations/sso-integration/)'],
                ['Analytics & AI', 'Dashboards, predictions', 'Built in, with [data export](/integrations/data-export/)'],
            ]),
            checks('Principles for a healthier stack', [
                'One authoritative source for each type of data',
                'Integrations documented and monitored, not ad hoc',
                'Single sign-on for staff and students',
                'Consistent definitions for reporting',
                'Exit plans and data portability for every system',
            ]),
            faq([
                'Which systems does Acadlytic replace in a higher education stack?' => 'It can replace separate enquiry tools, spreadsheets, messaging tools and, where institutions choose, the student records layer. It integrates with the LMS, ERP and identity systems that stay.',
                'How should an institution decide what to keep?' => 'Name one authoritative system for each type of data, keep what works well and is integrated, and consolidate where data is duplicated.',
            ]),
        ],
        'related' => ['/resources/digital-transformation-education/', '/comparisons/point-solutions-vs-platform/', '/solutions/for-it-teams/', '/industries/'],
    ],

    '/solutions/for-leadership/' => [
        'title' => 'Solutions for Institutional Leadership',
        'desc'  => 'Give presidents, vice-chancellors, principals and directors a live, trustworthy view of admissions, academics, finance and student outcomes, with AI summaries.',
        'h1'    => 'For institutional leadership',
        'nav_label' => 'Leadership',
        'lead'  => 'Lead with current, consistent information instead of month-old spreadsheets, and spend meetings deciding rather than debating whose numbers are right.',
        'icon'  => 'trend',
        'blocks' => [
            sec('What leadership needs from a platform',
                'Leaders need a small number of reliable indicators, early warning when something moves, and confidence that the numbers mean the same thing in every department. They also need to know that operational teams have the tools to act on what the numbers show.'),
            cards('How Acadlytic is designed to support leaders', [
                'Institutional dashboard' => 'Admissions, enrolment, academic health, finance and support indicators in one [dashboard](/platform/institutional-dashboard/).',
                'Weekly AI summary' => 'A plain-language digest of notable changes, drafted by [AI reporting](/ai/ai-reporting/).',
                'Forecasts as ranges' => '[Predictive analytics](/ai/ai-predictive-analytics/) for enrolment planning.',
                'Accountability' => 'Owners and targets for each indicator, visible to the teams responsible.',
            ]),
            checks('Questions you should be able to answer on any given day', [
                'Are we ahead or behind last cycle’s admissions at this point?',
                'Which programmes are under-subscribed?',
                'How quickly are we responding to enquiries?',
                'How many students are flagged for support, and are they being contacted?',
                'What is our collections position and dues ageing?',
            ]),
            faq([
                'What will leadership see in Acadlytic?' => 'An institutional dashboard of agreed indicators across admissions, enrolment, academic health, support and finance, plus a weekly AI summary of notable changes.',
                'Can leaders drill into the numbers?' => 'Yes, that is the plan. Any indicator opens the underlying records, within the viewer’s permissions.',
            ]),
        ],
        'related' => ['/platform/institutional-dashboard/', '/resources/institutional-dashboard-guide/', '/resources/data-driven-education/', '/ai/ai-predictive-analytics/'],
    ],

    '/solutions/for-administrators/' => [
        'title' => 'Solutions for Academic Administrators',
        'desc'  => 'Acadlytic is designed to help academic administrators cut manual work with automated workflows, shared records, task queues and scheduled reports.',
        'h1'    => 'For academic administrators',
        'nav_label' => 'Administrators',
        'lead'  => 'Fewer spreadsheets, fewer hand-offs and fewer “can you send me that list?” emails. Acadlytic is designed to give administrators one place to run processes and see what is pending.',
        'icon'  => 'dashboard',
        'blocks' => [
            sec('Where administrative time goes',
                'Administrators spend much of their week on work that exists only because systems do not talk to each other: re-entering data, chasing missing documents, reconciling lists and answering status questions. Each task is small; together they crowd out the work that improves the institution.'),
            table('Common tasks, before and after', ['Task', 'Without a connected platform', 'With Acadlytic'], [
                ['Chasing missing documents', 'Manual lists and individual emails', 'Automatic reminders and a live checklist'],
                ['Monthly reports', 'Exports combined in spreadsheets', 'Scheduled reports from live data'],
                ['Student status changes', 'Updates in several systems', 'One change, reflected everywhere'],
                ['Approvals', 'Email chains', 'Routed approvals with deadlines and history'],
                ['“Where is my request?” queries', 'Phone and email back-and-forth', 'Self-service status in student portals'],
            ]),
            cards('Planned tools for administrators', [
                'Workflow automation' => 'Standardise recurring processes with [workflows](/platform/workflow-automation/).',
                'Task queues' => 'Shared team queues with owners and due dates.',
                'Bulk actions' => 'Update many records at once, safely, with previews.',
                'Scheduled reports' => 'Reports delivered automatically to the people who need them.',
            ]),
            faq([
                'Which administrative tasks does Acadlytic reduce?' => 'Re-keying data between systems, chasing documents, compiling monthly reports, routing approvals by email and answering status queries.',
                'Can administrators change workflows themselves?' => 'Yes, that is the plan. Authorised administrators configure workflows, templates and reports without developers.',
            ]),
        ],
        'related' => ['/platform/workflow-automation/', '/platform/task-management/', '/solutions/for-operations/', '/resources/education-automation-guide/'],
    ],

    '/solutions/for-operations/' => [
        'title' => 'Solutions for Operations Teams',
        'desc'  => 'For institutional operations teams: coordinate facilities, events, logistics and service requests with shared workflows, task queues and live operational dashboards.',
        'h1'    => 'For operations teams',
        'nav_label' => 'Operations Teams',
        'lead'  => 'Operations keeps an institution running: rooms, events, logistics, service requests and the countless details behind each term. Acadlytic is designed to connect that work to the academic calendar and student data it depends on.',
        'icon'  => 'workflow',
        'blocks' => [
            sec('Operations depends on academic data',
                'Room bookings depend on timetables. Event logistics depend on registrations. Hostel allocation depends on confirmed enrolments. When operations teams work from exported lists, changes upstream arrive late. A shared platform means operational plans update when academic data does.'),
            cards('Planned operational use cases', [
                'Service requests' => 'Students and staff submit requests that become tracked tasks with service levels.',
                'Events' => 'Registrations, reminders and attendance for orientations, open days and ceremonies.',
                'Room & resource use' => 'Timetable-linked room information and change notifications.',
                'Term readiness' => 'Checklists for term start, exams and results periods, with owners and deadlines.',
            ]),
            sec('Term-start readiness, as an example',
                'Before a new term, operations teams confirm rooms, publish timetables, prepare ID cards, brief front-desk staff and plan orientation. In Acadlytic this is designed to become a reusable checklist whose tasks are assigned automatically each term, with progress visible to everyone involved.'),
            checks('What operations leads will be able to monitor', [
                'Open requests by category and age',
                'Upcoming events and registration numbers',
                'Tasks at risk of missing deadlines',
                'Term-readiness checklist completion',
            ]),
            faq([
                'Can students raise service requests online?' => 'Yes, that is the plan. Requests submitted through the portal become tracked tasks with categories, owners and service-level targets.',
                'Does operations planning update when timetables change?' => 'Yes, that is the plan. Operations works from the same timetable and enrolment data, so changes flow through without exported lists.',
            ]),
        ],
        'related' => ['/platform/task-management/', '/platform/workflow-automation/', '/solutions/for-administrators/', '/integrations/calendar-integration/'],
    ],

    '/solutions/for-registrars/' => [
        'title' => 'Solutions for Registrars',
        'desc'  => 'For registrars and examination offices: authoritative student records, enrolment and status workflows, results processing, transcripts and secure document issuance.',
        'h1'    => 'For registrars and examination offices',
        'nav_label' => 'Registrars',
        'lead'  => 'The registrar’s office is the custodian of the official record. Acadlytic is designed to help you keep it accurate, apply regulations consistently and issue documents securely.',
        'icon'  => 'doc',
        'blocks' => [
            cards('Responsibilities Acadlytic is designed to support', [
                'Official records' => 'Authoritative student records with change history and field-level permissions.',
                'Enrolment & status' => 'Registration, deferrals, withdrawals and transfers through approval workflows.',
                'Results processing' => 'Marks consolidation, moderation, progression rules and publication.',
                'Transcripts & certificates' => 'Generate documents from verified data and share them securely.',
                'Regulatory reporting' => 'Consistent data for statutory and accreditation returns.',
                'Verification requests' => 'Handle third-party verification requests with consent and logging.',
            ]),
            steps('Planned secure document issuance', [
                'Request' => 'A student or authorised third party requests a document.',
                'Checks' => 'Clearances and eligibility are verified automatically where possible.',
                'Generate' => 'The document is produced from the official record using approved templates.',
                'Approve' => 'An authorised officer approves release.',
                'Share' => 'The recipient receives a secure, expiring link; access is logged.',
            ]),
            note('Every change to an official record is attributed and time-stamped, supporting audits and appeals.'),
            faq([
                'How are changes to official records controlled?' => 'Through role-based permissions, approval workflows and a full history recording who changed what, when and from which value.',
                'Can third parties verify a student’s credentials?' => 'Verification requests are designed to be handled with the student’s consent, with every response logged.',
            ]),
        ],
        'related' => ['/platform/student-management/', '/platform/electronic-document-sharing/', '/platform/data-management/', '/platform/completion-tracking/'],
    ],

    '/solutions/for-finance-teams/' => [
        'title' => 'Solutions for Finance Teams',
        'desc'  => 'For finance teams: fee configuration, invoicing, online collection, concessions, reconciliation and dues reporting, connected to student records and your ERP.',
        'h1'    => 'For finance teams',
        'nav_label' => 'Finance Teams',
        'lead'  => 'Configure fees once, collect online, reconcile automatically and answer every fee question with the full student context.',
        'icon'  => 'rupee',
        'blocks' => [
            sec('Student finance is a service',
                'For students and parents, fees are one of the most anxiety-inducing parts of institutional life. Clear invoices, flexible payment options and quick, accurate answers make a real difference to trust. For finance teams, the challenge is doing that while keeping the books reconciled.'),
            cards('Planned finance capabilities', [
                'Fee configuration' => 'Structures by programme, year and category with effective dates.',
                'Collection' => 'Online payments through [payment gateways](/integrations/payment-integration/), with instalment plans.',
                'Concessions' => 'Scholarship and waiver workflows with approval limits.',
                'Reconciliation' => 'Automatic matching of settlements with exception handling.',
                'Ledger integration' => 'Summaries posted to your [ERP or accounting system](/integrations/erp-integration/).',
                'Dues reporting' => 'Ageing, collection rates and forecasts by programme.',
            ]),
            checks('Controls finance teams expect', [
                'Segregation of duties for configuration, approval and posting',
                'Complete audit trail for every financial change',
                'Role-restricted access to financial data',
                'Daily reconciliation reports',
            ]),
            faq([
                'How does Acadlytic reconcile online payments?' => 'Gateway settlements are matched to payments and invoices automatically each day, and exceptions are flagged for finance.',
                'Does Acadlytic support segregation of duties?' => 'Yes, that is the plan. Configuration, approval and posting can be assigned to different roles, and every financial change is audited.',
            ]),
        ],
        'related' => ['/platform/finance-fees/', '/integrations/payment-integration/', '/integrations/erp-integration/', '/solutions/for-parents/'],
    ],

    '/solutions/for-it-teams/' => [
        'title' => 'Solutions for IT Teams',
        'desc'  => 'For IT teams evaluating Acadlytic: architecture, integrations, SSO, security, data access, environments and how the platform reduces custom integration maintenance.',
        'h1'    => 'For IT teams',
        'nav_label' => 'IT Teams',
        'lead'  => 'Acadlytic is designed to be a good citizen in your technology estate: standards-based identity, documented APIs, predictable change management and clear data ownership.',
        'icon'  => 'code',
        'blocks' => [
            sec('What IT teams usually ask first',
                'How does it authenticate users? How do we get data in and out? Who can see what? How are changes rolled out? What happens if we leave? We answer each of these in writing during evaluation. This page summarises the approach.'),
            table('Planned technical overview', ['Area', 'Approach'], [
                ['Hosting', 'Managed cloud service; see [Cloud Platform](/core/cloud-platform/)'],
                ['Identity', 'Single sign-on via SAML 2.0 or OpenID Connect; see [SSO integration](/integrations/sso-integration/)'],
                ['Integration', 'REST [API](/integrations/api/), [webhooks](/integrations/webhooks/) and scheduled [exports](/integrations/data-export/)'],
                ['Access control', 'Role-based, with department and campus scoping and field-level restrictions'],
                ['Audit', 'Logs for sign-ins, permission changes, data access and exports'],
                ['Environments', 'Sandbox environments for configuration and integration testing'],
                ['Portability', 'Full data export in open formats'],
            ]),
            checks('How we work with IT', [
                'Integration design sessions before contract',
                'Named technical contact during implementation',
                'Advance notice of changes that affect integrations',
                'Security documentation on request',
            ]),
            faq([
                'How will users sign in?' => 'Through single sign-on with your identity provider, or Acadlytic credentials where SSO is not used.',
                'How are platform changes communicated?' => 'Changes that affect integrations are announced in advance, and sandbox environments are available for testing.',
            ]),
        ],
        'related' => ['/integrations/', '/core/security/', '/integrations/api/', '/resources/education-cloud-checklist/'],
    ],

    '/solutions/for-admissions-teams/' => [
        'title' => 'Solutions for Admissions Teams',
        'desc'  => 'For admissions teams: faster response to every enquiry, organised follow-ups, application tracking and clear conversion reporting, with AI that prepares the groundwork.',
        'h1'    => 'For admissions teams',
        'nav_label' => 'Admissions Teams',
        'lead'  => 'Respond to every enquiry quickly, know exactly who to follow up with and show leadership how recruitment is really going.',
        'icon'  => 'users',
        'blocks' => [
            sec('A day in admissions, simplified',
                'In the planned design, a counsellor’s morning starts with a prioritised list of follow-ups, each with a one-line summary of the last interaction. During the day, calls and messages will be logged automatically on the applicant’s timeline. In the evening, the dashboard will show how many enquiries were handled and which are overdue, with no spreadsheet to update.'),
            cards('What admissions teams will get', [
                'One enquiry queue' => 'Every channel in one place, deduplicated and assigned.',
                'Personal follow-ups at scale' => 'Sequences that feel individual and stop when the applicant responds.',
                'Application visibility' => 'Checklists and status for every applicant; see [application management](/platform/application-management/).',
                'Event management' => 'Open days and fairs with registration, reminders and attendance.',
                'Conversion reporting' => 'Funnel by source, programme and counsellor in [enrolment analytics](/platform/enrollment-analytics/).',
                'AI assistance' => 'Prioritisation, summaries and draft replies from [AI for Admissions](/ai/ai-for-admissions/).',
            ]),
            checks('Admissions metrics the platform is designed to track', [
                'Time to first response',
                'Enquiry-to-application conversion',
                'Application completion rate',
                'Offer acceptance rate',
                'Enrolments by source',
            ]),
            faq([
                'How quickly can every enquiry get a response?' => 'An automatic acknowledgement goes out immediately, and assignment rules give each enquiry an owner for personal follow-up.',
                'Can we see which campaigns produce enrolments?' => 'Yes, that is the plan. Source attribution follows each enquiry through application to enrolment.',
            ]),
        ],
        'related' => ['/platform/admissions-crm/', '/ai/ai-for-admissions/', '/resources/admissions-workflow/', '/resources/admissions-crm-guide/'],
    ],

    '/solutions/for-advisors/' => [
        'title' => 'Solutions for Academic Advisors',
        'desc'  => 'For academic advisors and counsellors: full student context, caseload views, early-warning signals, meeting notes and referrals, so every conversation counts.',
        'h1'    => 'For academic advisors and counsellors',
        'nav_label' => 'Advisors',
        'lead'  => 'See each student’s full picture before you meet, know which students to reach out to, and keep notes and referrals in one place.',
        'icon'  => 'compass',
        'blocks' => [
            cards('Planned advisor workspace', [
                'Caseload view' => 'All assigned students with progress, flags and last contact date.',
                'Student 360' => 'Programme progress, attendance, results, cases and communication in one view.',
                'Early-warning list' => 'Students who may need support, with reasons, from [AI for Student Success](/ai/ai-for-student-success/).',
                'Appointments' => 'Booking links and reminders through [calendar integration](/integrations/calendar-integration/).',
                'Notes & referrals' => 'Structured notes with visibility controls and referrals to support services.',
                'Degree progress' => 'What each student still needs to complete, from [completion tracking](/platform/completion-tracking/).',
            ]),
            sec('Also for college and career counsellors',
                'Counsellors guiding students toward further study can use [college recommendations](/platform/college-recommendations/) and the [post-secondary school database](/platform/post-secondary-school-database/) to build balanced shortlists, track applications and record outcomes.'),
            note('Sensitive notes, such as wellbeing or personal circumstances, are designed to be restricted to specific roles so students’ trust is protected.'),
            faq([
                'What will an advisor’s caseload view show?' => 'Each assigned student’s progress, early-warning flags and the date of last contact, so outreach can be planned.',
                'Can wellbeing notes be kept private?' => 'Yes, that is the plan. Sensitive note types can be restricted to specific roles.',
            ]),
        ],
        'related' => ['/ai/ai-for-advising/', '/ai/ai-for-student-success/', '/solutions/for-student-services/', '/platform/completion-tracking/'],
    ],

    '/solutions/for-student-services/' => [
        'title' => 'Solutions for Student Services',
        'desc'  => 'For student services teams: case management, service requests, referrals, wellbeing support and communication, with full context and privacy controls.',
        'h1'    => 'For student services teams',
        'nav_label' => 'Student Services',
        'lead'  => 'From hostel queries to wellbeing referrals, student services handle a wide range of needs. Acadlytic is designed to help teams respond consistently, hand over cleanly and protect sensitive information.',
        'icon'  => 'support',
        'blocks' => [
            steps('Planned case management flow', [
                'Intake' => 'Requests arrive from the portal, email, walk-ins or referrals and become cases.',
                'Triage' => 'Cases are categorised and routed by type and urgency.',
                'Support' => 'Staff record actions and communication; related teams can be involved with appropriate visibility.',
                'Resolution' => 'Outcomes are recorded and the student is informed.',
                'Learning' => 'Case trends inform service improvements and staffing.',
            ]),
            cards('Services the platform is designed to manage', [
                'General enquiries' => 'Certificates, ID cards, schedules and policies.',
                'Accommodation' => 'Hostel applications, allocation queries and maintenance requests.',
                'Wellbeing' => 'Confidential referrals with restricted visibility.',
                'Accessibility support' => 'Adjustments and accommodations coordinated with faculty.',
                'Career services' => 'Appointments, events and placement activities.',
                'International students' => 'Arrival support, documentation and reminders.',
            ]),
            sec('Consistent service, whoever answers',
                'Students should get the same quality of answer whether they ask at the front desk, by email or through the portal. Shared case history and approved response templates mean any team member can pick up a case without asking the student to repeat themselves.'),
            checks('Privacy for sensitive cases', [
                'Case types with restricted visibility',
                'Minimum necessary information shared with other teams',
                'Access to sensitive cases logged',
            ]),
            faq([
                'Can cases be handed over between teams?' => 'Yes, that is the plan. Cases keep their full history, so the next team member continues without asking the student to repeat themselves.',
                'How are confidential cases protected?' => 'Restricted case types limit who can open them, and access to sensitive cases is logged.',
            ]),
        ],
        'related' => ['/platform/student-engagement/', '/solutions/for-advisors/', '/platform/task-management/', '/resources/student-engagement-strategies/'],
    ],

    '/solutions/for-faculty/' => [
        'title' => 'Solutions for Faculty',
        'desc'  => 'For faculty: quick attendance, simple marks entry, class lists with context and alerts about students who may need support, so teaching comes first.',
        'h1'    => 'For faculty',
        'nav_label' => 'Faculty',
        'lead'  => 'Less time on administration, more time teaching. Acadlytic is designed to keep faculty tasks quick and put useful student context one tap away.',
        'icon'  => 'book',
        'blocks' => [
            cards('Planned faculty essentials', [
                'Today view' => 'Classes, rooms and tasks for the day, including timetable changes.',
                'Attendance in seconds' => 'Mark attendance on mobile or desktop; absences update student records instantly.',
                'Marks entry' => 'Validated entry, bulk upload and moderation steps where required.',
                'Class insight' => 'Attendance and submission patterns for each class.',
                'Student context' => 'Relevant information such as accommodations or advisor, within permissions.',
                'Messaging' => 'Message a class or individual students with history kept.',
            ]),
            sec('Working with your LMS',
                'Faculty already use a learning management system for content and online activities. Acadlytic is not designed to replace it; it is designed to connect to it. Enrolments will flow to the LMS and, where configured, grades and activity data will flow back. See [LMS integration](/integrations/lms-integration/).'),
            checks('What matters to faculty', [
                'Few clicks for routine tasks',
                'Works well on a phone in a classroom',
                'No duplicate entry between systems',
                'Clear alerts, not a flood of notifications',
            ]),
            faq([
                'How long does attendance take?' => 'A few taps per class on mobile or desktop, with absences flowing to student records automatically.',
                'Will faculty receive too many notifications?' => 'Alerts are limited to meaningful events such as attendance thresholds or missed submissions, and digests can replace instant alerts.',
            ]),
        ],
        'related' => ['/platform/academic-operations/', '/integrations/lms-integration/', '/ai/ai-for-student-success/', '/solutions/for-advisors/'],
    ],

    '/solutions/for-students/' => [
        'title' => 'Student Portal & Experience',
        'desc'  => 'For students: one portal for applications, documents, timetables, attendance, results, fees and messages, available on mobile, with clear next steps.',
        'h1'    => 'For students: one place for everything',
        'nav_label' => 'Students',
        'lead'  => 'Applications, deadlines, timetables, results, fees and messages in one mobile-friendly portal, so students always know where they stand and what to do next.',
        'icon'  => 'cap',
        'blocks' => [
            sec('What students want from institutional systems',
                'Students want clarity: what is due, when, and what happens next. They want to request a document without visiting an office, pay a fee without queueing and see results as soon as they are published. They also want to know their information is handled carefully.'),
            cards('Planned student portal features', [
                'Applicant view' => 'Application checklist, document uploads and decision status.',
                'My timetable' => 'Classes and changes, with calendar sync.',
                'Attendance & results' => 'Personal attendance record and published results.',
                'Fees' => 'Dues, online payment and receipts.',
                'Requests' => 'Certificates, transcripts and services with status tracking.',
                'Messages' => 'Institutional messages in one inbox, with preferences.',
            ]),
            checks('Accessibility and inclusion', [
                'Designed to work with screen readers and keyboard navigation',
                'Readable on small screens and slower connections',
                'Plain-language content and multilingual messages where configured',
                'Privacy controls students can understand',
            ]),
            faq([
                'What can students do in the portal?' => 'Track applications, upload documents, view timetables, attendance and results, pay fees, request certificates and read messages.',
                'Does the student portal work on phones?' => 'Yes, that is the plan. It is designed for small screens and slower connections.',
            ]),
        ],
        'related' => ['/solutions/for-parents/', '/platform/college-recommendations/', '/trust/accessibility/', '/platform/student-engagement/'],
    ],

    '/solutions/for-parents/' => [
        'title' => 'Parent Communication & Portal',
        'desc'  => 'Keep parents and guardians informed about attendance, results, fees and events through their preferred channel, within the student’s privacy settings.',
        'h1'    => 'For parents and guardians',
        'nav_label' => 'Parents',
        'lead'  => 'Timely, relevant updates about attendance, progress, fees and events, through the channel parents prefer and within the privacy rules your institution sets.',
        'icon'  => 'message',
        'blocks' => [
            sec('Keeping families informed, appropriately',
                'Parents want to support their children’s studies and need practical information about fees, events and important changes. Institutions must balance that with students’ own privacy, especially for adult learners. Acadlytic is designed to let institutions define what is shared with guardians, by programme and age, and keeps a record of consent.'),
            cards('What parents are planned to receive', [
                'Attendance alerts' => 'Notifications when attendance falls below a threshold, where policy allows.',
                'Results' => 'Published results or progress summaries.',
                'Fee information' => 'Dues, reminders, payment links and receipts.',
                'Events & notices' => 'Orientation, parent meetings and holiday notices.',
                'Emergency messages' => 'Urgent updates through the fastest available channel.',
            ]),
            table('Planned channels', ['Channel', 'Best for'], [
                ['WhatsApp', 'Quick updates and reminders where families have opted in'],
                ['SMS', 'Short alerts, especially where data connectivity is limited'],
                ['Email', 'Detailed notices, statements and documents'],
                ['Parent portal', 'Self-service access to fees, results and messages'],
            ]),
            faq([
                'What information can parents see?' => 'What the institution chooses to share with guardians, such as attendance alerts, results, fees and events, subject to consent and the student’s privacy settings.',
                'Can parents pay fees online?' => 'Yes, that is the plan. Payment links can be sent to linked parents, and receipts go to both the payer and the student record.',
            ]),
        ],
        'related' => ['/platform/communication-hub/', '/integrations/whatsapp-integration/', '/ai/ai-communications/', '/platform/finance-fees/'],
    ],
];
