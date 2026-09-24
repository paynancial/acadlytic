# 02 · Information architecture and UX

## 2. Public website sitemap (acadlytic.com)

The public site already exists: 148 indexable URLs and 69 permanent redirects. The IA below keeps today's canonical URLs, because redirects protect link equity. It also shows where each requested section lives.

| Section | Canonical URL | Short alias (301) | Contents |
|---|---|---|---|
| Home | `/` | — | Positioning, platform overview, CTA |
| Platform | `/platform/` | `/features/` | Module pages: `/platform/admissions-crm/`, `/platform/student-management/`, `/platform/academic-operations/`, `/platform/finance-fees/`, `/platform/communication-hub/`, `/platform/reports-insights/`, … (19 pages) |
| Features | Platform module pages | `/features/` → `/platform/` | Features are organised by module rather than as a separate list, which avoids duplicate content |
| AI | `/ai/` | — | `/ai/ai-for-admissions/`, `/ai/responsible-ai/`, … (15) |
| Solutions (by role) | `/solutions/` | — | `/solutions/for-administrators/`, `/solutions/for-faculty/`, … (16) |
| Industries (institution types) | `/industries/` | — | `/industries/community-colleges/`, `/industries/private-institutions/`, … (9) |
| Integrations | `/integrations/` | — | SIS, LMS, ERP, SSO, payments, messaging: all *planned* (14) |
| Security | `/core/security/` | `/security/` | Security design (planned controls), vulnerability reporting |
| Resources | `/resources/` | — | Guides, blog, FAQs, checklists (22) |
| Blog | `/resources/blog/` | `/blog/` | Articles |
| Glossary | `/glossary/` | — | 18 definitions (DefinedTerm schema) |
| Comparisons | `/comparisons/` | — | CRM vs SIS, CRM vs ERP, … (8) |
| Case Studies | `/company/case-studies/` | — | `noindex` placeholder until verified, approved case studies exist |
| Pricing | `/core/pricing/` | `/pricing/` | Pricing approach (no published prices yet) |
| About | `/core/about/` | `/about/`, `/about-us/` | Company, vision & mission, leadership, team, news, offices |
| Partners | `/company/partners/` | — | Partner programme |
| Contact | `/core/contact/` | `/contact/`, `/contact-us/` | Contact form, officers, office |
| Request Demo | `/company/request-demo/` | `/demo/` | Demo request form, the primary conversion |
| Legal & trust | `/trust/` | `/privacy/`, `/terms/` | Privacy, terms, grievance, DPO, GRO, accessibility |
| Sign-in | `/login.php`, `/login/` | — | `noindex`. Becomes a hand-off to `app.acadlytic.com/login` when the SaaS launches |

**URL conventions:** lowercase, hyphenated, trailing slash, one topic per URL, no dates in URLs, and no query strings for content.

**Recommendation:** the `/core/` prefix (about, contact, pricing, security) is an artefact of the original package. If shorter canonicals are wanted (`/about/`, `/pricing/`, `/security/`), switch them **before launch**, while external link equity is still near zero. Do it in one change: flip the canonical, reverse the 301s, and update the sitemap. Otherwise leave them as they are.

**New public pages the SaaS launch will need** (all PLANNED):
- `/status/`: a service status page.
- `/trust/subprocessors/`: sub-processor register, published once contracts exist.
- `/trust/security/vulnerability-disclosure/`: a disclosure policy plus `/.well-known/security.txt`.
- `/developers/`: public API documentation (FUTURE, Phase F).

## 3. SaaS application sitemap (app.acadlytic.com)

### URL and tenant scheme

- Single application origin: `https://app.acadlytic.com`.
- Users sign in once, then choose an institution. Users who belong to several tenants, such as consultants or multi-campus staff, can switch.
- SPA routes carry the tenant slug: `https://app.acadlytic.com/{tenant}/admissions/applicants/{id}`.
- API calls go to `https://app.acadlytic.com/api/v1/...` with the tenant resolved from the authenticated membership plus an `X-Acadlytic-Tenant` header. The header is validated against the user's memberships, never trusted blindly. API tokens are bound to exactly one tenant.
- Vanity subdomains (`{tenant}.acadlytic.app`) and custom domains are FUTURE. The tenant resolver is designed for them, but they add certificate, cookie and CORS complexity that the MVP does not need.

### Navigation by module

Navigation is role-based: users see only modules they have at least one permission in.

| Module | Route | Purpose (why it exists) | Phase |
|---|---|---|---|
| Dashboard | `/{t}/` | Role-specific command centre: today's tasks, alerts, key numbers. The primary landing page for every role. | A (shell), B+ widgets |
| Admissions → Leads | `/{t}/admissions/leads` | Enquiries before an application: capture, dedupe, assign, nurture. Admissions teams lose most prospects before they apply. | B |
| Admissions → Applicants | `/{t}/admissions/applicants` | Applications through configurable stages to an offer and acceptance, with a document checklist | B |
| Admissions → Campaigns | `/{t}/admissions/campaigns` | Source attribution and outreach campaigns, linked to Communications | B |
| Students | `/{t}/students` | The student record of truth: profile, status history, programs, holds. Everything else hangs off it. | B |
| Parents / Guardians | `/{t}/guardians` | Guardian contacts, relationships and consent. Required for minors and for communication preferences. | B |
| Faculty & Staff | `/{t}/people/staff` | Staff directory, faculty assignments to sections, advisee lists. HR and payroll are **out of scope** (use an HR system). | C |
| Academics → Programs & Courses | `/{t}/academics/programs`, `/courses` | Academic structure that enrolment, attendance and grades depend on | C (structure in A) |
| Academics → Classes/Sections | `/{t}/academics/sections` | Course offerings per term with timetable and faculty | C |
| Attendance | `/{t}/academics/attendance` | Per-session attendance and alerts, a key student-support signal | C |
| Examinations & Results | `/{t}/academics/assessments` | Assessment plans, grade entry, moderation, result publication with approval | C |
| Assignments | `/{t}/academics/assignments` | Lightweight coursework tracking only when no LMS is used. Where an LMS exists it stays the system of record (integration, Phase F). | C (optional module) |
| Communication | `/{t}/communication` | Inbox, templates, campaigns, delivery logs, opt-outs | B (email), D (SMS/WhatsApp) |
| Documents | `/{t}/documents` | Secure document store, verification queue, retention | B |
| Finance | `/{t}/finance` | Fee structures, invoices, payments, concessions, receipts | D |
| Reports | `/{t}/reports` | Standard and saved reports, scheduled exports | D |
| Analytics | `/{t}/analytics` | Dashboards: admissions funnel, retention, finance | D |
| AI Center | `/{t}/ai` | Assistant, AI suggestions queue (approve/reject), usage and settings | E |
| Automation | `/{t}/automation` | Workflow rules with approvals and run history | E |
| Integrations | `/{t}/settings/integrations` | Connected apps, webhooks, API keys, import jobs | D (webhooks), F |
| Support | `/{t}/support` | Help articles, contact support, grant time-boxed support access | A |
| Settings | `/{t}/settings` | Institution profile, structure, branding, preferences, retention | A |
| Administration | `/{t}/admin` | Users, invitations, roles, permissions, SSO, security policies | A |
| Audit Logs | `/{t}/admin/audit` | Searchable audit trail and export for auditors | A |
| My account | `/account` | Profile, MFA, sessions/devices, notification preferences | A |
| Student / Guardian portal | `/{t}/portal` | Self-service: my profile, documents, fees, attendance, results | C/D |

**Deliberately not built as separate modules:**
- **Leads** and **Applicants** are two views of one Admissions module, sharing the person record.
- **Attendance, exams and assignments** live under Academics.
- **HR/Staff** is limited to a directory and assignments.

## 16. Frontend UX principles (SaaS)

| Principle | Design |
|---|---|
| Role-based navigation | The nav is built from the user's effective permissions (from `/api/v1/me/permissions`); unavailable modules are not rendered, not just disabled. The server still enforces every call. |
| Progressive disclosure | List → detail → drawer for secondary data. Advanced filters and bulk actions appear on demand. |
| Command-centre dashboard | Per-role widgets (e.g. counsellor: overdue follow-ups, new leads; registrar: pending document verifications; finance: overdue invoices). Widgets respect scopes. |
| Global search | One search box across permitted entities (people, applications, documents), tenant- and scope-filtered on the server |
| Command palette | ⌘K / Ctrl+K: navigate, create records, run saved views; only permitted actions appear |
| Saved views | Named filters and columns per list, private or shared within the tenant |
| Contextual AI | The AI appears next to the work (“summarise this applicant”, “draft reply”) with sources shown. Outputs are drafts until a human accepts them. |
| Focus mode | Distraction-free data entry, e.g. grade entry and document verification queues, with keyboard-first flows |
| Smart notifications | In-app bell plus digests, grouped and rate-limited, with per-user channel preferences |
| Accessibility | WCAG 2.2 AA target, keyboard complete, visible focus, reduced-motion support, and automated axe checks in CI (as on the website) |
| Responsive | Fully usable on tablet; phone-optimised for portal, approvals and notifications. Heavy data entry targets desktop. |
| Consistency | One design system (tokens from the website brand: navy, electric blue, cyan), with shared components for tables, forms, drawers and empty states |
| Performance | Route-level code splitting, list virtualisation, optimistic UI only for reversible actions |
