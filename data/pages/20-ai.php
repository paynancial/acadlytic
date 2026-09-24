<?php
/** Acadlytic AI hub and capability pages. */
declare(strict_types=1);

return [
    '/ai/' => [
        'title' => 'Acadlytic AI: AI for Academic Management',
        'desc'  => 'Acadlytic AI brings assistants, predictions, recommendations and document intelligence into academic workflows, with human approval and clear explanations.',
        'h1'    => 'Acadlytic AI: intelligence inside the work',
        'nav_label' => 'Acadlytic AI',
        'lead'  => 'AI features that live where your teams already work, grounded in your institution’s data, explainable and always subject to human judgement for consequential decisions.',
        'groups' => [
            ['title' => 'Assist', 'text' => 'Help people find, understand and communicate faster.', 'paths' => [
                '/core/ai-assistant/', '/ai/ai-search/', '/ai/ai-communications/', '/ai/ai-reporting/', '/ai/ai-insights/',
            ]],
            ['title' => 'Anticipate', 'text' => 'Spot patterns early and suggest what to do next.', 'paths' => [
                '/ai/ai-predictive-analytics/', '/ai/ai-for-student-success/', '/ai/ai-recommendations/', '/ai/ai-personalization/',
            ]],
            ['title' => 'Automate', 'text' => 'Take routine steps off people’s plates, with oversight.', 'paths' => [
                '/ai/ai-workflows/', '/ai/ai-document-intelligence/',
            ]],
            ['title' => 'By team & principle', 'text' => 'How AI helps specific teams, and the rules we hold it to.', 'paths' => [
                '/ai/ai-for-admissions/', '/ai/ai-for-advising/', '/ai/ai-in-education/', '/ai/responsible-ai/',
            ]],
        ],
        'blocks' => [
            table('How Acadlytic AI is governed', ['Principle', 'In practice'], [
                ['Grounded', 'Answers and suggestions are based on your institutional data, with sources shown.'],
                ['Permission-aware', 'AI never reveals information a user is not already allowed to see.'],
                ['Human-approved', 'Messages, decisions and record changes proposed by AI require a person to confirm unless your institution chooses otherwise.'],
                ['Explainable', 'Risk flags and recommendations show the factors behind them.'],
                ['Private', 'Institutional data is not used to train public AI models.'],
            ]),
        ],
    ],

    '/ai/ai-for-admissions/' => [
        'title' => 'AI for Admissions',
        'desc'  => 'AI for admissions teams: prioritise follow-ups, draft personalised replies, summarise applicant histories and forecast intake, with counsellors in control.',
        'h1'    => 'AI for admissions teams',
        'nav_label' => 'AI for Admissions',
        'lead'  => 'Help counsellors spend their time on the conversations that matter most, with AI that prioritises, summarises and drafts, and leaves the judgement with people.',
        'icon'  => 'users',
        'blocks' => [
            sec('Where AI helps in admissions',
                'In peak season a counsellor may own hundreds of open enquiries. Deciding who to call first, remembering what each person asked last time and writing a thoughtful reply to each takes more hours than exist. AI can take the preparation work off that list.'),
            table('AI capabilities for admissions', ['Capability', 'What it does', 'Human role'], [
                ['Follow-up prioritisation', 'Ranks today’s follow-ups using engagement, stage, deadlines and time since last contact', 'Counsellor chooses the order and can override'],
                ['Applicant summaries', 'Condenses the timeline (enquiries, calls, messages, documents) into a short brief before a call', 'Counsellor verifies against the record'],
                ['Reply drafting', 'Drafts answers to common questions using approved programme information', 'Counsellor edits and sends'],
                ['Document pre-checks', 'Flags missing or unreadable uploads via [document intelligence](/ai/ai-document-intelligence/)', 'Staff verify documents'],
                ['Intake forecasting', 'Projects enrolment ranges by programme from pipeline and history', 'Leadership plans with ranges, not single numbers'],
            ]),
            checks('What AI does not do in admissions', [
                'Make admission decisions or score applicants for selection',
                'Send messages without approval unless your institution configures it',
                'Use protected characteristics to rank or prioritise people',
            ], 'Selection decisions are high-stakes and regulated. Acadlytic keeps them with people and your published criteria.'),
        ],
        'related' => ['/platform/admissions-crm/', '/solutions/for-admissions-teams/', '/ai/ai-predictive-analytics/', '/comparisons/manual-vs-automated-admissions/', '/ai/responsible-ai/'],
    ],

    '/ai/ai-for-student-success/' => [
        'title' => 'AI for Student Success & At-Risk Alerts',
        'desc'  => 'Identify students who may need support earlier with explainable early-warning signals from attendance, submissions and engagement, then coordinate timely outreach.',
        'h1'    => 'AI for student success: earlier, explainable support',
        'nav_label' => 'AI for Student Success',
        'lead'  => 'Early-warning signals combine attendance, submissions, results and engagement to highlight students who may need support, with the reasons shown so advisors can act with care.',
        'icon'  => 'flag',
        'blocks' => [
            sec('Why earlier matters',
                'By the time a student fails an exam or stops attending, options narrow. Most students who struggle show earlier signs: a drop in attendance, late submissions, fewer portal visits or missed advising appointments. Individually these are easy to miss. Together they form a pattern worth a conversation.'),
            steps('How early-warning works', [
                'Signals' => 'Acadlytic reads the signals your institution chooses to use from academic and engagement data.',
                'Assessment' => 'A model estimates who may benefit from outreach and shows which factors contributed.',
                'Review' => 'Advisors see a prioritised list with explanations and the student’s context.',
                'Outreach' => 'Advisors reach out personally, refer to services or schedule support, and record outcomes.',
                'Learning' => 'Outcomes are used to evaluate and recalibrate the approach each term.',
            ]),
            cards('Safeguards', [
                'Explanations, not labels' => 'Staff see contributing factors, not a permanent “at-risk” tag on a student.',
                'Configurable inputs' => 'Institutions decide which signals are used; sensitive attributes are excluded.',
                'Restricted visibility' => 'Only designated support roles see flags.',
                'Bias checks' => 'Flag rates are reviewed across groups to detect unfair patterns.',
            ]),
            note('Early-warning flags are a prompt for supportive human contact. They must never be used for disciplinary or admission decisions.'),
        ],
        'related' => ['/platform/student-engagement/', '/platform/completion-tracking/', '/solutions/for-advisors/', '/glossary/student-success/', '/ai/responsible-ai/'],
    ],

    '/ai/ai-for-advising/' => [
        'title' => 'AI for Academic Advising',
        'desc'  => 'AI tools for academic advisors: meeting briefs, progress summaries, suggested next steps and follow-up drafting, so advisors spend more time with students.',
        'h1'    => 'AI for academic advising',
        'nav_label' => 'AI for Advising',
        'lead'  => 'Advisors know that the most valuable part of their job is the conversation. Acadlytic AI prepares the context before each meeting and handles the follow-up afterwards.',
        'icon'  => 'compass',
        'blocks' => [
            sec('Before, during and after an advising session',
                'Preparing for a meeting often means opening several screens to piece together a student’s progress, previous notes and open issues. After the meeting, notes, referrals and follow-up emails take as long again. AI shortens both ends.'),
            table('Advisor workflow with AI', ['Moment', 'AI assistance'], [
                ['Before', 'A one-page brief: programme progress, recent attendance and results, open cases, previous advising notes and upcoming deadlines'],
                ['During', 'Quick answers to “what does this student still need to graduate?” from [completion tracking](/platform/completion-tracking/)'],
                ['After', 'Draft meeting summary and follow-up message for the advisor to edit, plus suggested referrals'],
                ['Across caseload', 'Suggested students to contact this week, with reasons'],
            ]),
            checks('Designed with advisors', [
                'Advisors own all notes; AI drafts are clearly marked until accepted',
                'Sensitive notes (for example, wellbeing) have stricter visibility',
                'Suggestions explain why a student appears on the list',
                'Everything is recorded on the student’s timeline for continuity',
            ]),
        ],
        'related' => ['/solutions/for-advisors/', '/ai/ai-for-student-success/', '/ai/ai-recommendations/', '/platform/completion-tracking/'],
    ],

    '/ai/ai-recommendations/' => [
        'title' => 'AI Recommendations for Staff',
        'desc'  => 'Next-best-action recommendations for admissions, advising and administration teams, based on institutional data and explained so staff can decide confidently.',
        'h1'    => 'AI recommendations: the next best action, explained',
        'nav_label' => 'AI Recommendations',
        'lead'  => 'Acadlytic suggests what to do next (who to contact, which task matters most, which template fits) and shows why, so staff can accept, adjust or dismiss in a click.',
        'icon'  => 'compass',
        'blocks' => [
            sec('Recommendations for the people doing the work',
                'This page covers recommendations made to staff. Recommendations made to students, such as programme suggestions or personalised content, are covered under [AI Personalization](/ai/ai-personalization/) and [College Recommendations](/platform/college-recommendations/).'),
            cards('Where recommendations appear', [
                'Counsellor queue' => 'Which applicants to contact first and the likely reason they have gone quiet.',
                'Advisor caseload' => 'Students to check in with this week, with the signals behind each suggestion.',
                'Finance follow-ups' => 'Which overdue accounts might benefit from a payment-plan conversation rather than a reminder.',
                'Communication' => 'The best-matching approved template and channel for a situation.',
                'Operations' => 'Tasks at risk of breaching their due date.',
            ]),
            steps('Every recommendation includes', [
                'The suggestion' => 'A specific, actionable next step.',
                'The reasons' => 'The two or three factors that most influenced it.',
                'Confidence' => 'Whether the evidence is strong or thin.',
                'Your choice' => 'Accept, modify or dismiss; feedback improves future suggestions.',
            ]),
        ],
        'related' => ['/ai/ai-for-advising/', '/ai/ai-for-admissions/', '/platform/task-management/', '/ai/ai-personalization/'],
    ],

    '/ai/ai-personalization/' => [
        'title' => 'AI Personalization for Students',
        'desc'  => 'Personalise communication and portal experiences for applicants and students by programme, stage, language and preferences, with consent and transparency.',
        'h1'    => 'AI personalisation for applicants and students',
        'nav_label' => 'AI Personalization',
        'lead'  => 'Each applicant and student sees information that fits their programme, stage and preferences, instead of a one-size-fits-all newsletter.',
        'icon'  => 'spark',
        'blocks' => [
            sec('Relevance is a form of respect',
                'A postgraduate applicant does not need undergraduate hostel information. A working professional in an evening programme needs different reminders from a full-time first-year. Personalisation means sending less, but more relevant, information.'),
            cards('What can be personalised', [
                'Message content' => 'Programme-specific details, deadlines and next steps inserted automatically.',
                'Timing' => 'Sending at times recipients are more likely to read, within your quiet-hours rules.',
                'Language' => 'Multilingual templates selected by preference.',
                'Portal highlights' => 'The student portal surfaces the tasks and resources most relevant right now.',
                'Programme suggestions' => 'Related programmes or electives based on stated interests, labelled as suggestions.',
            ]),
            checks('Guardrails', [
                'Personalisation uses data people have provided or that is necessary for their studies',
                'Students can see and adjust their stated preferences',
                'Opt-outs and consent are always respected',
                'Personalisation never changes fees, eligibility or decisions',
            ]),
        ],
        'related' => ['/ai/ai-communications/', '/platform/communication-hub/', '/platform/college-recommendations/', '/resources/student-engagement-strategies/'],
    ],

    '/ai/ai-insights/' => [
        'title' => 'AI Insights & Anomaly Detection',
        'desc'  => 'AI insights watch institutional data for unusual changes, such as sudden drops in enquiries or spikes in absences, and alert the right team with context.',
        'h1'    => 'AI insights that notice what dashboards miss',
        'nav_label' => 'AI Insights',
        'lead'  => 'Dashboards show what you look for. AI insights watch for changes you did not think to check (an unusual drop, spike or shift) and tell the right people.',
        'icon'  => 'bell',
        'blocks' => [
            sec('From monitoring to noticing',
                'A leadership team cannot inspect every programme, campus and source every day. Insight detection compares current activity with expected patterns and surfaces meaningful deviations, such as enquiries for one programme falling well below the usual level for the week, or absences clustering in one section.'),
            table('Examples of insights', ['Insight', 'Who is alerted'], [
                ['Enquiries from a key source dropped sharply this week', 'Admissions and marketing leads'],
                ['Absence rate in one section is well above its norm', 'Programme coordinator'],
                ['Online payment failures increased after a gateway change', 'Finance and IT'],
                ['Unanswered enquiries are ageing beyond the target response time', 'Admissions manager'],
            ]),
            checks('Keeping alerts useful', [
                'Thresholds tuned to avoid alert fatigue',
                'Each insight links to the underlying data',
                'Teams can snooze or mark insights as expected',
                'Weekly digest option instead of instant alerts',
            ]),
            note('Insights point to where to look; they do not explain causes on their own. For narrative summaries of reports, see [AI Reporting](/ai/ai-reporting/).'),
        ],
        'related' => ['/ai/ai-reporting/', '/platform/institutional-dashboard/', '/ai/ai-predictive-analytics/'],
    ],

    '/ai/ai-reporting/' => [
        'title' => 'AI Reporting & Narrative Summaries',
        'desc'  => 'AI reporting turns dashboards into plain-language summaries for leadership, explaining what changed, why it may matter and what the data cannot tell you.',
        'h1'    => 'AI reporting: from charts to clear summaries',
        'nav_label' => 'AI Reporting',
        'lead'  => 'Generate a draft narrative from any report or dashboard (what changed, compared with what, and what might need attention), ready for a person to review and share.',
        'icon'  => 'chart',
        'blocks' => [
            sec('Why narrative matters',
                'Leadership meetings rarely need another chart. They need two paragraphs that say what moved, how it compares and what the team proposes. Writing those paragraphs every week is time-consuming, and the result varies by author. AI can produce a consistent first draft in seconds.'),
            steps('How a report summary is produced', [
                'Select' => 'Choose a report or dashboard and a comparison period.',
                'Draft' => 'Acadlytic AI writes a summary grounded only in that report’s data.',
                'Check' => 'Every figure links back to the chart it came from.',
                'Edit' => 'The owner adjusts wording, adds context and approves.',
                'Share' => 'Send by email or attach to the dashboard for the meeting.',
            ]),
            checks('Built-in honesty', [
                'Summaries state when data is incomplete or sample sizes are small',
                'Correlation is not presented as cause',
                'Draft status is visible until a person approves',
                'Original numbers remain one click away',
            ]),
        ],
        'related' => ['/platform/reports-insights/', '/comparisons/ai-reporting-vs-manual-reporting/', '/ai/ai-insights/', '/core/ai-assistant/'],
    ],

    '/ai/ai-workflows/' => [
        'title' => 'AI Workflows & Automation with Human Approval',
        'desc'  => 'Automate administrative work with AI steps inside approval-based workflows: classify, extract, draft and summarise, with confidence thresholds and a full audit log.',
        'h1'    => 'AI workflows with people in the loop',
        'nav_label' => 'AI Workflows',
        'lead'  => 'Add AI steps (classify, extract, draft, summarise) to Acadlytic workflows, set confidence thresholds and decide exactly where a person must approve.',
        'icon'  => 'workflow',
        'blocks' => [
            sec('Where AI fits in automation',
                'Rule-based automation handles predictable steps: if a fee is overdue by seven days, send a reminder. Many administrative tasks do not fit clean rules. A student email might be a transcript request, a complaint or a fee question; a scanned file might be a mark sheet or an identity proof. AI steps classify and extract from this unstructured input so that rule-based workflows can take over, with people reviewing anything uncertain.'),
            table('Task types and the right level of automation', ['Task', 'AI contribution', 'Human checkpoint'], [
                ['Sorting incoming requests', 'Classifies emails and portal requests by type and urgency', 'Staff can re-route; low-confidence items go to a person'],
                ['Extracting document data', 'Reads names, dates and marks from uploaded documents', 'Staff verify extracted values before they update records'],
                ['Drafting routine replies', 'Prepares answers from approved knowledge', 'Staff approve before sending'],
                ['Summarising long threads', 'Condenses case history for hand-over', 'Receiving staff member reviews'],
                ['Tagging feedback', 'Groups survey comments by theme', 'Analysts check themes before reporting'],
            ]),
            steps('Building blocks', [
                'Trigger' => 'An event or schedule starts the workflow, such as a new request arriving in the student portal.',
                'AI step' => 'Classify the request, extract details or draft a response.',
                'Confidence gate' => 'Above your threshold the workflow continues; below it the item goes to a person.',
                'Approval' => 'Named roles approve drafts or decisions, with deadlines and escalation.',
                'Action' => 'Update the record, send the approved message or create a task.',
                'Log' => 'Inputs, AI outputs, approvals and final actions are stored for audit.',
            ]),
            sec('Worked example: handling a transcript request',
                'A student writes, “I need my transcript sent to a university abroad by Friday.” The AI step classifies it as a transcript request and extracts the destination and deadline. The workflow checks finance and library clearance automatically. If cleared, it generates the transcript and prepares a secure sharing link, and a registrar approves the release with one click. If not cleared, it drafts a message explaining what is outstanding for staff to send.'),
            checks('Controls available to administrators', [
                'Enable AI steps per workflow, not globally',
                'Set confidence thresholds per step',
                'Require approval for any outbound message or record change',
                'Review a sample of AI outputs each week',
                'Switch AI steps off instantly without breaking the workflow',
            ]),
        ],
        'related' => ['/platform/workflow-automation/', '/ai/ai-document-intelligence/', '/ai/responsible-ai/', '/resources/education-workflow-automation/'],
    ],

    '/ai/ai-search/' => [
        'title' => 'AI-Powered Search',
        'desc'  => 'Find people, records, documents and answers across Acadlytic with natural-language search that understands intent and respects permissions.',
        'h1'    => 'AI-powered search across your institution',
        'nav_label' => 'AI Search',
        'lead'  => 'Type what you mean (“second-year commerce students with pending fees”) and get the right list, record or document, limited to what you are allowed to see.',
        'icon'  => 'search',
        'blocks' => [
            sec('Search that understands questions',
                'Traditional search matches keywords. Staff often do not know the exact field names or filters to use. AI-powered search interprets the intent of a query, translates it into structured filters and shows you the filters it applied, so you can adjust them.'),
            table('Examples', ['You type', 'Acadlytic returns'], [
                ['“Applicants for MBA who haven’t uploaded transcripts”', 'A filtered applicant list with the missing-document condition applied'],
                ['“Policy on attendance condonation”', 'The relevant policy document and section'],
                ['“Priya from last week’s open day”', 'Matching enquiry records from the event'],
                ['“Students in section B with attendance under 75%”', 'A list you can message or export'],
            ]),
            checks('Built for trust', [
                'Results respect record- and field-level permissions',
                'Applied filters are shown and editable',
                'Search queries are logged like other data access',
                'Works alongside classic filters for precise control',
            ]),
        ],
        'related' => ['/core/ai-assistant/', '/platform/data-management/', '/ai/ai-document-intelligence/'],
    ],

    '/ai/ai-document-intelligence/' => [
        'title' => 'AI Document Intelligence',
        'desc'  => 'AI document intelligence classifies uploaded documents, extracts key fields and checks legibility and completeness, so staff verify faster with fewer errors.',
        'h1'    => 'AI document intelligence for verification',
        'nav_label' => 'Document Intelligence',
        'lead'  => 'When applicants and students upload documents, AI checks what each file is, whether it is readable and what it says, and prepares the verification screen for staff.',
        'icon'  => 'doc',
        'blocks' => [
            sec('The verification bottleneck',
                'In admission season, staff may verify thousands of documents. Many problems are simple: the wrong document in the wrong slot, a blurred photo or a cropped page. Catching these at upload time, and asking the applicant to fix them immediately, saves days.'),
            cards('What it does', [
                'Classification' => 'Recognises the document type, such as mark sheet, certificate or identity proof, and flags mismatches.',
                'Quality checks' => 'Detects blur, glare, cropping and missing pages at upload.',
                'Field extraction' => 'Reads names, dates, grades and numbers into a structured form.',
                'Consistency checks' => 'Compares extracted values with application data and highlights differences.',
            ]),
            steps('Human verification stays in charge', [
                'Pre-check' => 'AI prepares the document with extracted fields and any warnings.',
                'Verify' => 'A staff member confirms or corrects each field.',
                'Record' => 'Only verified values update the student record, with the verifier recorded.',
            ]),
            note('Document intelligence assists verification. It does not determine authenticity on its own; formal authenticity checks follow your institution’s procedures.'),
        ],
        'related' => ['/platform/electronic-document-sharing/', '/platform/application-management/', '/ai/ai-workflows/', '/glossary/electronic-document-management/'],
    ],

    '/ai/ai-predictive-analytics/' => [
        'title' => 'Predictive Analytics for Education',
        'desc'  => 'Forecast enrolment, demand and capacity with predictive analytics that show ranges, assumptions and accuracy, so planning is informed rather than overconfident.',
        'h1'    => 'Predictive analytics for enrolment and planning',
        'nav_label' => 'Predictive Analytics',
        'lead'  => 'Use your pipeline and historical patterns to forecast enrolment and demand as ranges, with the assumptions stated and accuracy tracked over time.',
        'icon'  => 'trend',
        'blocks' => [
            sec('Forecasts you can plan with',
                'Planning decisions (sections to open, faculty to hire, hostel places to reserve, marketing budgets to shift) depend on how many students will actually enrol. A single-number forecast hides uncertainty. Acadlytic presents forecasts as ranges and updates them as the cycle progresses.'),
            cards('Forecast types', [
                'Enrolment by programme' => 'Expected enrolments from the current pipeline, using historical conversion by stage.',
                'Demand trends' => 'Interest in programmes over time to inform the portfolio.',
                'Capacity pressure' => 'Sections or hostels likely to fill early.',
                'Yield by source' => 'Which sources are likely to convert this cycle.',
            ]),
            checks('How we keep forecasts honest', [
                'Ranges with low, likely and high scenarios',
                'Plain-language assumptions attached to each forecast',
                'Back-testing against previous cycles',
                'Accuracy reported at the end of each cycle',
                'Forecasts inform planning; they never decide individual outcomes',
            ]),
        ],
        'related' => ['/platform/enrollment-analytics/', '/ai/ai-insights/', '/solutions/for-leadership/', '/resources/data-driven-education/'],
    ],

    '/ai/ai-communications/' => [
        'title' => 'AI for Education Communications',
        'desc'  => 'Draft clear, on-brand messages for students, parents and applicants with AI, including translation, tone adjustment and summaries, always reviewed before sending.',
        'h1'    => 'AI for clearer institutional communication',
        'nav_label' => 'AI Communications',
        'lead'  => 'Draft, simplify and translate messages in seconds, grounded in approved information and reviewed by staff before anything is sent.',
        'icon'  => 'message',
        'blocks' => [
            sec('Communication at institutional scale',
                'Every week, staff write dozens of messages that say similar things in slightly different ways. Quality varies, translations lag and important details get lost in long paragraphs. AI helps staff start from a clear, accurate draft.'),
            cards('Capabilities', [
                'Draft from intent' => 'Describe the purpose (“remind first-years about Friday’s orientation, mention venue change”) and get a draft using approved details.',
                'Simplify' => 'Rewrite dense policy text into plain language for students and parents.',
                'Translate' => 'Produce drafts in the languages your community uses, for review by a fluent speaker.',
                'Adjust tone' => 'More formal for official notices, warmer for welcome messages.',
                'Summarise threads' => 'Condense long conversations before replying.',
            ]),
            checks('Guardrails', [
                'AI drafts use your approved facts, dates and links',
                'A person approves every message before it is sent',
                'Messages go through the [Communication Hub](/platform/communication-hub/) consent rules',
                'Drafts are marked as AI-assisted in the audit log',
            ]),
        ],
        'related' => ['/platform/communication-hub/', '/ai/ai-personalization/', '/core/ai-assistant/', '/solutions/for-parents/'],
    ],

    '/ai/ai-in-education/' => [
        'title' => 'AI in Education: Practical Uses Today',
        'desc'  => 'Where AI genuinely helps education institutions today (administration, student support and insight), where it does not, and how to adopt it responsibly.',
        'h1'    => 'AI in education: what works today',
        'nav_label' => 'AI in Education',
        'lead'  => 'Separating useful AI from hype: the institutional tasks where AI already saves time and improves service, and the areas where caution is warranted.',
        'icon'  => 'ai',
        'blocks' => [
            sec('A practical view',
                'Discussion of AI in education often focuses on classrooms and assessment integrity. For institution leaders, some of the most immediate value is operational: responding to enquiries faster, reducing manual data entry, identifying students who need support and turning data into readable summaries. These uses are lower-risk because a person reviews the output before it affects anyone.'),
            table('Where AI fits today', ['Area', 'Good fit', 'Use with caution'], [
                ['Admissions', 'Prioritising follow-ups, drafting replies, document pre-checks', 'Any automated scoring for selection'],
                ['Student support', 'Early-warning signals reviewed by advisors', 'Labelling students or automated sanctions'],
                ['Administration', 'Classifying requests, extracting document data', 'Unreviewed changes to official records'],
                ['Leadership', 'Narrative summaries, forecasts as ranges', 'Treating forecasts as certainties'],
                ['Communication', 'Drafting, simplifying, translating', 'Sending without human review'],
            ]),
            checks('Questions to ask any AI vendor', [
                'What data does the AI use, and is our data used to train shared models?',
                'Can users see why a suggestion was made?',
                'Where is human approval required, and can we configure it?',
                'How are errors reported and corrected?',
                'How is performance monitored across different student groups?',
            ]),
            note('For a leadership-level adoption roadmap, read our [AI in higher education guide](/resources/ai-in-higher-education-guide/).'),
        ],
        'related' => ['/resources/ai-in-higher-education-guide/', '/ai/responsible-ai/', '/ai/', '/comparisons/ai-reporting-vs-manual-reporting/'],
    ],

    '/ai/responsible-ai/' => [
        'title' => 'Responsible AI at Acadlytic',
        'desc'  => 'The principles and controls that govern AI in Acadlytic: human oversight, transparency, privacy, fairness monitoring, security and institutional control.',
        'h1'    => 'Responsible AI at Acadlytic',
        'nav_label' => 'Responsible AI',
        'lead'  => 'AI in education affects real people’s opportunities. These are the principles we build to and the controls institutions have over every AI feature.',
        'icon'  => 'shield',
        'blocks' => [
            cards('Our principles', [
                'Human oversight' => 'AI supports decisions; people make consequential ones. Outbound messages and record changes proposed by AI require approval by default.',
                'Transparency' => 'Users can see when content is AI-generated and why a suggestion or flag was made.',
                'Privacy' => 'AI uses only data the user may access. Institutional data is not used to train public models.',
                'Fairness' => 'We exclude sensitive attributes from risk and prioritisation features and monitor outcomes across groups.',
                'Reliability' => 'We test AI features before release, track errors and provide ways to report problems.',
                'Institutional control' => 'Each AI feature can be enabled, configured or disabled by the institution.',
            ]),
            table('Controls available to institutions', ['Control', 'Purpose'], [
                ['Feature switches', 'Turn individual AI features on or off by role or department'],
                ['Approval requirements', 'Decide which AI outputs require human sign-off'],
                ['Signal configuration', 'Choose which data may inform early-warning or prioritisation'],
                ['Audit logs', 'Review AI suggestions, approvals and resulting actions'],
                ['Feedback', 'Report incorrect or inappropriate outputs for review'],
            ]),
            sec('What we will not build',
                'We will not build features that make automated admission or disciplinary decisions about individuals, infer sensitive characteristics, or monitor students in ways they would not reasonably expect. If an institution’s requirements move toward these areas, we will say so plainly.'),
        ],
        'related' => ['/core/security/', '/trust/privacy/', '/ai/ai-in-education/', '/resources/ai-in-higher-education-guide/'],
    ],
];
