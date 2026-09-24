<?php
/** EdTech glossary. Each term leads with a def() block used for DefinedTerm schema. */
declare(strict_types=1);

return [
    '/glossary/' => [
        'title' => 'EdTech Glossary: Academic Technology Terms',
        'desc'  => 'Plain-language definitions of academic technology terms: academic CRM, SIS, ERP, education analytics, student lifecycle, SSO, education cloud and more.',
        'h1'    => 'EdTech glossary',
        'nav_label' => 'Glossary',
        'lead'  => 'Clear, jargon-free definitions of the terms used across academic technology, CRM, analytics, cloud and AI.',
        'groups' => [
            ['title' => 'Systems', 'paths' => ['/glossary/academic-crm/', '/glossary/admissions-crm/', '/glossary/student-information-system/', '/glossary/academic-erp/', '/glossary/electronic-document-management/', '/glossary/education-cloud/']],
            ['title' => 'Processes', 'paths' => ['/glossary/admissions-management/', '/glossary/student-lifecycle-management/', '/glossary/academic-operations/', '/glossary/workflow-automation/', '/glossary/student-engagement/', '/glossary/student-success/']],
            ['title' => 'Data & integration', 'paths' => ['/glossary/education-analytics/', '/glossary/learning-analytics/', '/glossary/institutional-analytics/', '/glossary/education-api/', '/glossary/single-sign-on/']],
        ],
    ],

    '/glossary/academic-crm/' => [
        'title' => 'What Is an Academic CRM? Definition',
        'desc'  => 'Academic CRM definition: software that manages an institution’s relationships with prospective students, applicants, students, parents and alumni across the lifecycle.',
        'h1'    => 'What is an academic CRM?',
        'nav_label' => 'Academic CRM',
        'lead'  => 'A concise definition of academic CRM, what it includes and how it differs from other institutional systems.',
        'blocks' => [
            def('An academic CRM (customer relationship management system) is software that records and manages an educational institution’s relationships with prospective students, applicants, enrolled students, parents, alumni and partners, including every interaction, communication and task, across the student lifecycle.'),
            checks('Typical components', [
                'Contact records with a full interaction timeline',
                'Enquiry capture and source tracking',
                'Communication tools and automated sequences',
                'Tasks and assignment for staff',
                'Pipeline and funnel reporting',
                'Consent and preference management',
            ]),
            sec('How it differs from an SIS',
                'A student information system holds the official academic record: enrolments, grades and credentials. An academic CRM manages engagement and relationships. Many institutions use both, integrated, or a platform that provides both on one data model. See [Academic CRM vs SIS](/comparisons/academic-crm-vs-sis/).'),
            faq([
                'Is an academic CRM the same as a student CRM?' => 'The terms are often used interchangeably. Both manage relationships with students and prospective students; “academic CRM” usually implies the full lifecycle.',
                'Who uses an academic CRM?' => 'Admissions, marketing, student services, advisors and, in some institutions, alumni relations.',
            ]),
        ],
        'related' => ['/resources/academic-crm-guide/', '/core/edtech-crm/', '/glossary/admissions-crm/', '/comparisons/academic-crm-vs-sis/'],
    ],

    '/glossary/admissions-crm/' => [
        'title' => 'What Is an Admissions CRM? Definition',
        'desc'  => 'Admissions CRM definition: software that helps admissions teams capture enquiries, follow up, track applications and measure conversion to enrolment.',
        'h1'    => 'What is an admissions CRM?',
        'nav_label' => 'Admissions CRM',
        'lead'  => 'The admissions-focused subset of academic CRM, explained.',
        'blocks' => [
            def('An admissions CRM is software that helps admissions and recruitment teams capture enquiries from every channel, respond and follow up consistently, track applications through to a decision and measure which recruitment activities lead to enrolment.'),
            sec('Where it sits',
                'An admissions CRM covers the part of the lifecycle before enrolment. Once a student enrols, their record typically passes to student management systems. In a broader academic CRM, the same record continues through the whole lifecycle.'),
            checks('Core features', [
                'Omnichannel enquiry capture with deduplication',
                'Assignment rules and follow-up tasks',
                'Automated nurture sequences',
                'Application and document tracking',
                'Conversion reporting by source and programme',
            ]),
            faq([
                'Is an admissions CRM only for large universities?' => 'No. Any institution that receives enquiries from several channels can benefit from one queue, assigned follow-up and conversion reporting.',
                'What is the difference between an admissions CRM and admissions management?' => 'Admissions management is the process; an admissions CRM is software that supports it.',
            ]),
        ],
        'related' => ['/platform/admissions-crm/', '/resources/admissions-crm-guide/', '/glossary/admissions-management/', '/glossary/academic-crm/'],
    ],

    '/glossary/student-information-system/' => [
        'title' => 'What Is a Student Information System (SIS)?',
        'desc'  => 'Student information system definition: the system of record for student data such as enrolment, courses, grades, attendance and credentials at an institution.',
        'h1'    => 'What is a student information system (SIS)?',
        'nav_label' => 'Student Information System',
        'lead'  => 'The system of record for student data, defined, with its typical functions.',
        'blocks' => [
            def('A student information system (SIS) is the software an institution uses as its official system of record for student data, including personal details, programme enrolment, course registration, attendance, grades, progression and awarded credentials.'),
            table('Typical SIS functions', ['Function', 'Description'], [
                ['Records', 'Personal and programme information for every student'],
                ['Registration', 'Course and section enrolment each term'],
                ['Grades', 'Assessment results and grade point calculations'],
                ['Transcripts', 'Official academic history and certificates'],
                ['Reporting', 'Data for regulators and accreditation'],
            ]),
            sec('SIS and other systems',
                'The SIS is usually integrated with a learning management system for teaching, a CRM for recruitment and engagement, and finance systems for fees. See [SIS integration](/integrations/sis-integration/).'),
            faq([
                'Is an SIS the same as an LMS?' => 'No. An SIS holds official records such as enrolment and grades; an LMS delivers course content and online learning activities.',
                'Who owns the SIS in an institution?' => 'Usually the registrar’s office, with IT responsible for operating the system.',
            ]),
        ],
        'related' => ['/platform/student-management/', '/integrations/sis-integration/', '/comparisons/academic-crm-vs-sis/', '/resources/student-management-guide/'],
    ],

    '/glossary/academic-erp/' => [
        'title' => 'What Is an Academic ERP? Definition',
        'desc'  => 'Academic ERP definition: enterprise resource planning adapted for institutions, covering finance, HR, procurement and often student administration in one suite.',
        'h1'    => 'What is an academic ERP?',
        'nav_label' => 'Academic ERP',
        'lead'  => 'How enterprise resource planning concepts apply to educational institutions.',
        'blocks' => [
            def('An academic ERP (enterprise resource planning system) is an integrated suite that manages an institution’s core administrative resources, typically finance, human resources, payroll and procurement, and in some products also student administration such as admissions, fees and examinations.'),
            sec('ERP vs CRM in education',
                'ERP systems focus on internal resources and transactions. CRM systems focus on relationships and engagement with people outside and inside the institution. Some vendors bundle both; others specialise. The right mix depends on your existing systems and priorities. See [Academic CRM vs ERP](/comparisons/academic-crm-vs-erp/).'),
            checks('Common academic ERP modules', [
                'General ledger and accounts',
                'Payroll and HR',
                'Procurement and inventory',
                'Fee management',
                'Examinations (in some suites)',
            ]),
            faq([
                'Does an academic ERP include a CRM?' => 'Some suites include CRM features, but ERP systems generally focus on internal resources such as finance and HR rather than relationship management.',
                'Is academic ERP the same as school ERP?' => 'The concepts are similar. “School ERP” usually refers to K-12 administration suites; “academic ERP” is broader.',
            ]),
        ],
        'related' => ['/comparisons/academic-crm-vs-erp/', '/integrations/erp-integration/', '/glossary/academic-crm/'],
    ],

    '/glossary/student-lifecycle-management/' => [
        'title' => 'What Is Student Lifecycle Management?',
        'desc'  => 'Student lifecycle management definition: coordinating every stage of a learner’s journey from enquiry and admission through study and completion to alumni.',
        'h1'    => 'What is student lifecycle management?',
        'nav_label' => 'Student Lifecycle Management',
        'lead'  => 'The idea of managing the student journey as one continuous lifecycle, defined.',
        'blocks' => [
            def('Student lifecycle management is the practice of coordinating an institution’s processes, data and communication across every stage of a learner’s journey, from first enquiry and admission through enrolment, study and completion to alumni, so that transitions between stages and departments are managed deliberately.'),
            table('Common stages', ['Stage', 'Focus'], [
                ['Prospect', 'Awareness and enquiry'],
                ['Applicant', 'Application, documents, decision'],
                ['Enrolled', 'Onboarding and registration'],
                ['Progressing', 'Learning, assessment, support'],
                ['Completing', 'Requirements, clearances, graduation'],
                ['Alumni', 'Continuing relationship'],
            ]),
            faq([
                'Is student lifecycle management a software category?' => 'It is primarily a practice. Software supports it by tracking stages, hand-offs and communication on one record.',
                'Where does the student lifecycle end?' => 'Many institutions extend it to alumni, since graduates return for further study, mentoring and events.',
            ]),
        ],
        'related' => ['/platform/student-lifecycle/', '/resources/student-lifecycle-guide/', '/glossary/student-success/'],
    ],

    '/glossary/education-analytics/' => [
        'title' => 'What Is Education Analytics? Definition',
        'desc'  => 'Education analytics definition: collecting and analysing data about students, programmes and operations to inform decisions, from descriptive reports to predictions.',
        'h1'    => 'What is education analytics?',
        'nav_label' => 'Education Analytics',
        'lead'  => 'The broad field of using data to inform decisions in education, and how it relates to learning and institutional analytics.',
        'blocks' => [
            def('Education analytics is the collection, analysis and reporting of data about learners, programmes and institutional operations to understand what is happening, why, what is likely to happen next and what action to take.'),
            table('Related terms', ['Term', 'Focus'], [
                ['[Learning analytics](/glossary/learning-analytics/)', 'Learner behaviour and outcomes within courses'],
                ['[Institutional analytics](/glossary/institutional-analytics/)', 'Operations, finance and strategy at institution level'],
                ['Enrolment analytics', 'The recruitment funnel and intake forecasting'],
            ]),
            faq([
                'What data does education analytics use?' => 'Admissions, student records, attendance, assessment, learning activity, finance and communication data.',
                'Is education analytics the same as learning analytics?' => 'No. Learning analytics is a subset focused on learners within courses; education analytics also covers operations and strategy.',
            ]),
        ],
        'related' => ['/resources/academic-analytics-guide/', '/platform/reports-insights/', '/glossary/learning-analytics/', '/glossary/institutional-analytics/'],
    ],

    '/glossary/learning-analytics/' => [
        'title' => 'What Is Learning Analytics? Definition',
        'desc'  => 'Learning analytics definition: measuring and analysing data about learners and their contexts to understand and improve learning and learning environments.',
        'h1'    => 'What is learning analytics?',
        'nav_label' => 'Learning Analytics',
        'lead'  => 'The learning-focused branch of education analytics, defined.',
        'blocks' => [
            def('Learning analytics is the measurement, collection, analysis and reporting of data about learners and their contexts, such as course activity, submissions and assessment results, for the purpose of understanding and improving learning and the environments in which it occurs.'),
            sec('Typical data sources',
                'Learning analytics mostly draws on learning management systems (log-ins, content views, forum participation, submissions), assessment results and attendance. Combined with institutional data, it can inform early support for students. See [LMS integration](/integrations/lms-integration/).'),
            checks('Good practice', [
                'Be transparent with students about what is measured',
                'Use insights to support learning, not to surveil',
                'Combine several signals rather than relying on one',
                'Involve faculty in interpreting results',
            ]),
            faq([
                'Where does learning analytics data come from?' => 'Mostly from learning management systems, assessments and attendance records.',
                'Is learning analytics a form of surveillance?' => 'It should not be. Good practice is transparency with students and using insights to support learning.',
            ]),
        ],
        'related' => ['/glossary/education-analytics/', '/integrations/lms-integration/', '/platform/student-engagement/'],
    ],

    '/glossary/institutional-analytics/' => [
        'title' => 'What Is Institutional Analytics? Definition',
        'desc'  => 'Institutional analytics definition: using operational, financial and student data to inform strategy, planning and performance management at institution level.',
        'h1'    => 'What is institutional analytics?',
        'nav_label' => 'Institutional Analytics',
        'lead'  => 'Analytics for institution-level decisions, defined.',
        'blocks' => [
            def('Institutional analytics is the use of operational, financial, admissions and student-outcome data to inform an institution’s strategy, planning, resource allocation and performance management.'),
            checks('Typical questions', [
                'Which programmes are growing or declining in demand?',
                'How do retention and completion vary by programme?',
                'Is our fee collection on track?',
                'Where should we invest recruitment effort?',
                'How efficiently are we using rooms and staff time?',
            ]),
            sec('Institutional vs learning analytics',
                'Institutional analytics looks at the organisation as a whole: demand, capacity, finances and outcomes. [Learning analytics](/glossary/learning-analytics/) looks inside courses at how students learn. Both draw on overlapping data but answer different questions for different audiences.'),
            faq([
                'Who uses institutional analytics?' => 'Leadership teams, planning offices, finance and heads of department making institution-level decisions.',
                'How is institutional analytics presented?' => 'Usually through dashboards and periodic reports with agreed indicators, comparisons and owners.',
            ]),
        ],
        'related' => ['/platform/institutional-dashboard/', '/resources/institutional-dashboard-guide/', '/glossary/education-analytics/'],
    ],

    '/glossary/academic-operations/' => [
        'title' => 'What Are Academic Operations? Definition',
        'desc'  => 'Academic operations definition: the day-to-day processes that run teaching and assessment, including calendars, timetables, attendance, exams and results.',
        'h1'    => 'What are academic operations?',
        'nav_label' => 'Academic Operations',
        'lead'  => 'The operational side of teaching and assessment, defined.',
        'blocks' => [
            def('Academic operations are the day-to-day administrative processes that make teaching and assessment happen: planning the academic calendar, scheduling courses and rooms, assigning faculty, recording attendance, running examinations and processing and publishing results.'),
            sec('Why it matters',
                'Well-run academic operations are invisible: classes happen where and when expected, exams run smoothly and results arrive on time. Poorly run operations create clashes, delays and errors that affect students directly. See [Academic Operations](/platform/academic-operations/).'),
            checks('Typical responsibilities', [
                'Academic calendar and term dates',
                'Course scheduling and room allocation',
                'Attendance policies and records',
                'Examination scheduling and conduct',
                'Results processing and publication',
            ]),
            faq([
                'Who is responsible for academic operations?' => 'Typically a mix of the registrar’s office, examination office, academic departments and timetabling staff.',
                'How is academic operations different from academic management?' => 'Academic operations covers day-to-day teaching and assessment administration; academic management is broader and includes admissions, records and finance.',
            ]),
        ],
        'related' => ['/platform/academic-operations/', '/solutions/for-faculty/', '/glossary/workflow-automation/'],
    ],

    '/glossary/admissions-management/' => [
        'title' => 'What Is Admissions Management? Definition',
        'desc'  => 'Admissions management definition: the end-to-end process of recruiting, assessing and admitting students, from enquiry through application, decision and enrolment.',
        'h1'    => 'What is admissions management?',
        'nav_label' => 'Admissions Management',
        'lead'  => 'The admissions process as a whole, defined, as distinct from the software that supports it.',
        'blocks' => [
            def('Admissions management is the end-to-end process by which an institution recruits prospective students, receives and assesses applications, makes and communicates decisions, and converts accepted applicants into enrolled students.'),
            steps('Main stages', [
                'Recruitment' => 'Generating and responding to enquiries.',
                'Application' => 'Collecting applications and documents.',
                'Assessment' => 'Reviewing against published criteria.',
                'Decision' => 'Offers, conditions and communication.',
                'Conversion' => 'Acceptance, deposit and enrolment.',
            ]),
            note('Software that supports this process is often called an [admissions CRM](/glossary/admissions-crm/).'),
            faq([
                'What does an admissions office manage?' => 'Recruitment, applications, document collection, assessment, decisions, offers and conversion to enrolment.',
                'Can admissions management be automated?' => 'Routine steps such as acknowledgements and reminders can be; selection decisions should stay with people.',
            ]),
        ],
        'related' => ['/glossary/admissions-crm/', '/resources/admissions-workflow/', '/platform/application-management/'],
    ],

    '/glossary/student-success/' => [
        'title' => 'What Is Student Success? Definition',
        'desc'  => 'Student success definition: students achieving their educational goals, and the institutional practices, support and data used to help them get there.',
        'h1'    => 'What is student success?',
        'nav_label' => 'Student Success',
        'lead'  => 'A widely used but often loosely defined term, made precise.',
        'blocks' => [
            def('Student success refers to students achieving their educational goals, commonly measured through persistence, progression, completion and post-study outcomes, and to the coordinated institutional practices, support services and data used to help them achieve those goals.'),
            table('Common measures', ['Measure', 'Meaning'], [
                ['Persistence', 'Continuing enrolment from one term or year to the next'],
                ['Progression', 'Meeting academic requirements to advance'],
                ['Completion', 'Finishing the programme'],
                ['Outcomes', 'Employment or further study after completion'],
            ]),
            sec('How institutions support it',
                'Student success work combines academic advising, early-warning systems, tutoring, wellbeing services and financial guidance, coordinated so that students get the right help at the right time. See [AI for Student Success](/ai/ai-for-student-success/).'),
            faq([
                'How is student success measured?' => 'Commonly through persistence, progression, completion and outcomes after study.',
                'Is student success only about grades?' => 'No. It also covers progression, completion, wellbeing and reaching the goals students set for themselves.',
            ]),
        ],
        'related' => ['/ai/ai-for-student-success/', '/platform/completion-tracking/', '/glossary/student-engagement/'],
    ],

    '/glossary/student-engagement/' => [
        'title' => 'What Is Student Engagement? Definition',
        'desc'  => 'Student engagement definition: the degree of involvement students show in their learning and institutional life, and how institutions observe and support it.',
        'h1'    => 'What is student engagement?',
        'nav_label' => 'Student Engagement',
        'lead'  => 'Student engagement, defined, with the dimensions researchers and institutions commonly use.',
        'blocks' => [
            def('Student engagement is the degree of attention, participation and investment students bring to their learning and to the wider life of their institution, and the institutional conditions that encourage it.'),
            cards('Common dimensions', [
                'Behavioural' => 'Attendance, participation and completing work.',
                'Cognitive' => 'Effort and strategies invested in learning.',
                'Emotional' => 'Sense of belonging and interest.',
            ]),
            sec('Observing engagement',
                'Institutions can observe behavioural engagement through attendance, submissions and platform activity. Cognitive and emotional engagement need surveys and conversations. See [student engagement strategies](/resources/student-engagement-strategies/).'),
            faq([
                'Can student engagement be measured?' => 'Behavioural engagement can be observed through attendance and activity; emotional and cognitive engagement need surveys and conversations.',
                'Why does student engagement matter?' => 'Engaged students are more likely to persist, progress and complete their studies.',
            ]),
        ],
        'related' => ['/platform/student-engagement/', '/resources/student-engagement-strategies/', '/glossary/student-success/'],
    ],

    '/glossary/workflow-automation/' => [
        'title' => 'What Is Workflow Automation in Education?',
        'desc'  => 'Workflow automation definition: using software to run repeatable institutional processes (triggers, rules, tasks, approvals and notifications) with minimal manual effort.',
        'h1'    => 'What is workflow automation?',
        'nav_label' => 'Workflow Automation',
        'lead'  => 'Workflow automation, also called academic automation in education, defined.',
        'blocks' => [
            def('Workflow automation is the use of software to carry out the repeatable steps of a process, such as checks, notifications, task assignment, approvals and record updates, according to defined triggers and rules, with people involved at the points where judgement is required.'),
            table('Building blocks', ['Element', 'Example'], [
                ['Trigger', 'An application is submitted'],
                ['Condition', 'Programme requires a portfolio'],
                ['Action', 'Create a review task for the department'],
                ['Approval', 'Department head approves shortlisting'],
                ['Notification', 'Applicant is informed of next steps'],
            ]),
            faq([
                'Is workflow automation the same as AI?' => 'No. Workflow automation follows defined rules; AI can be added to handle unstructured inputs such as free-text requests.',
                'What is academic automation?' => 'Workflow automation applied to academic and administrative processes in education.',
            ]),
        ],
        'related' => ['/platform/workflow-automation/', '/resources/education-automation-guide/', '/ai/ai-workflows/'],
    ],

    '/glossary/education-cloud/' => [
        'title' => 'What Is an Education Cloud? Definition',
        'desc'  => 'Education cloud definition: cloud-hosted software and infrastructure that institutions use to run academic and administrative systems as a managed service.',
        'h1'    => 'What is an education cloud?',
        'nav_label' => 'Education Cloud',
        'lead'  => 'A plain explanation of what “education cloud” means.',
        'blocks' => [
            def('An education cloud is a set of academic and administrative applications delivered from cloud infrastructure as a managed service, so institutions access them over the internet rather than installing and operating the software and servers themselves.'),
            checks('Characteristics', [
                'Access from browsers and mobile devices',
                'Provider-managed updates, backups and infrastructure',
                'Capacity that scales with seasonal demand',
                'Subscription rather than upfront licence and hardware costs',
            ]),
            sec('Cloud and responsibility',
                'Moving to an education cloud shifts infrastructure work to the provider, but the institution still decides who has access, how data is used and how the service is configured. See [cloud vs on-premise](/comparisons/cloud-vs-on-premise-education/).'),
            faq([
                'Is an education cloud secure?' => 'Security depends on the provider’s controls and the institution’s own configuration and access management.',
                'What is the opposite of an education cloud?' => 'On-premise software, which the institution installs and operates on its own servers.',
            ]),
        ],
        'related' => ['/core/cloud-platform/', '/resources/cloud-education-guide/', '/comparisons/cloud-vs-on-premise-education/'],
    ],

    '/glossary/education-api/' => [
        'title' => 'What Is an Education API? Definition',
        'desc'  => 'Education API definition: an application programming interface that lets education systems exchange data securely, such as student, course or payment information.',
        'h1'    => 'What is an education API?',
        'nav_label' => 'Education API',
        'lead'  => 'APIs in the education context, explained without the jargon.',
        'blocks' => [
            def('An education API (application programming interface) is a documented, secure way for one education system to request or send data to another, such as student records, course enrolments, results or payments, without manual exports or re-entry.'),
            sec('Why APIs matter',
                'Institutions run many systems. APIs let them share data automatically and consistently, which reduces errors and duplicate work. Good APIs use scoped credentials, versioning and logging. See the [Acadlytic API](/integrations/api/).'),
            faq([
                'Do institutions need developers to use an API?' => 'Usually yes, or an integration partner, although many common integrations are available as configured connectors.',
                'What is the difference between an API and a webhook?' => 'An API is called to request or send data; a webhook notifies another system automatically when an event happens.',
            ]),
        ],
        'related' => ['/integrations/api/', '/integrations/webhooks/', '/solutions/for-it-teams/'],
    ],

    '/glossary/single-sign-on/' => [
        'title' => 'What Is Single Sign-On (SSO)? Definition',
        'desc'  => 'Single sign-on definition: an authentication method that lets users access multiple systems with one set of institutional credentials, managed centrally.',
        'h1'    => 'What is single sign-on (SSO)?',
        'nav_label' => 'Single Sign-On',
        'lead'  => 'Single sign-on, defined, with why institutions use it.',
        'blocks' => [
            def('Single sign-on (SSO) is an authentication method that lets a user sign in once with their institutional identity and then access multiple connected applications without separate passwords, with authentication handled centrally by an identity provider.'),
            checks('Benefits for institutions', [
                'Fewer passwords and reset requests',
                'Central enforcement of password and multi-factor policies',
                'Immediate removal of access when someone leaves',
                'Consistent sign-in experience for staff and students',
            ]),
            note('Common SSO standards include SAML 2.0 and OpenID Connect. See [SSO integration](/integrations/sso-integration/).'),
            faq([
                'Is SSO more secure than separate passwords?' => 'Generally yes, because authentication and multi-factor policies are managed centrally and access can be removed in one place.',
                'What is an identity provider?' => 'The system that authenticates users for SSO, such as an institution’s directory or cloud identity service.',
            ]),
        ],
        'related' => ['/integrations/sso-integration/', '/core/security/'],
    ],

    '/glossary/electronic-document-management/' => [
        'title' => 'What Is Electronic Document Management?',
        'desc'  => 'Electronic document management definition: capturing, storing, organising, securing and sharing documents digitally with version control and access rules.',
        'h1'    => 'What is electronic document management?',
        'nav_label' => 'Electronic Document Management',
        'lead'  => 'Electronic document management in an education context, defined.',
        'blocks' => [
            def('Electronic document management is the digital capture, storage, organisation, security and sharing of documents, with metadata, version history, access controls and retention rules, replacing paper files and uncontrolled shared folders.'),
            table('In education, typical documents include', ['Document', 'Used in'], [
                ['Mark sheets and certificates', 'Admissions verification'],
                ['Identity documents', 'Enrolment and compliance'],
                ['Transcripts', 'Further study and employment'],
                ['Policies and forms', 'Administration and student services'],
            ]),
            sec('Why it matters for institutions',
                'Academic documents are high-value and often sensitive. Managing them electronically, with verification status, access controls and audit trails, reduces lost paperwork, speeds up verification and makes it easier to issue official documents securely.'),
            faq([
                'What is the difference between document management and file storage?' => 'Document management adds metadata, verification status, permissions, version history and retention rules to stored files.',
                'Can electronic documents replace paper certificates?' => 'Many institutions issue electronic certificates and transcripts; formal requirements depend on the institution and the receiving body.',
            ]),
        ],
        'related' => ['/platform/electronic-document-sharing/', '/ai/ai-document-intelligence/'],
    ],
];
