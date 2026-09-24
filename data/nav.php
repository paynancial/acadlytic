<?php
/**
 * Navigation model shared by the desktop mega menu, the mobile drawer, the
 * footer and the login workspace selector. Edit here, never in templates.
 */
declare(strict_types=1);

return [
    'mega' => [
        'platform' => [
            'label' => 'Platform',
            'hub'   => '/platform/',
            'intro' => [
                'title' => 'One connected academic platform',
                'text'  => 'Acadlytic is building admissions, students, academics, finance and communication on one cloud foundation, with AI built into the everyday work.',
                'status' => 'In development',
                'cta'   => ['Explore the platform', '/platform/'],
            ],
            'groups' => [
                ['title' => 'Core modules', 'links' => [
                    ['Admissions & CRM', '/platform/admissions-crm/', 'Capture, nurture and convert enquiries', 'users'],
                    ['Student Management', '/platform/student-management/', 'One record for every student', 'cap'],
                    ['Academic Operations', '/platform/academic-operations/', 'Timetables, attendance and exams', 'calendar'],
                    ['Finance & Fees', '/platform/finance-fees/', 'Fee plans, invoices and reconciliation', 'rupee'],
                    ['Communication Hub', '/platform/communication-hub/', 'Email, SMS and WhatsApp in context', 'message'],
                    ['Analytics & AI', '/platform/reports-insights/', 'Reports, dashboards and insights', 'chart'],
                    ['Document Management', '/platform/electronic-document-sharing/', 'Secure collection and sharing', 'doc'],
                    ['Integrations', '/integrations/', 'Connect SIS, LMS, ERP and more', 'plug'],
                ]],
            ],
            'more' => [
                ['Workflow Automation', '/platform/workflow-automation/'],
                ['Institutional Dashboard', '/platform/institutional-dashboard/'],
                ['Cloud Platform', '/core/cloud-platform/'],
                ['Pricing', '/core/pricing/'],
            ],
            'card' => [
                'kind'  => 'dashboard',
                'title' => 'Explore the platform design',
                'text'  => 'A guided walkthrough of Acadlytic’s planned modules, mapped to your admissions and academic workflows.',
                'cta'   => ['Request a demo', '/company/request-demo/'],
            ],
        ],
        'ai' => [
            'label' => 'AI',
            'hub'   => '/ai/',
            'intro' => [
                'title' => 'Acadlytic AI',
                'text'  => 'Practical AI designed to draft, summarise, flag and recommend inside your workflows, with people approving every consequential decision.',
                'status' => 'In development',
                'cta'   => ['Explore Acadlytic AI', '/ai/'],
            ],
            'groups' => [
                ['title' => 'AI capabilities', 'links' => [
                    ['AI Assistant', '/core/ai-assistant/', 'Ask questions of your institutional data', 'ai'],
                    ['AI for Admissions', '/ai/ai-for-admissions/', 'Prioritise and respond to applicants', 'users'],
                    ['AI for Student Success', '/ai/ai-for-student-success/', 'Spot students who need support earlier', 'flag'],
                    ['AI Recommendations', '/ai/ai-recommendations/', 'Next-best actions for staff', 'compass'],
                    ['AI Reporting', '/ai/ai-reporting/', 'Narrative summaries of your reports', 'chart'],
                    ['AI Workflows', '/ai/ai-workflows/', 'AI steps with human approval', 'workflow'],
                    ['Document Intelligence', '/ai/ai-document-intelligence/', 'Read and classify submitted documents', 'doc'],
                    ['Predictive Analytics', '/ai/ai-predictive-analytics/', 'Forecast enrolment and demand', 'trend'],
                ]],
            ],
            'more' => [
                ['Responsible AI', '/ai/responsible-ai/'],
                ['AI Search', '/ai/ai-search/'],
                ['AI in Education', '/ai/ai-in-education/'],
            ],
            'card' => [
                'kind'  => 'assistant',
                'title' => 'How can I help today?',
                'text'  => 'Show admissions trends · Find students who need attention · Draft a parent update',
                'cta'   => ['Meet the AI Assistant', '/core/ai-assistant/'],
            ],
        ],
        'solutions' => [
            'label' => 'Solutions',
            'hub'   => '/solutions/',
            'intro' => [
                'title' => 'Built for every team on campus',
                'text'  => 'Role-based workspaces designed for the people who run, teach, support and lead institutions.',
                'status' => 'In development',
                'cta'   => ['Browse all solutions', '/solutions/'],
            ],
            'groups' => [
                ['title' => 'By role', 'links' => [
                    ['Leadership', '/solutions/for-leadership/', 'Institution-wide visibility', 'trend'],
                    ['Administrators', '/solutions/for-administrators/', 'Fewer manual processes', 'dashboard'],
                    ['Admissions Teams', '/solutions/for-admissions-teams/', 'Faster, better-tracked follow-up', 'users'],
                    ['Faculty', '/solutions/for-faculty/', 'Less admin, more teaching', 'book'],
                    ['Students', '/solutions/for-students/', 'One place for tasks and updates', 'cap'],
                    ['Parents', '/solutions/for-parents/', 'Timely, relevant communication', 'message'],
                ]],
                ['title' => 'By institution', 'links' => [
                    ['Universities', '/solutions/for-universities/', 'Multi-faculty operations', 'building'],
                    ['Colleges', '/solutions/for-colleges/', 'Lean teams, full visibility', 'building'],
                    ['Multi-Campus Groups', '/industries/multi-campus/', 'Standards across campuses', 'globe'],
                    ['Online Education', '/industries/online-education/', 'Digital-first programmes', 'cloud'],
                ]],
            ],
            'more' => [
                ['IT Teams', '/solutions/for-it-teams/'],
                ['Finance Teams', '/solutions/for-finance-teams/'],
                ['Registrars', '/solutions/for-registrars/'],
                ['All institution types', '/industries/'],
            ],
            'card' => [
                'kind'  => 'demo',
                'title' => 'Not sure where to start?',
                'text'  => 'Tell us about your institution and we will map Acadlytic to your priorities.',
                'cta'   => ['Talk to our team', '/core/contact/'],
            ],
        ],
        'integrations' => [
            'label' => 'Integrations',
            'hub'   => '/integrations/',
            'intro' => [
                'title' => 'Fits into your existing stack',
                'text'  => 'Designed to connect student, learning, finance and identity systems through documented APIs, events and exports.',
                'status' => 'Planned',
                'cta'   => ['View all integrations', '/integrations/'],
            ],
            'groups' => [
                ['title' => 'Connect your systems', 'links' => [
                    ['SIS Integration', '/integrations/sis-integration/', 'Keep student records in sync', 'database'],
                    ['LMS Integration', '/integrations/lms-integration/', 'Courses, enrolments, activity', 'book'],
                    ['ERP Integration', '/integrations/erp-integration/', 'Finance and HR data flows', 'layers'],
                    ['Payment Gateways', '/integrations/payment-integration/', 'Online fee collection', 'rupee'],
                    ['Single Sign-On', '/integrations/sso-integration/', 'SAML and OpenID Connect', 'key'],
                    ['Email', '/integrations/email-integration/', 'Institutional mail providers', 'mail'],
                    ['WhatsApp', '/integrations/whatsapp-integration/', 'Business messaging with consent', 'message'],
                    ['REST API', '/integrations/api/', 'Build your own connections', 'code'],
                ]],
            ],
            'more' => [
                ['Webhooks & Events', '/integrations/webhooks/'],
                ['Data Export', '/integrations/data-export/'],
                ['Calendar', '/integrations/calendar-integration/'],
                ['CRM Integration', '/integrations/crm-integration/'],
            ],
            'card' => [
                'kind'  => 'integration',
                'title' => 'Integration planning',
                'text'  => 'Share your current systems and we will outline the data flows before any commitment.',
                'cta'   => ['Plan an integration', '/company/request-demo/?interest=integrations'],
            ],
        ],
        'resources' => [
            'label' => 'Resources',
            'hub'   => '/resources/',
            'intro' => [
                'title' => 'Learn, compare, decide',
                'text'  => 'Practical guides, checklists and definitions for teams modernising academic operations.',
                'cta'   => ['Visit the resource centre', '/resources/'],
            ],
            'groups' => [
                ['title' => 'Learn', 'links' => [
                    ['Guides', '/resources/guides/', 'In-depth, practical playbooks', 'book'],
                    ['Insights', '/resources/blog/', 'Articles on academic operations', 'doc'],
                    ['AI in Higher Education', '/resources/ai-in-higher-education-guide/', 'Adoption roadmap for leaders', 'ai'],
                    ['Academic CRM Guide', '/resources/academic-crm-guide/', 'What it is and how to choose', 'users'],
                ]],
                ['title' => 'Evaluate', 'links' => [
                    ['Comparisons', '/comparisons/', 'Side-by-side decision guides', 'scale'],
                    ['Evaluation Checklist', '/resources/academic-management-checklist/', 'Questions to ask vendors', 'task'],
                    ['Glossary', '/glossary/', 'EdTech terms explained', 'book'],
                    ['FAQs', '/resources/faqs/', 'Straight answers about Acadlytic', 'support'],
                ]],
            ],
            'more' => [],
            'card' => [
                'kind'  => 'resource',
                'title' => 'Education cloud checklist',
                'text'  => 'Security, privacy and operational questions to settle before moving academic systems to the cloud.',
                'cta'   => ['Read the checklist', '/resources/education-cloud-checklist/'],
            ],
        ],
        'company' => [
            'label' => 'Company',
            'hub'   => '/company/',
            'intro' => [
                'title' => 'Acadlytic, Inc.',
                'text'  => 'We are building AI-powered CRM and cloud software for academic management. Where Education Meets Intelligence.',
                'cta'   => ['About Acadlytic', '/core/about/'],
            ],
            'groups' => [
                ['title' => 'Company', 'links' => [
                    ['About Us', '/core/about/', 'Who we are and how we work', 'building'],
                    ['Vision & Mission', '/company/vision-mission/', 'Why we are building Acadlytic', 'compass'],
                    ['Leadership', '/company/leadership/', 'The people leading Acadlytic', 'users'],
                    ['Team', '/company/team/', 'The people building it', 'users'],
                    ['News', '/company/news/', 'Announcements and updates', 'bell'],
                    ['Careers', '/company/careers/', 'Build intelligent education', 'briefcase'],
                    ['Partners', '/company/partners/', 'Grow with Acadlytic', 'handshake'],
                    ['Contact Us', '/core/contact/', 'Sales, support and general', 'mail'],
                ]],
            ],
            'more' => [
                ['Blog', '/resources/blog/'],
                ['Press & Media', '/company/press/'],
                ['Support', '/company/support/'],
                ['Our Office', '/company/offices/patna/'],
                ['Trust Center', '/trust/'],
            ],
            'card' => [
                'kind'  => 'contact',
                'title' => 'Talk to our team',
                'text'  => 'Product questions, partnerships or support. We route every enquiry to the right people.',
                'cta'   => ['Contact Acadlytic', '/core/contact/'],
            ],
        ],
    ],

    'workspaces' => [
        'institution' => ['Institution / Admin', 'Manage your institution, users, academics, admissions and reports.', 'building'],
        'faculty'     => ['Faculty / Staff', 'Access teaching, academic operations and institutional tools.', 'book'],
        'student'     => ['Student / Parent', 'Access learning, communication, documents and academic information.', 'cap'],
        'partner'     => ['Partner / B2B', 'Access partner services, applications and collaboration.', 'handshake'],
    ],

    // Footer columns (after the brand column). Company links live in the
    // header menu and on /company/; contact and demo in the footer's CTA strip.
    'footer' => [
        'Platform' => [
            ['Overview', '/platform/'],
            ['Academic Management', '/core/academic-management/'],
            ['Admissions & CRM', '/platform/admissions-crm/'],
            ['Student Management', '/platform/student-management/'],
            ['Analytics & AI', '/platform/reports-insights/'],
            ['Integrations', '/integrations/'],
            ['Pricing', '/core/pricing/'],
        ],
        'Solutions' => [
            ['For Institutions', '/industries/'],
            ['For Administrators', '/solutions/for-administrators/'],
            ['For Faculty', '/solutions/for-faculty/'],
            ['For Students', '/solutions/for-students/'],
            ['For Parents', '/solutions/for-parents/'],
            ['AI for Education', '/ai/ai-in-education/'],
        ],
        'Resources' => [
            ['Resources', '/resources/'],
            ['Blog', '/resources/blog/'],
            ['Case Studies', '/company/case-studies/'],
            ['Whitepapers', '/resources/whitepapers/'],
            ['FAQs', '/resources/faqs/'],
            ['Help Center', '/company/support/'],
        ],
        'Trust & Governance' => [
            ['Security Center', '/core/security/'],
            ['Privacy & Data Protection', '/trust/privacy/'],
            ['Terms', '/trust/terms/'],
            ['Accessibility', '/trust/accessibility/'],
            ['Data Protection Officer', '/trust/data-protection-officer/'],
            ['Grievance Redressal Officer', '/trust/grievance-redressal-officer/'],
            ['Sitemap', '/sitemap/'],
        ],
    ],
    'footer_social' => ['linkedin', 'x', 'youtube', 'instagram'],
    'footer_legal' => [
        ['Privacy Policy', '/trust/privacy/'],
        ['Terms', '/trust/terms/'],
        ['Security', '/core/security/'],
        ['Sitemap', '/sitemap/'],
    ],
];
