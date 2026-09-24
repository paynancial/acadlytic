# 01 · Product vision and capability matrix

## Product vision

Acadlytic is a **multi-tenant, cloud-based EdTech CRM and academic management ecosystem** for post-secondary institutions: colleges, universities, multi-campus groups and academic organisations. It gives each institution one connected record per person, from first enquiry to alumni. It gives staff role-appropriate workspaces, and adds AI that **assists** people rather than deciding for them.

Design principles:

1. **One tenant, one truth.** Admissions, students, academics, finance and communication share one data model per institution.
2. **Least privilege by default.** People see only what their role and scope require.
3. **Human-in-the-loop AI.** AI suggests, summarises, classifies and drafts; people approve consequential actions.
4. **Privacy and security by design.** Tenant isolation, encryption, audit and data-subject tooling are built before feature breadth.
5. **Evolve without rewrites.** A modular monolith with clean boundaries, extracted into services only when measured need appears.
6. **Honest claims.** A capability is marketed as available only once it is **LIVE** and evidenced.

## Classification

| Status | Meaning | Marketing wording allowed |
|---|---|---|
| **LIVE** | Running in production with evidence (working build, tests, owner sign-off) | Present tense (“Acadlytic does…”) |
| **PLANNED** | In the committed roadmap (Phases A–E below), with design and acceptance criteria | “Planned”, “designed to”, “is building” |
| **FUTURE** | Direction only: depends on validation, scale, partners or contracts (Phase F or later) | “Exploring”, or do not mention |

Promotion from PLANNED to LIVE follows `docs/CLAIMS_REGISTER.md`: attach evidence, change the page status, update the register in the same commit.

## Capability matrix

Phases A–F are defined in [11 Roadmap](11-roadmap-risks-adrs.md).

### What is LIVE today (public website only)

| Capability | Status | Evidence |
|---|---|---|
| Public marketing website (148 indexable pages, SEO and AEO structured data) | LIVE | Deployed; `bin/qa.php` 0 errors |
| Demo, contact, enquiry and access-request lead capture (DB/JSONL storage + email notification) | LIVE | `includes/forms.php`, `includes/enquiry.php` |
| “Talk to Acadlytic” contact widget (enquiry form, email, WhatsApp hand-off, masked call link) | LIVE | `components/contact-widget.php`, `docs/CONTACT_WIDGET_QA.md` |
| Sign-in page shell (no authentication; states that sign-in isn't open yet) | LIVE (UI only) | `docs/AUTH_ARCHITECTURE.md` |
| Approved legal pages (privacy, terms, grievance, DPO, grievance officer) | LIVE | `docs/LEGAL_PUBLICATION_AUDIT.md` |

### SaaS platform capabilities

| Area | Capability | Status | Phase | Depends on |
|---|---|---|---|---|
| Foundation | Multi-tenant institution workspaces | PLANNED | A | Tenant model, RLS |
| Foundation | Identity: email/password, MFA (TOTP), invitations, sessions | PLANNED | A | — |
| Foundation | RBAC with scoped permissions, custom tenant roles | PLANNED | A | Permission catalogue |
| Foundation | Audit log (security and sensitive-data events) | PLANNED | A | — |
| Foundation | Institution structure: campuses, departments, programs, academic years, terms | PLANNED | A | Tenant model |
| Foundation | CSV data import with validation and dry run | PLANNED | A/B | Domain model |
| Institution management | Tenant settings, branding, domains, feature flags | PLANNED | A | — |
| Admissions CRM | Leads, enquiries, sources and campaigns attribution | PLANNED | B | Communications (email) |
| Admissions CRM | Applicants, applications, stages and pipeline, assignment rules | PLANNED | B | Documents |
| Admissions CRM | Tasks, follow-ups, activity timeline | PLANNED | B | — |
| Admissions CRM | Duplicate detection and merge | PLANNED | B | — |
| Student lifecycle | Enrolment conversion (applicant → student) | PLANNED | B | Admissions |
| Student records | Student profile, guardians, contacts, status history | PLANNED | B | RBAC scopes |
| Documents | Secure upload, scanning, verification workflow, versioning | PLANNED | B | Object storage, scanning |
| Communications | Email templates, one-to-one and bulk email, delivery logs, opt-outs | PLANNED | B | Email provider (not contracted) |
| Communications | SMS | PLANNED | B/D | SMS provider (not contracted) |
| Communications | WhatsApp Business messaging | PLANNED | D | WhatsApp BSP, template approval (not contracted) |
| Communications | In-app notifications | PLANNED | B | — |
| Communications | Push notifications (PWA / mobile) | FUTURE | F+ | Mobile strategy |
| Academics | Courses, sections/classes, timetables | PLANNED | C | Institution structure |
| Academics | Attendance | PLANNED | C | Sections |
| Academics | Assessments/exams, grade entry, results | PLANNED | C | Sections, grading schemes |
| Academics | Assignments (lightweight; LMS remains system of record where present) | PLANNED | C | LMS integration decision |
| Faculty | Faculty workspace: my sections, attendance, grading, advisees | PLANNED | C | Academics |
| Parents/guardians | Guardian portal (linked students' permitted information) | PLANNED | C | Consent model |
| Finance | Fee structures, invoices, receipts, concessions | PLANNED | D | Programs, students |
| Finance | Online payments and reconciliation | PLANNED | D | Payment gateway (not contracted) |
| Reports | Operational reports, scheduled exports (CSV/PDF) | PLANNED | D | Queue workers |
| Analytics | Executive and admissions dashboards | PLANNED | D | Reporting layer |
| AI | AI Assistant (tenant-scoped Q&A, summaries, drafts) | PLANNED | E | AI gateway, retrieval, audit |
| AI | Natural-language reporting | PLANNED | E | Reporting semantic layer |
| AI | Communication drafting (human sends) | PLANNED | E | Templates, AI gateway |
| AI | Document intelligence (classify, extract; human verifies) | PLANNED | E | Documents, OCR |
| AI | Student segmentation (rule- and AI-assisted) | PLANNED | E | Analytics |
| AI | Workflow recommendations | PLANNED | E | Automation |
| AI | Enrolment prediction / forecasting | FUTURE | F+ | Historical data, back-testing |
| AI | At-risk student identification (advisory only) | FUTURE | F+ | Data quality, fairness review, institution policy |
| AI | Personalised program recommendations | FUTURE | F+ | Program catalogue data, evaluation |
| Automation | Rule-based workflows (triggers → conditions → actions, with approvals) | PLANNED | E | Events, RBAC |
| Integrations | Outbound webhooks | PLANNED | D | Event bus (in-process) |
| Integrations | SSO (SAML 2.0 / OIDC: Microsoft Entra ID, Google Workspace) | PLANNED | F | Identity abstractions from A |
| Integrations | SIS / LMS / ERP connectors | FUTURE | F+ | Named partner and customer demand |
| Integrations | Public REST API with developer docs and API keys | FUTURE | F | Stable `/api/v1` contracts |
| Enterprise | Dedicated database per tenant | FUTURE | F | Tenant routing |
| Enterprise | Data warehouse and BI connectors | FUTURE | F | Reporting volume |
| Compliance | Data-subject request tooling (export, correction, erasure, legal hold) | PLANNED | A–B | Audit, retention engine |
| Compliance | Evidence collection for SOC 2-oriented controls | PLANNED | A onward | Policies, tooling |
| Compliance | Independent attestations or certifications | FUTURE | — | External audit; none held today |

**Not claimed anywhere:** customers, institutions using the platform, usage statistics, certifications (SOC 2, ISO 27001), legal compliance (FERPA, GDPR, DPDP), or named integration partners. The website must keep these absent until they are evidenced.
