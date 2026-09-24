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

    // ---------- SEO Phase 2, batch 1 ----------
    '/comparisons/sis-vs-lms/' => [
        'title' => 'SIS vs LMS: What’s the Difference?',
        'desc'  => 'SIS vs LMS explained: what a student information system and a learning management system each do, the data they own, who uses them and how they should connect.',
        'h1'    => 'SIS vs LMS: what is the difference?',
        'nav_label' => 'SIS vs LMS',
        'lead'  => 'A student information system (SIS) holds the official record of who is enrolled and what they achieved. A learning management system (LMS) is where teaching and coursework happen. Most institutions need both, connected.',
        'blocks' => [
            takeaways(
                'The SIS is the system of record for enrolment, grades and credentials',
                'The LMS delivers course content, assignments, quizzes and online discussion',
                'Enrolments flow from SIS to LMS; final grades flow back from LMS to SIS',
                'Problems usually come from unclear ownership of grades and rosters, not from either system alone',
            ),
            sec('The short answer',
                'An SIS answers “who is this student officially, what are they enrolled in and what have they earned?” An LMS answers “what does this class need to learn this week, and how is each student doing on the coursework?” The SIS is administrative and authoritative; the LMS is instructional and day-to-day.'),
            table('SIS and LMS side by side', ['Aspect', 'Student information system (SIS)', 'Learning management system (LMS)'], [
                ['Core purpose', 'Official student record and academic administration', 'Teaching, learning content and coursework'],
                ['Main users', 'Registrar, examinations, academic administration', 'Faculty and students'],
                ['Typical data', 'Personal details, programmes, enrolments, timetables, final grades, transcripts', 'Course materials, assignments, submissions, quiz scores, discussion posts'],
                ['Grades', 'Final, approved grades that appear on transcripts', 'Working marks and feedback during the term'],
                ['Change control', 'Formal: corrections are approved and audited', 'Flexible: faculty manage their own course spaces'],
                ['Lifespan of data', 'Kept long-term as the institutional record', 'Often archived after each term'],
            ]),
            sec('How the two systems should connect',
                'The cleanest pattern is a one-way flow of structure and a controlled flow of results. The SIS creates courses, sections and enrolments and sends them to the LMS so class lists are always correct. At the end of term, faculty release final grades from the LMS and the SIS records them through its own approval step.',
                'Integration standards help here: LTI (Learning Tools Interoperability) is widely used to connect tools to an LMS, and many SIS and LMS products offer roster and grade exchange. Whatever the mechanism, decide which system is authoritative for each field before connecting them.'),
            checks('Signs the connection needs attention', [
                'Faculty regularly find students missing from, or wrongly listed in, their LMS courses',
                'Final grades are re-typed from the LMS into the SIS',
                'Nobody can say which system holds the “real” grade for a disputed assessment',
                'Late enrolments take days to appear in the LMS',
            ]),
            sec('Where an academic CRM or platform fits',
                'Neither an SIS nor an LMS is designed to manage enquiries, applicants or ongoing engagement; that is the job of an academic CRM (see [Academic CRM vs SIS](/comparisons/academic-crm-vs-sis/)). Acadlytic is being built as a platform for the administrative side, and plans to [integrate with an LMS](/integrations/lms-integration/) rather than replace it.'),
            faq([
                'Can an LMS replace an SIS?' => 'Usually not. An LMS is not designed to be the official record for admissions, enrolment status, fees or transcripts, and it typically lacks the approval and audit controls a registrar needs.',
                'Which should an institution implement first?' => 'Most institutions need an SIS (or equivalent records system) first, because the LMS depends on accurate courses and enrolments. Institutions already teaching online may have adopted an LMS first and should connect it once the SIS is in place.',
                'Is Moodle an SIS or an LMS?' => 'Moodle is a widely used LMS. It manages courses and coursework; it is not intended to be an institution’s system of record for enrolment and transcripts.',
            ]),
        ],
        'related' => ['/glossary/student-information-system/', '/glossary/learning-management-system/', '/integrations/lms-integration/', '/comparisons/academic-crm-vs-sis/'],
    ],

    '/comparisons/erp-vs-sis/' => [
        'title' => 'ERP vs SIS in Education: Which Does Your Institution Need?',
        'desc'  => 'ERP vs SIS for education institutions: how an enterprise resource planning system differs from a student information system, where they overlap and how to decide.',
        'h1'    => 'ERP vs SIS in education',
        'nav_label' => 'ERP vs SIS',
        'lead'  => 'An ERP runs the institution as an organisation (finance, HR, procurement). An SIS runs the academic record of its students. The terms are often mixed up because “academic ERP” products bundle both.',
        'blocks' => [
            takeaways(
                'An ERP manages organisational resources: money, people, assets and purchasing',
                'An SIS manages students: enrolment, academic progress, grades and credentials',
                '“Academic ERP” usually means an SIS bundled with finance and HR modules',
                'Student fees sit on the boundary; decide early which system owns them',
            ),
            table('ERP and SIS side by side', ['Aspect', 'ERP', 'Student information system'], [
                ['Focus', 'The institution as an organisation', 'Students and their academic journey'],
                ['Typical modules', 'General ledger, payroll, HR, procurement, assets', 'Admissions records, enrolment, timetables, grades, transcripts'],
                ['Main users', 'Finance, HR, procurement, leadership', 'Registrar, examinations, academic departments'],
                ['Key record', 'Financial transactions and employee records', 'Student academic record'],
                ['Regulatory drivers', 'Accounting and tax obligations', 'Academic regulations and accreditation'],
            ]),
            sec('Why the terms get confused',
                'In some markets, vendors sell an “academic ERP” or “college ERP”: one product that includes student records, fees, HR and accounting. That can suit a smaller institution that wants a single vendor. Larger institutions often keep a dedicated finance ERP and a separate SIS because each is deeper in its own domain.'),
            sec('The fee question',
                'Student fees are the most common source of friction. The student-facing side (fee plans, invoices, receipts, reminders) is closely tied to enrolment, while the accounting side (ledger postings, reconciliation, reporting) belongs in finance. A practical split is to manage student billing next to student records and post summarised entries to the finance ERP. See [ERP integration](/integrations/erp-integration/) for the planned pattern.'),
            checks('Questions to settle before choosing', [
                'Does your finance team already have an ERP it wants to keep?',
                'Which system will be the source of truth for student fees and payments?',
                'How will staff who teach (HR) be linked to the sections they teach (SIS)?',
                'Can you export all data from each system in open formats?',
            ]),
            faq([
                'Is an SIS part of an ERP?' => 'Sometimes. Suites marketed as academic or college ERP include SIS functions. In other institutions the SIS and ERP are separate products connected by integration.',
                'Do we need both an ERP and an SIS?' => 'You need both capabilities. Whether they come from one suite or two products depends on your size, existing investments and how deep each area needs to be.',
            ]),
        ],
        'related' => ['/glossary/academic-erp/', '/glossary/student-information-system/', '/integrations/erp-integration/', '/comparisons/academic-crm-vs-erp/'],
    ],

    '/comparisons/crm-vs-lms/' => [
        'title' => 'CRM vs LMS for Education: Different Jobs, Different Users',
        'desc'  => 'CRM vs LMS in education: how a CRM that manages enquiries and engagement differs from a learning management system for teaching, and how the two can work together.',
        'h1'    => 'CRM vs LMS for education',
        'nav_label' => 'CRM vs LMS',
        'lead'  => 'A CRM manages relationships, starting with the enquiry and continuing through study and beyond. An LMS manages learning inside a course. They rarely compete; confusion usually arises when one is stretched to do the other’s job.',
        'blocks' => [
            takeaways(
                'CRM: enquiries, applicants, communication, follow-up and engagement',
                'LMS: course content, assignments, assessments and class discussion',
                'The CRM is used most before enrolment; the LMS is used most after it',
                'Engagement signals from the LMS can inform student-support outreach managed from the CRM',
            ),
            table('CRM and LMS side by side', ['Aspect', 'Education CRM', 'LMS'], [
                ['Who it is for', 'Admissions, marketing, student services, advisors', 'Faculty and students'],
                ['When it is used most', 'From first enquiry to enrolment, then for support and alumni', 'During each course or term'],
                ['Core records', 'People, interactions, communications, tasks, pipeline stages', 'Courses, modules, activities, submissions, marks'],
                ['Success measure', 'Response time, conversion, engagement, retention', 'Learning progress and course completion'],
                ['Typical automation', 'Follow-up sequences, assignment rules, reminders', 'Release conditions, due-date reminders, auto-graded quizzes'],
            ]),
            sec('How they work together',
                'Once a student enrols, the LMS knows things the CRM does not: whether they log in, submit work and keep up. Shared carefully, a few of those signals (for example, no course activity for two weeks) can prompt a human check-in from student services. The reverse flow matters too: the CRM holds communication preferences and consent, which should govern how students are contacted.'),
            note('Share only the signals staff need to offer support, and follow your institution’s privacy policy on how learning data may be used.', 'Data use'),
            sec('Can one replace the other?',
                'An LMS is not built to manage enquiries, applications or campaigns, and a CRM is not built to deliver courses. Trying to stretch either usually produces workarounds. Acadlytic is building CRM and academic management capabilities and plans to [connect to an LMS](/integrations/lms-integration/) rather than become one.'),
            faq([
                'Does a school need a CRM if it already has an LMS?' => 'If admissions enquiries, applications or student-support cases are managed in email and spreadsheets, yes: the LMS does not cover that work.',
                'Which data should flow from the LMS to the CRM?' => 'Keep it minimal and purposeful: for example, course activity summaries used to trigger support outreach, not detailed submissions or marks.',
            ]),
        ],
        'related' => ['/glossary/academic-crm/', '/glossary/learning-management-system/', '/core/edtech-crm/', '/comparisons/sis-vs-lms/'],
    ],

    '/comparisons/general-crm-vs-education-crm/' => [
        'title' => 'Education CRM vs General-Purpose CRM for Institutions',
        'desc'  => 'Should a college use a general-purpose sales CRM or an education-specific CRM? A factual comparison of data models, workflows, consent, integration and total effort.',
        'h1'    => 'Education CRM vs general-purpose CRM',
        'nav_label' => 'Education CRM vs general CRM',
        'lead'  => 'General-purpose CRMs are built around companies, deals and sales pipelines. Education CRMs are built around people, applications, programmes and terms. Either can work; the difference is how much you must build and maintain yourself.',
        'blocks' => [
            takeaways(
                'General-purpose CRMs are flexible and mature, but model sales, not admissions',
                'Education CRMs start with programmes, intakes, applications and guardians built in',
                'Customising a general CRM for education is a project, and it needs ongoing ownership',
                'Evaluate on your real journey: enquiry → application → offer → enrolment',
            ),
            table('How the two approaches differ', ['Aspect', 'General-purpose CRM', 'Education-specific CRM'], [
                ['Core objects', 'Accounts, contacts, leads, opportunities, deals', 'Prospects, applicants, programmes, intakes, applications, guardians'],
                ['Pipeline', 'Sales stages ending in a closed deal', 'Admissions stages ending in enrolment, then continued engagement'],
                ['Timing', 'Continuous sales cycles', 'Academic calendar: intakes, deadlines, terms'],
                ['People model', 'Buyer inside a company', 'Student, often with parents or guardians involved'],
                ['Out of the box', 'Broad ecosystem and generic features', 'Education workflows, though ecosystem size varies by product'],
                ['Effort to fit education', 'Significant configuration and custom fields, maintained over time', 'Lower, but check it matches your processes'],
            ]),
            checks('A general-purpose CRM can make sense when', [
                'Your institution already runs one well, with in-house administrators',
                'Recruitment works more like B2B sales, for example corporate or executive education',
                'You have budget and skills to design and maintain an education data model',
            ]),
            checks('An education-specific CRM can make sense when', [
                'You want programmes, intakes and applications without building them',
                'Parents or guardians are part of most conversations',
                'You need connections to student records and the academic calendar',
                'Your team is small and cannot maintain heavy customisation',
            ]),
            sec('What to test in a demo',
                'Ask each vendor to run your own scenario: an enquiry from a website form, a duplicate enquiry from an education fair, an application with missing documents, a parent asking about fees and an applicant who defers to the next intake. How much of that works without custom development is the most useful comparison. The [academic CRM guide](/resources/academic-crm-guide/) lists further questions.'),
            faq([
                'Is an education CRM just a general CRM with templates?' => 'Sometimes. Some products are configured versions of a general CRM; others are built for education from the start. Ask how the data model is structured and what happens when the underlying platform upgrades.',
                'Can we move from a general CRM to an education CRM later?' => 'Yes, but plan a data migration. Contacts move easily; histories, stages and custom objects need careful mapping.',
            ]),
        ],
        'related' => ['/resources/academic-crm-guide/', '/core/edtech-crm/', '/integrations/crm-integration/', '/glossary/admissions-crm/'],
    ],

    '/comparisons/build-vs-buy-education-software/' => [
        'title' => 'Build vs Buy Student Management Software: How to Decide',
        'desc'  => 'Should an institution build its own student management or CRM software, or buy a product? The costs, risks and conditions that favour each option, without the hype.',
        'h1'    => 'Build vs buy: student management and CRM software',
        'nav_label' => 'Build vs buy',
        'lead'  => 'Building in-house promises a perfect fit; buying promises speed and shared maintenance. The right answer depends less on features than on who will own, secure and maintain the system for the next ten years.',
        'blocks' => [
            takeaways(
                'Building gives control and fit, but you own security, upgrades and staff continuity',
                'Buying gives speed and shared maintenance, but you adapt to the product and depend on the vendor',
                'Most of the lifetime cost of custom software comes after launch',
                'A hybrid (buy the core, build small extensions via APIs) is common',
            ),
            table('Build vs buy at a glance', ['Factor', 'Build in-house', 'Buy a product'], [
                ['Fit to processes', 'Exact, if requirements are clear', 'Close, with some process change'],
                ['Time to first use', 'Longer: design, build, test', 'Shorter: configure, migrate, train'],
                ['Upfront cost', 'Development team and infrastructure', 'Licence or subscription and implementation'],
                ['Ongoing cost', 'Maintenance, security fixes, hosting, staff retention', 'Subscription or support fees'],
                ['Security and compliance work', 'Entirely yours', 'Shared, but you must verify the vendor'],
                ['Key-person risk', 'High if one or two developers built it', 'Lower, but vendor stability matters'],
                ['Data ownership and exit', 'Fully yours', 'Depends on contract and export options'],
            ]),
            checks('Building can be reasonable when', [
                'Your process is genuinely unique and central to how you operate',
                'You have a stable in-house engineering team with security expertise',
                'You can fund maintenance for the full life of the system, not just the first release',
            ]),
            checks('Buying is usually safer when', [
                'Your needs are common to many institutions (admissions, records, fees, communication)',
                'Your IT team is small or stretched',
                'You need to be live before the next admissions cycle',
            ]),
            sec('Questions that settle the decision',
                'Who will fix a security vulnerability at night during results week? What happens if the lead developer leaves? How will the system be tested after every change? If those answers are unclear, buying (or a hybrid) is usually the lower-risk path. Use the [academic management checklist](/resources/academic-management-checklist/) to compare options, and see [point solutions vs a unified platform](/comparisons/point-solutions-vs-platform/) for the related architecture choice.'),
            faq([
                'Is custom software cheaper in the long run?' => 'Not necessarily. Once maintenance, hosting, security, upgrades and staff costs are included over several years, custom software is often more expensive than institutions expect.',
                'Can we buy a product and still customise it?' => 'Many products support configuration and integrations through APIs, which allows extensions without changing the core product.',
            ]),
        ],
        'related' => ['/resources/academic-management-checklist/', '/comparisons/point-solutions-vs-platform/', '/comparisons/cloud-vs-on-premise-education/', '/resources/digital-transformation-education/'],
    ],
];
