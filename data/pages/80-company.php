<?php
/** Company pages, demo request and trust & governance pages. */
declare(strict_types=1);

$legalDraft = 'Draft pending legal review. This text describes our current practices in plain language and will be replaced by the reviewed version before it is relied on as a formal policy.';

return [
    '/company/' => [
        'title' => 'Company',
        'desc'  => 'About Acadlytic, Inc.: our mission, careers, partner programme, press resources, support and how to contact the team.',
        'h1'    => 'Acadlytic, Inc.',
        'nav_label' => 'Company',
        'lead'  => 'We build AI-powered CRM and cloud software for academic management. Where Education Meets Intelligence.',
        'groups' => [
            ['title' => 'About us', 'paths' => ['/core/about/', '/company/careers/', '/company/press/']],
            ['title' => 'Work with us', 'paths' => ['/company/partners/', '/company/request-demo/', '/core/contact/', '/company/support/']],
            ['title' => 'Trust', 'paths' => ['/trust/', '/core/security/', '/trust/privacy/']],
        ],
    ],

    '/company/request-demo/' => [
        'title'    => 'Request a Demo',
        'desc'     => 'Request a personalised Acadlytic demo. Tell us about your institution and priorities and we will show the workflows that matter to you.',
        'h1'       => 'See Acadlytic in action',
        'nav_label' => 'Request a Demo',
        'lead'     => 'Tell us about your institution and priorities. We will prepare a focused walkthrough of the workflows that matter to you, not a generic slideshow.',
        'template' => 'form',
        'form'     => 'demo',
        'form_title' => 'Request your demo',
        'submit'   => 'Request a Demo',
        'success_title' => 'Thank you. Your request is in.',
        'success_text'  => 'Our team will review your details and contact you to schedule a demo tailored to your institution.',
        'aside_title'   => 'What to expect',
        'aside_points'  => [
            'A short discovery call to understand your priorities and systems.',
            'A tailored demo of the modules you care about.',
            'Honest answers on integrations, data migration and timelines.',
            'A written proposal if Acadlytic is a good fit.',
        ],
        'priority' => 0.9,
        'blocks' => [
            faq([
                'How long is a demo?' => 'Usually 45–60 minutes, including time for your questions. We can run shorter sessions focused on a single module.',
                'Who should attend?' => 'Whoever owns the processes you want to improve, for example admissions, registry, finance or IT, plus a decision-maker if possible.',
                'Can we see our own processes?' => 'Yes. Tell us your priority workflows in the form and we will prepare examples around them.',
                'Is there any obligation?' => 'None. A demo is a conversation to see whether Acadlytic fits your needs.',
            ]),
        ],
    ],

    '/company/careers/' => [
        'title' => 'Careers at Acadlytic',
        'desc'  => 'Build the future of intelligent education with Acadlytic. Learn how we work, the skills we value and how to express interest in joining the team.',
        'h1'    => 'Build the future of intelligent education',
        'nav_label' => 'Careers',
        'lead'  => 'We are building software that helps institutions serve students better. If that matters to you, we would like to hear from you.',
        'icon'  => 'briefcase',
        'blocks' => [
            cards('How we work', [
                'Education first' => 'We judge our work by whether it helps institutions serve students and staff better.',
                'Honest by default' => 'We describe our product accurately and admit what we do not know.',
                'Craft & care' => 'We sweat the details of usability, accessibility and reliability.',
                'Responsible AI' => 'We build AI that people can understand, question and control.',
            ]),
            checks('Skills we value', [
                'Product engineering (PHP, web, APIs, data)',
                'Product design with an eye for accessibility',
                'Data engineering and applied machine learning',
                'Implementation and customer success in education',
                'Sales and partnerships with institutions',
                'Security and cloud operations',
            ]),
            sec('Open roles',
                'Current openings are announced on our official LinkedIn page and other social channels, linked at the foot of every page. If you do not see a role that fits, send a short introduction and your CV to info@acadlytic.com with the subject “Careers”. We read every message.'),
            faq([
                'Does Acadlytic hire remotely?' => 'Working arrangements are described in each role announcement.',
                'How do I apply if no role fits?' => 'Email a short introduction and CV to info@acadlytic.com with the subject “Careers”.',
            ]),
        ],
        'related' => ['/core/about/', '/company/partners/', '/ai/responsible-ai/'],
    ],

    '/company/partners/' => [
        'title' => 'Partner with Acadlytic',
        'desc'  => 'Partner with Acadlytic as an implementation, technology, referral or education partner. Learn about partnership types and how to start a conversation.',
        'h1'    => 'Partner with Acadlytic',
        'nav_label' => 'Partners',
        'lead'  => 'We work with organisations that help institutions succeed: implementers, technology providers, consultants and education networks.',
        'icon'  => 'handshake',
        'blocks' => [
            cards('Partnership types', [
                'Implementation partners' => 'Consultancies that configure, migrate and train institutions on Acadlytic.',
                'Technology partners' => 'Providers of complementary systems (LMS, payments, messaging, identity) integrating with our platform.',
                'Referral partners' => 'Advisors and networks that introduce institutions to Acadlytic.',
                'Education partners' => 'Counselling organisations and agents working with students and institutions.',
            ]),
            steps('How partnerships start', [
                'Introduce yourself' => 'Tell us about your organisation, customers and the partnership you have in mind.',
                'Explore fit' => 'We discuss shared customers, capabilities and responsibilities.',
                'Agree terms' => 'Scope, data responsibilities and commercial terms are agreed in writing.',
                'Enable' => 'Training, documentation and sandbox access for technical partners.',
            ]),
            note('We do not list partner organisations on this site until partnerships are formally agreed and both parties approve the listing. To start a conversation, [contact us](/core/contact/?topic=partnership).'),
            faq([
                'Do partners get access to institutional data?' => 'Only where an institution authorises it for a specific purpose, under a written agreement that defines scope and responsibilities.',
                'Can technology partners test against the platform?' => 'Approved technology partners receive sandbox access and API documentation to build and test integrations.',
            ]),
        ],
        'related' => ['/integrations/api/', '/core/contact/', '/company/request-demo/'],
    ],

    '/company/press/' => [
        'title' => 'Press & Media',
        'desc'  => 'Press and media information for Acadlytic, Inc.: approved company description, brand guidance, official social profiles and media contact.',
        'h1'    => 'Press and media',
        'nav_label' => 'Press & Media',
        'lead'  => 'Approved company information, brand guidance and contacts for journalists, analysts and event organisers.',
        'icon'  => 'doc',
        'blocks' => [
            sec('Company boilerplate',
                'Acadlytic, Inc. provides an AI-powered EdTech CRM and cloud platform for academic management. The platform connects admissions, student records, academic operations, finance, communication, documents and analytics for educational institutions, with AI features designed for human oversight. Tagline: Where Education Meets Intelligence.'),
            table('Official channels', ['Channel', 'Address'], [
                ['Website', 'acadlytic.com'],
                ['LinkedIn', 'linkedin.com/company/acadlytic'],
                ['X', 'x.com/acadlytic'],
                ['YouTube', 'youtube.com/@acadlytic'],
                ['Instagram', 'instagram.com/acadlytic'],
                ['Facebook', 'facebook.com/acadlytic'],
            ]),
            checks('Brand guidance', [
                'Write the company name as “Acadlytic, Inc.” on first reference and “Acadlytic” thereafter',
                'Use the official logo without altering colours, proportions or the tagline',
                'Do not attribute customer counts, rankings or certifications to Acadlytic unless confirmed by us in writing',
            ]),
            sec('Media contact',
                'For interviews, logo files and fact-checking, email info@acadlytic.com with the subject “Press” or call +91 8010707171.'),
            faq([
                'Can I use the Acadlytic logo in an article?' => 'Yes, for editorial coverage of Acadlytic, using the official logo files we provide on request, unaltered.',
                'Can you confirm customer names or figures?' => 'We only confirm customer names, figures or outcomes that have been verified and approved for publication by the institutions involved.',
            ]),
        ],
        'related' => ['/core/about/', '/core/contact/', '/company/careers/'],
    ],

    '/company/support/' => [
        'title' => 'Customer Support & Help Center',
        'desc'  => 'Get help with Acadlytic: support channels, what to include in a request, account access help and how support requests are prioritised.',
        'h1'    => 'Support and help center',
        'nav_label' => 'Support',
        'lead'  => 'Help for institutions using Acadlytic, and for students, parents and staff who need assistance with their accounts.',
        'icon'  => 'support',
        'blocks' => [
            cards('How to get help', [
                'Institution staff' => 'Contact your institution’s Acadlytic administrator first. Administrators can raise requests with our support team directly.',
                'Students & parents' => 'For questions about your records, fees or results, contact your institution. For sign-in problems, use the options below.',
                'Account access' => 'Use [Forgot password](/forgot-password.php) or email the support address with the subject “Account access”.',
                'Everyone else' => 'For product or sales questions, use the [contact page](/core/contact/).',
            ]),
            checks('Include in your support request', [
                'Your name, institution and role',
                'What you were trying to do and what happened',
                'The page or screen and approximate time',
                'Screenshots, with any personal data of others removed',
                'How many people are affected',
            ]),
            table('How requests are prioritised', ['Priority', 'Examples'], [
                ['Urgent', 'Platform unavailable, security concern, payment processing failure'],
                ['High', 'A key process blocked for a team, such as marks entry during results week'],
                ['Normal', 'A single user issue or a configuration question'],
                ['Low', 'Feature requests and suggestions'],
            ]),
            faq([
                'Where do I sign in?' => 'Use the [Login](/login.php) page and choose your workspace.',
                'I did not receive a reset email.' => 'Check spam folders, confirm you used the email registered with your institution, then contact support.',
                'How do I report a security issue?' => 'See the [Security Center](/core/security/) for responsible disclosure.',
            ], 'Quick answers'),
        ],
        'related' => ['/resources/faqs/', '/core/contact/', '/trust/grievance-redressal/'],
    ],

    '/company/case-studies/' => [
        'title' => 'Case Studies',
        'desc'  => 'Acadlytic case studies will be published once outcomes are verified with the institutions involved.',
        'h1'    => 'Case studies',
        'lead'  => 'We publish case studies only when results are verified and approved by the institutions involved. The first ones are in preparation.',
        'noindex' => true,
        'hide_cta' => true,
        'blocks' => [
            note('This page is a placeholder and is excluded from search engines. Case studies will include the institution’s context, what changed, how it was measured and who verified the results.', 'In preparation'),
        ],
        'related' => ['/company/request-demo/', '/resources/guides/', '/core/about/'],
    ],

    '/trust/' => [
        'title' => 'Trust Center: Security, Privacy & Governance',
        'desc'  => 'Acadlytic Trust Center: security, privacy and data protection, the Data Protection Officer, grievance redressal, accessibility and terms of use.',
        'h1'    => 'Trust Center',
        'nav_label' => 'Trust Center',
        'lead'  => 'How Acadlytic protects data, respects privacy, handles grievances and makes its services accessible, with the people to contact for each.',
        'groups' => [
            ['title' => 'Security & privacy', 'paths' => ['/core/security/', '/trust/privacy/', '/ai/responsible-ai/']],
            ['title' => 'Governance officers', 'paths' => ['/trust/data-protection-officer/', '/trust/grievance-redressal-officer/']],
            ['title' => 'Policies & processes', 'paths' => ['/trust/grievance-redressal/', '/trust/accessibility/', '/trust/terms/']],
        ],
        'blocks' => [
            table('Governance contacts', ['Role', 'Officer', 'How to reach'], [
                ['[Data Protection Officer](/trust/data-protection-officer/)', 'Mr. A.K Sinha', '[dpo@acadlytic.com](mailto:dpo@acadlytic.com)'],
                ['[Grievance Redressal Officer](/trust/grievance-redressal-officer/)', 'Mrs. Anjali Sharma', '[gro@acadlytic.com](mailto:gro@acadlytic.com)'],
                ['Security reports', 'Security team', 'info@acadlytic.com, subject “Security report”'],
                ['Accessibility feedback', 'Accessibility team', 'info@acadlytic.com, subject “Accessibility”'],
            ]),
        ],
    ],

    '/trust/data-protection-officer/' => [
        'title' => 'Data Protection Officer (DPO)',
        'desc'  => 'Contact Acadlytic’s Data Protection Officer, Mr. A.K Sinha, at dpo@acadlytic.com for personal data requests, consent withdrawal and privacy questions.',
        'h1'    => 'Data Protection Officer',
        'nav_label' => 'Data Protection Officer',
        'lead'  => 'Acadlytic, Inc. has designated **Mr. A.K Sinha** as its Data Protection Officer. Contact him at [dpo@acadlytic.com](mailto:dpo@acadlytic.com) about how your personal data is handled.',
        'icon'  => 'lock',
        'hide_cta' => true,
        'blocks' => [
            table('Contact details', ['Role', 'Name', 'Email'], [
                ['Data Protection Officer', 'Mr. A.K Sinha', '[dpo@acadlytic.com](mailto:dpo@acadlytic.com)'],
            ], 'Please write from an email address we can reply to, and use a subject line that describes your request.'),
            cards('What the Data Protection Officer handles', [
                'Your data rights' => 'Requests to access, correct or erase personal data Acadlytic holds about you, and to withdraw consent.',
                'Privacy questions' => 'Questions about what we collect through acadlytic.com, why, and how long we keep it.',
                'Consent and communication' => 'Stopping marketing messages or changing how we may contact you.',
                'Institutional data' => 'Coordinating with the relevant institution when your request concerns data an institution holds in the Acadlytic platform.',
            ]),
            checks('Include in your request', [
                'Your full name and the email or phone number we may know you by',
                'Whether you are a website visitor, applicant, student, parent, staff member or partner',
                'The institution involved, if your request relates to an institution’s use of Acadlytic',
                'What you would like us to do, as specifically as possible',
            ], 'We may ask you to verify your identity before acting on a request, to protect your information from being disclosed to someone else.'),
            note('If your request concerns records held by your school, college or university (for example, results or fees), that institution decides how the data is used. Contact the institution as well; the DPO will support it in responding.', 'Institution data'),
            faq([
                'Who is Acadlytic’s Data Protection Officer?' => 'Mr. A.K Sinha, reachable at [dpo@acadlytic.com](mailto:dpo@acadlytic.com).',
                'Is the DPO the right contact for a complaint?' => 'For a complaint about our service or how a request was handled, contact our [Grievance Redressal Officer](/trust/grievance-redressal-officer/). The DPO handles data rights and privacy questions.',
                'Can I contact the DPO about data my college holds?' => 'Yes. The DPO will coordinate with the institution, which decides how its student data is used.',
            ]),
        ],
        'related' => ['/trust/privacy/', '/trust/grievance-redressal-officer/', '/core/security/', '/trust/'],
    ],

    '/trust/grievance-redressal-officer/' => [
        'title' => 'Grievance Redressal Officer',
        'desc'  => 'Contact Acadlytic’s Grievance Redressal Officer, Mrs. Anjali Sharma, at gro@acadlytic.com to raise a complaint about our services or data handling.',
        'h1'    => 'Grievance Redressal Officer',
        'nav_label' => 'Grievance Redressal Officer',
        'lead'  => 'Acadlytic, Inc. has designated **Mrs. Anjali Sharma** as its Grievance Redressal Officer. Contact her at [gro@acadlytic.com](mailto:gro@acadlytic.com) if you are unhappy with our service or how your data was handled.',
        'icon'  => 'scale',
        'hide_cta' => true,
        'blocks' => [
            table('Contact details', ['Role', 'Name', 'Email'], [
                ['Grievance Redressal Officer', 'Mrs. Anjali Sharma', '[gro@acadlytic.com](mailto:gro@acadlytic.com)'],
            ], 'You can also use the [contact form](/core/contact/?topic=grievance) and choose “Grievance redressal”; it reaches the same officer.'),
            cards('Grievances the officer handles', [
                'Service complaints' => 'Problems with the Acadlytic website, support or services that have not been resolved through normal channels.',
                'Data handling' => 'Complaints about how your personal data was collected, used or shared, or how a data request was handled.',
                'Accessibility' => 'Barriers that prevented you from using our website or services.',
                'Conduct' => 'Concerns about how Acadlytic staff or partners dealt with you.',
            ]),
            sec('What happens next',
                'Your grievance is acknowledged with a reference, reviewed with the teams involved and answered with our findings and any action taken. The full sequence, and how to escalate if you are not satisfied, is set out in our [grievance redressal process](/trust/grievance-redressal/).'),
            faq([
                'Who is Acadlytic’s Grievance Redressal Officer?' => 'Mrs. Anjali Sharma, reachable at [gro@acadlytic.com](mailto:gro@acadlytic.com).',
                'Should I contact the Grievance Redressal Officer or the DPO?' => 'Use the Grievance Redressal Officer for complaints. For requests to access, correct or erase your personal data, contact the [Data Protection Officer](/trust/data-protection-officer/).',
                'Can the officer change an institution’s decision?' => 'No. Admission outcomes, results and fees are decided by the institution. Raise those with the institution; we will support it where our platform is involved.',
            ]),
        ],
        'related' => ['/trust/grievance-redressal/', '/trust/data-protection-officer/', '/company/support/', '/trust/'],
    ],

    '/trust/privacy/' => [
        'title' => 'Privacy & Data Protection',
        'desc'  => 'How Acadlytic handles personal data on this website and platform: what we collect, why, how long we keep it, your rights and how to reach our Data Protection Officer.',
        'h1'    => 'Privacy and data protection',
        'nav_label' => 'Privacy & Data Protection',
        'lead'  => 'This page explains how Acadlytic, Inc. handles personal data collected through acadlytic.com, and how data is handled in the Acadlytic platform on behalf of institutions.',
        'draft' => $legalDraft,
        'hide_cta' => true,
        'blocks' => [
            sec('Who we are',
                'Acadlytic, Inc. (“Acadlytic”, “we”) operates acadlytic.com and provides the Acadlytic platform to educational institutions. You can contact us at info@acadlytic.com or +91 8010707171.'),
            table('What this website collects', ['Data', 'When', 'Why'], [
                ['Name, email, phone, institution, role, message', 'When you submit a demo, contact or access request', 'To respond to your request'],
                ['Account email', 'When you request a password reset', 'To verify and help with account access'],
                ['A session cookie', 'Only on pages with forms or sign-in', 'Security (CSRF protection) and keeping you signed in'],
                ['Hashed network identifiers', 'When forms are submitted', 'To prevent spam and abuse; raw IP addresses are not stored with enquiries'],
                ['Standard server logs', 'When pages are requested', 'Security and troubleshooting, kept for a limited period'],
            ], 'This website does not use advertising trackers or third-party analytics scripts.'),
            sec('Data in the Acadlytic platform',
                'When an institution uses the Acadlytic platform, the institution decides what personal data about its applicants, students, parents and staff is processed, and Acadlytic processes it on the institution’s behalf under a written agreement. Questions about a specific institution’s use of your data should go to that institution first; we will assist them in responding.'),
            cards('Our principles', [
                'Purpose limitation' => 'We use personal data only for the purposes it was collected for.',
                'Minimisation' => 'We collect only what we need.',
                'Security' => 'We protect data with technical and organisational measures. See the [Security Center](/core/security/).',
                'Retention' => 'We keep data only as long as necessary and then delete or anonymise it.',
                'No sale of data' => 'We do not sell personal data.',
                'AI' => 'Institutional data is not used to train public AI models.',
            ]),
            checks('Your rights', [
                'Access the personal data we hold about you',
                'Correct inaccurate or incomplete data',
                'Request erasure of data we no longer need',
                'Withdraw consent where processing is based on consent',
                'Nominate another person to exercise your rights where applicable law allows',
                'Raise a grievance and, if unresolved, escalate to the relevant authority',
            ], 'Rights vary by applicable law, including India’s Digital Personal Data Protection Act, 2023 where it applies.'),
            sec('Data Protection Officer',
                'Our Data Protection Officer is **Mr. A.K Sinha**. To exercise your rights or ask about our data practices, email [dpo@acadlytic.com](mailto:dpo@acadlytic.com). See the [Data Protection Officer page](/trust/data-protection-officer/) for what to include. For complaints, contact our [Grievance Redressal Officer](/trust/grievance-redressal-officer/).'),
            faq([
                'Does acadlytic.com use tracking cookies?' => 'No. The site sets a session cookie only on pages with forms or sign-in, for security.',
                'How do I ask what data Acadlytic holds about me?' => 'Email our Data Protection Officer at [dpo@acadlytic.com](mailto:dpo@acadlytic.com) and describe the information you are asking about.',
            ]),
        ],
        'related' => ['/trust/grievance-redressal/', '/core/security/', '/ai/responsible-ai/', '/trust/terms/'],
    ],

    '/trust/terms/' => [
        'title' => 'Website Terms of Use',
        'desc'  => 'Terms of use for acadlytic.com: acceptable use, intellectual property, accuracy of information, links, limitation of liability and how to contact us.',
        'h1'    => 'Website terms of use',
        'nav_label' => 'Terms',
        'lead'  => 'These terms govern your use of acadlytic.com. Use of the Acadlytic platform by institutions is governed by separate agreements.',
        'draft' => $legalDraft,
        'hide_cta' => true,
        'blocks' => [
            sec('Using this website',
                'You may browse and use this website for lawful purposes, including learning about Acadlytic and contacting us. You must not attempt to disrupt the website, access areas you are not authorised to access, submit false information or use automated tools to overload our forms.'),
            sec('Information on this website',
                'We aim to keep information accurate and current. Product descriptions explain capabilities in general terms; the specific scope of any service is defined in a written agreement with your institution. Nothing on this website is a binding offer.'),
            sec('Intellectual property',
                'The Acadlytic name, logo, website design and content belong to Acadlytic, Inc. or its licensors. You may share links to our pages and quote short extracts with attribution. Please see [Press & Media](/company/press/) for brand guidance.'),
            sec('Links to other websites',
                'Our pages link to third-party sites, including our official social media profiles. We are not responsible for the content or practices of those sites.'),
            sec('Liability',
                'To the extent permitted by law, Acadlytic is not liable for losses arising from reliance on general information on this website. Nothing in these terms limits liability that cannot be limited by law.'),
            sec('Contact',
                'Questions about these terms can be sent to info@acadlytic.com. Complaints are handled under our [grievance redressal process](/trust/grievance-redressal/).'),
            faq([
                'Do these terms cover the Acadlytic platform?' => 'No. They cover this website. Platform use is governed by each institution’s written agreement.',
                'Can I quote content from this website?' => 'Yes, short extracts with attribution and a link to the original page.',
            ]),
        ],
        'related' => ['/trust/privacy/', '/trust/accessibility/', '/trust/'],
    ],

    '/trust/accessibility/' => [
        'title' => 'Accessibility Statement',
        'desc'  => 'Acadlytic’s accessibility statement: our WCAG 2.2 AA target, measures taken on this website and platform, known limitations and how to request help.',
        'h1'    => 'Accessibility statement',
        'nav_label' => 'Accessibility',
        'lead'  => 'Education should be accessible to everyone. We design acadlytic.com and the Acadlytic platform to be usable by people with a wide range of abilities, devices and connections.',
        'hide_cta' => true,
        'blocks' => [
            sec('Our target',
                'We aim to meet the Web Content Accessibility Guidelines (WCAG) 2.2 at level AA. We have not yet completed an independent accessibility audit; when we do, we will publish the results and date here.'),
            checks('Measures on this website', [
                'Semantic headings and landmarks, with one main heading per page',
                'Keyboard access to all navigation, menus and forms, with visible focus',
                'A skip link to the main content',
                'Text and interface colours chosen for sufficient contrast',
                'Form fields with labels, error messages linked to fields and an error summary',
                'Reduced motion respected when set in your device preferences',
                'Pages that reflow on small screens without horizontal scrolling',
            ]),
            sec('Known limitations',
                'Some decorative dashboard previews on this website are illustrations and are hidden from assistive technology; their meaning is described in the surrounding text. If you find content that is difficult to use, please tell us.'),
            sec('Feedback and assistance',
                'Email info@acadlytic.com with the subject “Accessibility”, call +91 8010707171 or use the [contact form](/core/contact/?topic=accessibility). Tell us the page, what you were trying to do and any assistive technology you use. We will respond and, where we cannot fix an issue quickly, provide the information another way.'),
            faq([
                'Which accessibility standard does Acadlytic follow?' => 'We aim for WCAG 2.2 level AA.',
                'Can I get information in another format?' => 'Yes. Contact us with your needs and we will provide the information in an accessible alternative.',
            ]),
        ],
        'related' => ['/trust/', '/solutions/for-students/', '/core/contact/'],
    ],

    '/trust/grievance-redressal/' => [
        'title' => 'Grievance Redressal',
        'desc'  => 'How to raise a grievance with Acadlytic, how it is acknowledged, investigated and resolved, and how to escalate if you are not satisfied.',
        'h1'    => 'Grievance redressal',
        'lead'  => 'If you are unhappy with our service or with how your personal data has been handled, tell us. This page explains how your grievance will be handled.',
        'draft' => 'Process description pending legal review. Response timelines will be published here once confirmed; we follow the timelines required by applicable law in the meantime.',
        'nav_label' => 'Grievance Redressal Process',
        'hide_cta' => true,
        'blocks' => [
            sec('Grievance Redressal Officer',
                'Grievances are handled by our Grievance Redressal Officer, **Mrs. Anjali Sharma**. Send your grievance to [gro@acadlytic.com](mailto:gro@acadlytic.com), or use the [contact form](/core/contact/?topic=grievance) and choose “Grievance redressal”. Details are on the [Grievance Redressal Officer page](/trust/grievance-redressal-officer/).'),
            checks('Please include', [
                'Your name and contact details',
                'Your institution, if the grievance relates to an institution’s use of Acadlytic',
                'A clear description of the issue and when it happened',
                'Any reference numbers, screenshots or correspondence',
                'What outcome you are seeking',
            ]),
            steps('How we handle a grievance', [
                'Acknowledge' => 'We confirm receipt and give you a reference.',
                'Review' => 'The Grievance Redressal Officer reviews the issue, involving the relevant team.',
                'Respond' => 'We explain our findings and any action taken.',
                'Escalate' => 'If you are not satisfied, you may ask for a senior review, and you retain any right to approach the relevant authority under applicable law.',
            ]),
            note('Grievances about an institution’s decisions, such as admissions outcomes, results or fees, should be raised with that institution. Acadlytic will support institutions in responding where our platform is involved.'),
            faq([
                'How do I raise a grievance?' => 'Email [gro@acadlytic.com](mailto:gro@acadlytic.com), or choose “Grievance redressal” on the contact form.',
                'Should grievances about admission decisions come to Acadlytic?' => 'No. Decisions made by an institution should be raised with that institution first.',
            ]),
        ],
        'related' => ['/trust/privacy/', '/core/contact/', '/company/support/'],
    ],
];
