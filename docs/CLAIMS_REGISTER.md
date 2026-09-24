# Launch claims register

Every public claim on acadlytic.com, its classification, and what must be true
before its wording can change. Owner: Acadlytic, Inc. Last reviewed: 2026-09-24.

**Policy**

- **LIVE**: a verified fact or positioning statement. It may be stated plainly.
- **PLANNED**: in development, with no verified working implementation. The page carries the *Planned · In development* notice, and copy uses "is designed to…", "is building…", "planned…" or "will…". It must never read as currently available.
- **REMOVE**: unsupported. It must not appear on the site.

`php bin/qa.php` enforces this. Product pages must show the planned notice, and it fails on present-tense availability claims ("Acadlytic gives…", bare "Yes." FAQ answers), unsupported statistics (e.g. "12K+ institutions", uptime percentages) and superlatives ("#1", "industry-leading").

**To promote a claim from PLANNED to LIVE:** attach the evidence listed below (working build, test records, signed agreement or document), set `'status' => null` on the page (or remove the section's `planned` flag), rewrite the wording in present tense, and update this register in the same commit.

## LIVE: core positioning and verified facts

| Feature / Claim | Current Website Wording | Classification | Evidence Required | Recommended Public Wording |
|---|---|---|---|---|
| Company name | “Acadlytic, Inc.” | LIVE | Company registration (supplied by owner) | Acadlytic, Inc. |
| Tagline | “Where Education Meets Intelligence.” | LIVE | Brand guidelines (supplied) | Unchanged |
| Pillars | “AI \| CRM \| CLOUD \| ACADEMIC MANAGEMENT” | LIVE | Brand guidelines (supplied) | Unchanged |
| AI-powered EdTech positioning | “Acadlytic, Inc. is building an AI-powered EdTech CRM and cloud platform…” | LIVE (positioning) | None: positioning statement | Keep “is building” until the product is generally available |
| EdTech CRM positioning | “An EdTech CRM designed for the whole student relationship” | LIVE (positioning) | None | Unchanged; capabilities on the page remain PLANNED |
| Cloud platform positioning | “Acadlytic is being built as a cloud platform for academic management” | LIVE (positioning) | None | Unchanged |
| Academic management positioning | “Academic management software, rebuilt around connected data” | LIVE (positioning) | None | Unchanged |
| Contact details | info@acadlytic.com; phone shown masked (“+91 80••••••71”), reachable via Call and WhatsApp buttons (`/go/call/`, `/go/whatsapp/`); the full number lives only in `config/contact.php` | LIVE | Supplied by owner | Do not label the number “toll-free” unless the provider confirms; never print it in full in the UI |
| Data Protection Officer | Mr. A.K Sinha, dpo@acadlytic.com | LIVE | Supplied by owner; mailbox must exist | Unchanged |
| Grievance Redressal Officer | Mrs. Anjali Sharma, gro@acadlytic.com | LIVE | Supplied by owner; mailbox must exist | Unchanged |
| Leadership | Renuka Devi, Director; Anisha Bharti, Director (`/company/leadership/`, Person schema) | LIVE | Supplied by owner | Unchanged; add bios only with each person’s approval |
| Office address | “#203, Sharda Mansions Apartment, Kailashpuri, Hanuman Nagar, Patna, Bihar 800020” (`/company/offices/patna/`, footer, Contact, Organization and LocalBusiness schema) | LIVE | Supplied by owner | Call it “office”; say “registered office” only if counsel confirms. Visits “by appointment”. No opening hours or map coordinates published |
| Official social profiles | LinkedIn, X, YouTube, Instagram, Facebook links | LIVE | Supplied by owner | Unchanged |
| Website privacy facts | “one security session cookie on form and sign-in pages; no analytics or advertising trackers” | LIVE | Verified in code (`includes/security.php`, no third-party scripts) | Unchanged; re-verify if analytics are ever added |
| Content integrity | “No invented statistics, customers or testimonials, and planned features labelled as planned” | LIVE | This register plus the QA gate | Unchanged |

## PLANNED: product capabilities (not yet available)

| Feature / Claim | Current Website Wording | Classification | Evidence Required | Recommended Public Wording |
|---|---|---|---|---|
| Admissions & CRM | “Acadlytic is designed to give every enquiry a single record and a timeline” (`/platform/admissions-crm/`) | PLANNED | Working build: enquiry capture, deduplication, assignment, sequences, funnel report | “Acadlytic’s admissions CRM gives every enquiry…” only once verified |
| Student Management | “Acadlytic is designed to keep one record per student” (`/platform/student-management/`) | PLANNED | Working student record, permissions, portal updates | As current until verified |
| Academic Operations | “What academic operations is designed to cover” (`/platform/academic-operations/`) | PLANNED | Timetable, attendance, assessment and results modules in production | As current |
| Finance & Fees | “Acadlytic is designed to manage the student-facing side of finance” (`/platform/finance-fees/`) | PLANNED | Fee plans, invoices, gateway reconciliation working end to end | As current |
| Communication Hub | “Planned channels”, “Planned capabilities” (`/platform/communication-hub/`) | PLANNED | Email/SMS/WhatsApp provider contracts and working sends with consent handling | As current |
| Analytics & Insights / Advanced reporting | “Acadlytic reports are designed to read directly from the platform’s shared data model” (`/platform/reports-insights/`, `/platform/institutional-dashboard/`, `/platform/enrollment-analytics/`) | PLANNED | Working reports and dashboards on real data | As current |
| AI Assistant | “The AI Assistant is planned to be available across the platform” (`/core/ai-assistant/`) | PLANNED | Working assistant with permission enforcement and source citation | As current |
| AI recommendations | “Acadlytic is designed to suggest what to do next” (`/ai/ai-recommendations/`) | PLANNED | Working feature plus evaluation results | As current |
| Predictive analytics | “Acadlytic is designed to present forecasts as ranges” (`/ai/ai-predictive-analytics/`) | PLANNED | Model, back-testing results and accuracy reporting | As current |
| At-risk student identification | “Early-warning signals are designed to combine…” (`/ai/ai-for-student-success/`) | PLANNED | Model, fairness review across groups, access controls | As current; never present as a decision tool |
| Other AI features (reporting, insights, search, document intelligence, communications, personalisation, admissions, advising, workflows) | “Planned …”, “is designed to …” (`/ai/*`) | PLANNED | Working feature per page | As current |
| Automated workflows | “Workflows are designed to be configured … without code” (`/platform/workflow-automation/`, `/ai/ai-workflows/`) | PLANNED | Workflow builder in production | As current |
| Electronic document management | “Acadlytic is designed to replace email attachments and shared drives…” (`/platform/electronic-document-sharing/`) | PLANNED | Upload validation, verification workflow, expiring links, audit log | As current |
| Personalised college recommendations | “Acadlytic is designed to match a student’s profile…” (`/platform/college-recommendations/`) | PLANNED | Matching engine and programme data coverage | As current |
| Post-secondary school database | “Acadlytic is designed to store this information in a consistent structure” (`/platform/post-secondary-school-database/`) | PLANNED | Populated database with sources and verification dates | As current; state coverage once known |
| Student lifecycle automation | “Acadlytic is designed to model the lifecycle explicitly” (`/platform/student-lifecycle/`, `/platform/completion-tracking/`) | PLANNED | Stage engine and automatic tasks | As current |
| Task management, data management, student engagement | “Planned …” headings, “is designed to …” (`/platform/*`) | PLANNED | Working features | As current |
| LMS integrations | “What is planned to flow” (`/integrations/lms-integration/`) | PLANNED | Working connector per named LMS | Name specific LMS products only once a connector is verified |
| SIS integrations | “Two patterns are planned…” (`/integrations/sis-integration/`) | PLANNED | Working connector or documented import | As current |
| ERP integrations | “The planned pattern keeps student billing in Acadlytic…” (`/integrations/erp-integration/`) | PLANNED | Working posting export per ERP | As current |
| API integrations | “Acadlytic is building a REST API…” (`/integrations/api/`, `/integrations/webhooks/`, `/integrations/data-export/`) | PLANNED | Published API documentation and sandbox | As current |
| SSO | “Planned approaches: SAML 2.0, OpenID Connect” (`/integrations/sso-integration/`) | PLANNED | Tested SSO with at least one identity provider | As current |
| Payments, email, WhatsApp, SMS, calendar, CRM integrations | “Planned …” headings (`/integrations/*`) | PLANNED | Provider contracts and working integrations | Name providers only once contracted |
| Solutions by role and institution | “How Acadlytic is designed to help…” (`/solutions/*`, `/industries/*`) | PLANNED | Depends on underlying modules | As current |
| Security controls (platform) | “The controls below describe the security design we are building to” (`/core/security/`) | PLANNED | Engineering sign-off per control; attestations if any | State each control plainly only once implemented and verified |
| Cloud characteristics (backups, updates, tenant isolation, hosting) | “Planned platform characteristics” (`/core/cloud-platform/`) | PLANNED | Hosting contract, backup/restore test records | Never state hosting location or residency until contracted |
| Workspace sign-in | “Workspace access is opening in phases”; sign-in returns “not open yet” (`/login.php`) | PLANNED | Auth backend enabled (`docs/AUTH_ARCHITECTURE.md`) | As current |
| Guided pilots, migration service, training | “We plan to offer guided pilots…”, “Training will be role-based…” (`/core/pricing/`, `/resources/faqs/`) | PLANNED | Defined service offering | As current |
| AI data-use principle | “institutional data will not be used to train public AI models” | PLANNED (design principle) | Contractual terms with AI providers | Present tense only once contracts are in place |

## REMOVE: unsupported claims (none currently on the site)

| Feature / Claim | Current Website Wording | Classification | Evidence Required | Recommended Public Wording |
|---|---|---|---|---|
| Institution count | Not used (appeared as “12K+ Institutions” in the handoff reference image) | REMOVE | Verified customer list | Do not publish |
| Student count | Not used (“5M+ Students” in the reference image) | REMOVE | Verified usage data | Do not publish |
| Country count | Not used (“50+ Countries” in the reference image) | REMOVE | Verified customer list | Do not publish |
| Uptime percentage | Not used (“99.9%” style claims) | REMOVE | Measured SLA history | Do not publish |
| University / customer logos | Not used (Stanford, NUS, Melbourne, Toronto, King’s College London, Monash in the reference image) | REMOVE | Signed logo-use permission from each institution | Do not publish |
| Testimonials | Not used (“Dr. Emily Carter, Provost…” in the reference image) | REMOVE | Real, attributable, written permission | Do not publish |
| Outcome percentages | Not used (“40% higher conversion”, etc. in the reference image) | REMOVE | Verified before/after data | Do not publish |
| “affordable, fast-to-deploy” | Removed from `/solutions/for-colleges/` description | REMOVE | Pricing and deployment evidence | “designed to let small teams run…” |
| “Institutions trust Acadlytic…” | Removed from `/core/security/` | REMOVE | Existing customers | “Institutions will entrust Acadlytic…” |
| Implied existing customers | Removed: “Many institutions keep their SIS … and integrate it with Acadlytic”, “Help for institutions using Acadlytic”, “API documentation … are shared with customers” | REMOVE | Existing customers | Planned-pattern wording |
| “Secure access · Encrypted sessions · Role-based access” | Replaced in the login popover | REMOVE | Role-based workspaces in production | “Secure sign-in · Encrypted connection” |
| “Toll-free” | Never used | REMOVE | Provider confirmation of toll-free status | “Phone” |
| Compliance claims (GDPR, DPDP Act, certifications) | Not used; the DPDP Act reference was removed from the Privacy draft | REMOVE | Legal opinion or completed attestation | Do not publish until confirmed |
