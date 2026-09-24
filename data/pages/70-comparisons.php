<?php
/** Side-by-side comparison guides. */
declare(strict_types=1);

return [
    '/comparisons/' => [
        'title' => 'Academic Technology Comparisons',
        'desc'  => 'Side-by-side comparisons to help institutions decide: CRM vs SIS, CRM vs ERP, cloud vs on-premise, spreadsheets vs platforms, manual vs automated admissions and more.',
        'h1'    => 'Comparisons',
        'nav_label' => 'Comparisons',
        'lead'  => 'Honest, side-by-side comparisons of common choices institutions face when modernising their systems, including when the simpler option is the right one.',
    ],

    '/comparisons/academic-crm-vs-sis/' => [
        'title' => 'Academic CRM vs SIS: What’s the Difference?',
        'desc'  => 'Academic CRM vs student information system: how they differ in purpose, data, users and timing, and whether your institution needs one, the other or both.',
        'h1'    => 'Academic CRM vs student information system',
        'nav_label' => 'Academic CRM vs SIS',
        'lead'  => 'Both hold student data, so they are often confused. They do different jobs, and understanding the difference prevents expensive mistakes.',
        'blocks' => [
            takeaways(
                'A CRM manages relationships; an SIS holds the official academic record',
                'Most institutions need both capabilities, separately integrated or unified',
                'Choose a unified platform when duplicate student records are a daily problem',
            ),
            table('Side by side', ['Aspect', 'Academic CRM', 'Student information system'], [
                ['Primary purpose', 'Relationships and engagement', 'Official academic record'],
                ['Main users', 'Admissions, marketing, student services, advisors', 'Registry, examinations, faculty'],
                ['Lifecycle focus', 'Enquiry through alumni, emphasis before and around enrolment', 'Enrolment through graduation'],
                ['Typical data', 'Interactions, communications, tasks, preferences, sources', 'Registrations, grades, credits, awards'],
                ['Change pace', 'Frequent, as engagement evolves', 'Controlled, with formal approvals'],
                ['Key question answered', 'Who should we contact, and about what?', 'What is this student’s official status and record?'],
            ]),
            sec('Do you need both?',
                'Most institutions need both capabilities. The question is whether they live in separate, integrated systems or on one platform with a shared data model. Separate systems give specialisation but require integration and reconciliation. A unified platform removes duplicate records but must be strong in both areas.'),
            checks('Choose separate systems when', [
                'You have a strong SIS you want to keep for records and results',
                'Your main gap is recruitment and engagement',
                'Your IT team can support a reliable integration',
            ]),
            checks('Choose a unified platform when', [
                'Your current SIS is ageing or fragmented',
                'Duplicate student records are a daily problem',
                'You want lifecycle reporting without joining systems',
            ]),
            faq([
                'Can one platform be both a CRM and an SIS?' => 'Yes. Unified platforms provide both on one data model, removing duplicate records between recruitment and registry.',
                'Which should an institution buy first?' => 'Whichever closes the bigger gap. If recruitment and follow-up are weak, a CRM usually comes first.',
            ]),
        ],
        'related' => ['/glossary/academic-crm/', '/glossary/student-information-system/', '/integrations/sis-integration/', '/comparisons/academic-crm-vs-erp/'],
    ],

    '/comparisons/academic-crm-vs-erp/' => [
        'title' => 'Academic CRM vs ERP for Education',
        'desc'  => 'Education CRM vs ERP: compare purpose, users, data and strengths, and see where each fits in an institution’s technology stack and how they work together.',
        'h1'    => 'Academic CRM vs ERP',
        'nav_label' => 'Academic CRM vs ERP',
        'lead'  => 'CRM manages relationships. ERP manages resources. Institutions need both capabilities; this comparison shows where each fits.',
        'blocks' => [
            takeaways(
                'CRM focuses on people and engagement; ERP on resources and transactions',
                'Keep ledger, payroll and procurement in the ERP',
                'Run student-facing relationships and fees in an education platform linked to the ERP',
            ),
            table('Side by side', ['Aspect', 'Academic CRM', 'Academic ERP'], [
                ['Focus', 'People and relationships', 'Resources and transactions'],
                ['Typical scope', 'Enquiries, applicants, students, parents, alumni, partners', 'Finance, HR, payroll, procurement, sometimes student administration'],
                ['Main users', 'Admissions, student services, communications', 'Finance, HR, administration'],
                ['Success measure', 'Engagement, conversion, satisfaction, retention', 'Accuracy, compliance, efficiency'],
                ['Change pace', 'Frequent campaigns and workflow changes', 'Stable processes with controlled change'],
            ]),
            sec('How they work together',
                'A common pattern is to keep the general ledger, payroll and procurement in an ERP, and manage student-facing relationships, communication and fees in an education platform, posting summarised financial entries to the ERP. See [ERP integration](/integrations/erp-integration/).'),
            checks('Warning signs of the wrong tool for the job', [
                'Admissions teams working in spreadsheets because the ERP cannot handle enquiries',
                'Student communication sent from personal accounts',
                'Finance re-keying fee payments from another system',
                'Leadership unable to see the recruitment funnel',
            ]),
            faq([
                'Can an ERP handle admissions?' => 'Some ERP suites include admissions modules, but they are usually weaker at multi-channel enquiry capture, nurture and conversion reporting than a CRM.',
                'Do we need both a CRM and an ERP?' => 'Most institutions need both capabilities, either as separate integrated systems or through a platform that covers the student-facing side.',
            ]),
        ],
        'related' => ['/glossary/academic-erp/', '/integrations/erp-integration/', '/comparisons/academic-crm-vs-sis/', '/core/edtech-crm/'],
    ],

    '/comparisons/cloud-vs-on-premise-education/' => [
        'title' => 'Cloud vs On-Premise Education Software',
        'desc'  => 'Compare cloud and on-premise academic software on cost, security, control, updates, scalability, connectivity and exit, and decide which suits your institution.',
        'h1'    => 'Cloud vs on-premise education software',
        'nav_label' => 'Cloud vs On-Premise',
        'lead'  => 'Where your academic systems run affects cost, security responsibilities, agility and staff workload. Here is a balanced comparison.',
        'blocks' => [
            takeaways(
                'Cloud lowers upfront cost and infrastructure work; on-premise gives full control',
                'Security is shared in the cloud and entirely yours on-premise',
                'On-premise still fits strict residency rules or unreliable connectivity',
            ),
            table('Side by side', ['Aspect', 'Cloud (SaaS)', 'On-premise'], [
                ['Upfront cost', 'Low; subscription-based', 'High; licences, servers, setup'],
                ['Ongoing effort', 'Provider operates infrastructure', 'Institution maintains servers, patches, backups'],
                ['Updates', 'Continuous, managed by provider', 'Periodic upgrade projects'],
                ['Scalability', 'Scales with seasonal peaks', 'Limited by purchased hardware'],
                ['Control', 'Configuration within the product', 'Full control, including customisation'],
                ['Security responsibility', 'Shared with provider', 'Entirely the institution’s'],
                ['Connectivity dependence', 'Requires reliable internet', 'Works on campus network'],
            ]),
            checks('On-premise can still make sense when', [
                'Regulation or policy requires data to stay on institutional premises',
                'Internet connectivity is unreliable',
                'You have a strong, well-resourced infrastructure team',
            ]),
            checks('Cloud usually wins when', [
                'IT capacity is limited or focused on other priorities',
                'You need to scale for admission and results peaks',
                'You want current features without upgrade projects',
                'Staff and students need access from anywhere',
            ]),
            faq([
                'Is cloud less secure than on-premise?' => 'Not inherently. Security depends on how well each environment is run. Cloud providers can invest in security at a scale few institutions can match, but responsibilities must be clearly shared.',
                'What about data residency rules?' => 'Ask where data is stored and processed, and confirm it meets your legal and policy requirements before signing.',
            ]),
        ],
        'related' => ['/resources/cloud-education-guide/', '/core/cloud-platform/', '/resources/education-cloud-checklist/', '/glossary/education-cloud/'],
    ],

    '/comparisons/manual-vs-automated-admissions/' => [
        'title' => 'Manual vs Automated Admissions Processes',
        'desc'  => 'Compare manual and automated admissions on speed, consistency, applicant experience, workload and insight, and learn what should always stay human.',
        'h1'    => 'Manual vs automated admissions',
        'nav_label' => 'Manual vs Automated Admissions',
        'lead'  => 'Automation can transform admissions operations, but not every step should be automated. This comparison shows where automation helps and where people must stay in charge.',
        'blocks' => [
            takeaways(
                'Automation brings speed, consistency and live reporting to admissions',
                'Automate acknowledgements, reminders, status updates and data transfer',
                'Keep selection, exceptions and sensitive conversations human',
            ),
            table('Side by side', ['Aspect', 'Manual', 'Automated'], [
                ['Enquiry response', 'Depends on staff availability', 'Instant acknowledgement, assigned follow-up'],
                ['Consistency', 'Varies by person and workload', 'Same rules applied every time'],
                ['Document chasing', 'Lists and individual emails', 'Automatic reminders from live checklists'],
                ['Applicant visibility', 'Status by phone or email', 'Self-service status in a portal'],
                ['Reporting', 'Compiled by hand', 'Live funnel and conversion data'],
                ['Peak-season capacity', 'Limited by headcount', 'Scales with volume'],
            ]),
            checks('Automate', [
                'Acknowledgements and routing',
                'Reminders for missing items and deadlines',
                'Status updates to applicants',
                'Data transfer from application to student record',
            ]),
            checks('Keep human', [
                'Selection decisions and exceptions',
                'Conversations with hesitant or anxious applicants',
                'Judgement on unusual qualifications',
                'Appeals and complaints',
            ]),
            sec('Starting the shift',
                'Most admissions offices do not jump from manual to fully automated. The usual path is to automate acknowledgements and reminders first, then application status updates, then data transfer to enrolment. Each step frees time that counsellors can spend on the conversations automation cannot handle.'),
            faq([
                'Will automation make admissions feel impersonal?' => 'Not if it handles the routine messages and frees counsellors for real conversations. Personalised templates and quick human follow-up keep the experience personal.',
                'What should we measure after automating?' => 'Time to first response, application completion rates and counsellor time spent on follow-up, compared with a baseline taken before the change.',
            ]),
        ],
        'related' => ['/platform/admissions-crm/', '/resources/admissions-workflow/', '/ai/ai-for-admissions/', '/solutions/for-admissions-teams/'],
    ],

    '/comparisons/spreadsheets-vs-academic-platform/' => [
        'title' => 'Spreadsheets vs an Academic Platform',
        'desc'  => 'Spreadsheets vs an academic platform or CRM: compare data integrity, collaboration, security, automation and reporting, and know when it is time to move.',
        'h1'    => 'Spreadsheets vs an academic platform',
        'nav_label' => 'Spreadsheets vs Platform',
        'lead'  => 'Spreadsheets are flexible and familiar, and they run a surprising amount of academic administration. Here is when they are fine and when they become a risk.',
        'blocks' => [
            takeaways(
                'Spreadsheets suit small, short-lived tasks with a single owner',
                'Shared student data in spreadsheets risks errors, conflicts and exposure',
                'Document spreadsheet rules before migrating; they become platform validations',
            ),
            table('Side by side', ['Aspect', 'Spreadsheets', 'Academic platform'], [
                ['Setup', 'Immediate', 'Requires configuration'],
                ['Data integrity', 'Easy to overwrite, duplicate or break formulas', 'Validation, one record per person'],
                ['Collaboration', 'Version conflicts and emailed copies', 'Shared live data with permissions'],
                ['Security', 'Files forwarded and stored anywhere', 'Role-based access and audit trails'],
                ['Automation', 'Manual or fragile macros', 'Built-in workflows and reminders'],
                ['Communication', 'Separate tools, no history', 'Messages logged on records'],
                ['Reporting', 'Rebuilt manually', 'Live, consistent reports'],
            ]),
            checks('Signs it is time to move', [
                'Several versions of “the master sheet” exist',
                'Staff spend hours each week reconciling lists',
                'You cannot say who changed a record or when',
                'Sensitive student data is emailed as attachments',
                'Leadership reports take days to prepare',
            ]),
            sec('Moving without losing what works',
                'Spreadsheets encode real knowledge about how your institution works. Before migrating, document the columns, formulas and informal rules they contain. Those become the fields, validations and workflows in the new platform. See [data management](/platform/data-management/) for the migration approach.'),
            faq([
                'Are spreadsheets ever the right choice?' => 'For small, short-lived tasks with one owner, yes. For shared, ongoing student data, the risks grow quickly.',
                'How long does moving off spreadsheets take?' => 'It depends on data quality. Cleaning and mapping spreadsheet data is usually the longest step.',
            ]),
        ],
        'related' => ['/platform/data-management/', '/solutions/for-colleges/', '/core/edtech-crm/', '/comparisons/point-solutions-vs-platform/'],
    ],

    '/comparisons/point-solutions-vs-platform/' => [
        'title' => 'Point Solutions vs a Unified Platform',
        'desc'  => 'Compare best-of-breed point solutions with a unified academic platform on integration effort, data consistency, user experience, cost and flexibility.',
        'h1'    => 'Point solutions vs a unified platform',
        'nav_label' => 'Point Solutions vs Platform',
        'lead'  => 'Should you buy the best tool for each job or one platform for many jobs? Both approaches can work. The trade-offs are predictable.',
        'blocks' => [
            takeaways(
                'Point solutions offer depth; platforms offer consistency and less integration',
                'Hidden point-solution costs are integration upkeep and duplicate data',
                'A hybrid (platform plus integrated specialist tools) often works best',
            ),
            table('Side by side', ['Aspect', 'Point solutions', 'Unified platform'], [
                ['Depth per function', 'Often deeper in a single area', 'Broad, with strong core functions'],
                ['Integration effort', 'High; each pair of systems needs connecting', 'Low inside the platform; integrate the rest'],
                ['Data consistency', 'Multiple copies to reconcile', 'One shared data model'],
                ['User experience', 'Different interfaces and logins', 'Consistent interface and single sign-on'],
                ['Vendor management', 'Many contracts and renewals', 'Fewer relationships'],
                ['Flexibility', 'Swap individual tools', 'Change within the platform'],
            ]),
            checks('Point solutions suit you when', [
                'One function has unusually specialised needs',
                'You have strong integration capability',
                'Existing tools work well and are well integrated',
            ]),
            checks('A platform suits you when', [
                'Data is duplicated across many tools',
                'Staff juggle several logins and interfaces',
                'Cross-department reporting is painful',
                'Integration maintenance consumes IT capacity',
            ]),
            note('Many institutions choose a hybrid: a unified platform for the student lifecycle, integrated with specialist systems such as an LMS or ERP. See [Integrations](/integrations/).'),
            faq([
                'Is a unified platform less flexible than point solutions?' => 'It can be for specialised needs, which is why many institutions pair a platform with integrated specialist tools.',
                'What is the hidden cost of point solutions?' => 'Integration building and maintenance, duplicate data reconciliation and multiple contracts.',
            ]),
        ],
        'related' => ['/solutions/for-higher-education/', '/resources/digital-transformation-education/', '/core/academic-management/', '/resources/academic-management-checklist/'],
    ],

    '/comparisons/ai-reporting-vs-manual-reporting/' => [
        'title' => 'AI Reporting vs Manual Reporting',
        'desc'  => 'Compare AI-assisted reporting with manual reporting on speed, consistency, depth, accuracy risks and effort, and see how to combine them safely.',
        'h1'    => 'AI reporting vs manual reporting',
        'nav_label' => 'AI vs Manual Reporting',
        'lead'  => 'AI can draft report summaries in seconds. Manual reporting brings context and judgement. The best results combine both.',
        'blocks' => [
            takeaways(
                'AI drafts report summaries in minutes; people add context and judgement',
                'AI risks misreading data, so drafts must cite figures and be reviewed',
                'Combine live data, an AI draft and human approval',
            ),
            table('Side by side', ['Aspect', 'Manual reporting', 'AI-assisted reporting'], [
                ['Time to produce', 'Hours to days', 'Minutes for a draft'],
                ['Consistency', 'Varies by author', 'Consistent structure'],
                ['Context & judgement', 'Strong, from people who know the institution', 'Limited to the data provided'],
                ['Accuracy risks', 'Copy-paste and formula errors', 'Misreading data or overstating conclusions'],
                ['Frequency possible', 'Monthly or quarterly', 'Weekly or on demand'],
            ]),
            steps('A safe combined approach', [
                'Live data' => 'Reports come from a single, consistent data source.',
                'AI draft' => 'AI summarises changes and notable movements, citing figures.',
                'Human review' => 'The report owner checks figures, adds context and removes overstatement.',
                'Publish' => 'The approved summary is shared with the underlying charts.',
            ]),
            note('Acadlytic’s planned [AI Reporting](/ai/ai-reporting/) is designed around this approach: drafts grounded in report data that require approval before sharing.'),
            faq([
                'Can AI reports be wrong?' => 'Yes. AI can misread data or overstate conclusions, which is why drafts cite their figures and require human review before sharing.',
                'Does AI replace analysts?' => 'No. It removes the mechanical drafting so analysts can spend time on interpretation, context and follow-up analysis.',
            ]),
        ],
        'related' => ['/ai/ai-reporting/', '/platform/reports-insights/', '/resources/ai-vs-traditional-management/', '/resources/academic-analytics-guide/'],
    ],
];
