# Website SEO Phase 2: audit, gaps and content matrix

Date: 24/09/2026 · Scope: acadlytic.com public website only. There is no SaaS, CMS or CRM work in this phase.

## 1. Audit of existing URLs (Phase 1 + Phase 2 handoffs, as live)

148 indexable URLs, plus 9 `noindex` pages (auth pages, search, placeholders, Team/News) and 69 permanent redirects.

| Section | Indexable | Page types | Notes |
|---|---|---|---|
| Home, sitemap | 2 | home, HTML sitemap | — |
| `/core/` | 8 | Core positioning (about, academic management, EdTech CRM, cloud, AI assistant, security, pricing, contact) | Planned-product notice where relevant |
| `/platform/` | 19 | Hub + feature pages | All carry *Planned · In development* |
| `/ai/` | 15 | Hub + AI capability pages + responsible AI | Planned |
| `/solutions/` | 16 | Hub + by-role and by-institution pages | Planned |
| `/industries/` | 9 | Hub + institution-type pages | Planned |
| `/integrations/` | 14 | Hub + integration pattern pages | Planned; no named partner claimed |
| `/resources/` | 22 | Hubs (resources, guides, insights), 9 guides, 7 insights, 2 checklists, FAQs | Article schema, takeaways, FAQs |
| `/glossary/` | 18 | Hub + 17 definitions | DefinedTerm schema |
| `/comparisons/` | 8 | Hub + 7 comparisons | Article schema, takeaways |
| `/company/` | 10 | Company, vision, leadership, offices, Patna office, demo, careers, partners, press, support | |
| `/trust/` | 7 | Trust hub + 5 approved legal pages + accessibility | |

**Health.** QA reports 0 errors: unique titles and descriptions, canonicals, OG/X tags, breadcrumbs, a sitemap that matches the indexable pages, no orphans, no repeated 90+ character sentences, and every article with a genuine FAQ.

**Duplicate-intent check (existing).** Near-topic clusters were reviewed and kept, because each targets a different intent:
- *AI in education* (`/ai/ai-in-education/`: practical uses) vs *AI in higher education guide* (leadership adoption roadmap).
- *Automation guide* (what to automate first) vs *workflow worked example* vs `/platform/workflow-automation/` (product) vs the glossary definition.
- *Education analytics guide* (practice) vs glossary definition vs `/platform/reports-insights/` (product).

No existing page needs merging.

## 2. Content gaps (high-intent queries not yet answered)

| Gap | Why it matters | Covered today? |
|---|---|---|
| Category comparisons buyers actually search: **SIS vs LMS, ERP vs SIS, CRM vs LMS, general-purpose CRM vs education CRM, build vs buy** | High-volume “X vs Y” decision queries; strong AEO answers | Only CRM vs SIS, CRM vs ERP |
| Core definitions: **LMS, enrolment management, student retention, RBAC, lead scoring, yield rate** | Definition queries feed featured snippets and support internal links from comparisons | Missing |
| Buyer-journey guides: **implementation plan, data migration, RFP/requirements, total cost of ownership** | Late-stage, high commercial intent | Only “how to choose” (CRM guide, checklists) |
| Operations guides: **student retention strategies, enrolment funnel, fee collection, attendance management** | Practical problems institutions search for | Touched only inside product pages |
| India context: **Indian higher education page, outcome-based education, CBCS, accreditation data readiness** | Acadlytic has an office in Patna, so the relevance is genuine; distinct terminology and search demand | Missing |
| **Student data privacy guide** (framework overview, not legal advice) | Frequent institutional question; supports trust pages | Missing |

## 3. Rejected or merged ideas (duplicate intent, thin or doorway risk)

| Idea | Decision | Reason |
|---|---|---|
| City/location pages (Delhi, Mumbai, Bangalore, …) | **Rejected** | No office or genuine local relevance, so these would be doorway pages. Patna is the only location page. |
| “Best academic CRM” / “top 10 SIS” lists | **Rejected** | Superiority and ranking claims without evidence |
| Brand-vs-brand comparisons (e.g. “Acadlytic vs [vendor]”) | **Rejected** | Acadlytic has no live product to compare, and third-party facts can't be verified |
| New `/use-cases/*` pages | **Rejected** | Would duplicate `/solutions/` and `/platform/`; the old use-case URLs already 301 there |
| Separate “lead nurturing” guide | **Merged** into the enrolment funnel guide | Same intent as the admissions CRM guide and funnel stages |
| DPDP Act standalone guide | **Merged** into the student data privacy guide | Legal accuracy risk. Covered at framework level with a not-legal-advice note. |
| NEP 2020 / Academic Bank of Credits / APAAR pages | **Deferred** | Needs verified, current policy detail; revisit with a reviewed source list |
| Glossary: data governance, summer melt | **Rejected** | Covered by the data strategy guide, or not relevant to the core market |
| Exam management guide | **Deferred** to a later batch | Lower priority than attendance and fees; avoids overlap with `/platform/academic-operations/` |

## 4. Content matrix (Phase 2 new URLs)

Every new page is **indexable**, gets a title, meta description, canonical, OG/X tags, breadcrumbs, H1/H2 structure, a CTA band, related links and structured data. Guides and comparisons get Article schema; glossary pages get DefinedTerm; FAQPage is added where the FAQ is genuine. Product capabilities are mentioned only as **planned**.

### Batch 1: comparisons and definitions (foundation for internal links)

| URL | Primary keyword / search intent | Page type | Parent | Internal-link targets | Index | Content status |
|---|---|---|---|---|---|---|
| `/comparisons/sis-vs-lms/` | “SIS vs LMS”: understand the difference | Comparison | `/comparisons/` | glossary SIS, glossary LMS, `/integrations/lms-integration/`, `/comparisons/academic-crm-vs-sis/` | index | **Published** |
| `/comparisons/erp-vs-sis/` | “ERP vs SIS in education” | Comparison | `/comparisons/` | glossary ERP, glossary SIS, `/integrations/erp-integration/`, `/comparisons/academic-crm-vs-erp/` | index | **Published** |
| `/comparisons/crm-vs-lms/` | “CRM vs LMS for education” | Comparison | `/comparisons/` | glossary academic CRM, glossary LMS, `/core/edtech-crm/`, `/comparisons/sis-vs-lms/` | index | **Published** |
| `/comparisons/general-crm-vs-education-crm/` | “education CRM vs generic CRM”: should a college use a general-purpose CRM? | Comparison | `/comparisons/` | `/resources/academic-crm-guide/`, `/core/edtech-crm/`, `/integrations/crm-integration/` | index | **Published** |
| `/comparisons/build-vs-buy-education-software/` | “build vs buy student management software” | Comparison | `/comparisons/` | `/resources/academic-management-checklist/`, `/comparisons/point-solutions-vs-platform/`, TCO guide | index | **Published** |
| `/glossary/learning-management-system/` | “what is an LMS” | Definition | `/glossary/` | `/comparisons/sis-vs-lms/`, `/integrations/lms-integration/`, glossary SIS | index | **Published** |
| `/glossary/enrollment-management/` | “what is enrolment management” (incl. strategic enrolment management) | Definition | `/glossary/` | glossary admissions management, `/platform/enrollment-analytics/`, funnel guide | index | **Published** |
| `/glossary/student-retention/` | “what is student retention / retention rate” | Definition | `/glossary/` | retention strategies guide, glossary student success, `/ai/ai-for-student-success/` | index | **Published** |
| `/glossary/role-based-access-control/` | “what is role-based access control (RBAC) in education software” | Definition | `/glossary/` | `/core/security/`, glossary SSO, `/solutions/for-it-teams/` | index | **Published** |
| `/glossary/lead-scoring/` | “what is lead scoring in admissions” | Definition | `/glossary/` | `/platform/admissions-crm/`, `/ai/ai-for-admissions/`, funnel guide | index | **Published** |

### Batch 2: buyer-journey and operations guides

| URL | Primary keyword / search intent | Page type | Parent | Internal-link targets | Index | Content status |
|---|---|---|---|---|---|---|
| `/resources/crm-implementation-plan/` | “CRM implementation plan for colleges” | Guide | `/resources/guides/` | academic CRM guide, data migration guide, `/company/request-demo/` | index | **Published** |
| `/resources/student-data-migration/` | “migrating student data to a new system” | Guide | `/resources/guides/` | `/integrations/data-export/`, `/platform/data-management/`, implementation plan | index | **Published** |
| `/resources/education-software-rfp/` | “RFP template / requirements for student management or CRM software” | Guide (checklist) | `/resources/guides/` | academic management checklist, cloud checklist, TCO guide | index | **Published** |
| `/resources/education-software-tco/` | “cost of student management software / total cost of ownership” | Guide | `/resources/guides/` | `/core/pricing/`, build vs buy, RFP guide | index | **Published** |
| `/resources/student-retention-strategies/` | “student retention strategies higher education” | Guide | `/resources/guides/` | glossary retention, `/ai/ai-for-student-success/`, engagement strategies | index | **Published** |
| `/resources/enrollment-funnel-guide/` | “student enrolment funnel stages and metrics” | Guide | `/resources/guides/` | admissions CRM guide, glossary lead scoring, `/platform/enrollment-analytics/` | index | **Published** |
| `/resources/fee-collection-guide/` | “how to improve fee collection in colleges” | Guide | `/resources/guides/` | `/platform/finance-fees/`, `/integrations/payment-integration/`, `/solutions/for-finance-teams/` | index | **Published** |
| `/resources/attendance-management-guide/` | “student attendance management best practices” | Guide | `/resources/guides/` | `/platform/academic-operations/`, retention strategies, `/solutions/for-faculty/` | index | **Published** |

### Batch 3: India context and trust

| URL | Primary keyword / search intent | Page type | Parent | Internal-link targets | Index | Content status |
|---|---|---|---|---|---|---|
| `/industries/higher-education-india/` | “academic management software for Indian colleges” | Market page (genuine: Patna office) | `/industries/` | Patna office, OBE, CBCS, accreditation guide, `/integrations/whatsapp-integration/` | index | Batch 3 |
| `/glossary/outcome-based-education/` | “what is outcome based education (OBE)” | Definition | `/glossary/` | accreditation guide, India page, `/platform/academic-operations/` | index | Batch 3 |
| `/glossary/choice-based-credit-system/` | “what is CBCS” | Definition | `/glossary/` | India page, glossary SIS, `/platform/academic-operations/` | index | Batch 3 |
| `/resources/accreditation-data-guide/` | “preparing data for accreditation (e.g. NAAC, NBA)” | Guide | `/resources/guides/` | OBE, data strategy, institutional dashboard guide | index | Batch 3 |
| `/resources/student-data-privacy-guide/` | “protecting student data / student data privacy” | Guide | `/resources/guides/` | `/trust/privacy/`, `/core/security/`, RBAC, `/ai/responsible-ai/` | index | Batch 3 |
| `/glossary/yield-rate/` | “what is admissions yield rate” | Definition | `/glossary/` | funnel guide, lead scoring, `/platform/enrollment-analytics/` | index | Batch 3 |

**Total: 24 new pages**, bringing the site to 172 indexable URLs. Each batch is validated before the next begins (QA gate, metadata audit, link graph, accessibility, overflow).

## 5. Internal-link graph

Core pages → feature pages (`/platform/`, `/ai/`) → solutions and industries → guides → insights → glossary and comparisons.

- New comparisons link to both definitions and to the relevant integration pattern.
- New definitions link back to their comparison and guide.
- New guides link to the relevant product page (as *planned*), a checklist and the demo CTA.
- Hubs (`/comparisons/`, `/glossary/` groups, `/resources/guides/`, `/resources/`) list every new page.
- Existing high-authority pages get contextual `related` links to the new pages, so no new page depends on hubs alone.

## 6. Batch validation log

| Batch | Pages | Result |
|---|---|---|
| 1 | 5 comparisons + 5 definitions; glossary hub groups updated; contextual links added from 10 existing pages (LMS integration, ERP integration, SIS/ERP/admissions-management/student-success definitions, security, admissions CRM, EdTech CRM, academic CRM guide) | `bin/qa.php` and `--launch`: 0 errors, 0 warnings. Metadata audit: no orphans, unique titles and descriptions. axe: 0 violations on 12 pages. No horizontal overflow at 320–1440px. Each page has one H1, canonical, OG, Article or DefinedTerm + FAQPage + BreadcrumbList schema, and the contact CTA. Claims scan: no new flags. Sitemap: 158 indexable URLs. |
| 2 | 8 guides added to `/resources/guides/`; contextual links added from 12 existing pages (academic and admissions CRM guides, finance and fees, academic operations, data management, pricing, academic management checklist, AI for student success, and the batch 1 definitions and build-vs-buy comparison) | `bin/qa.php` and `--launch`: 0 errors, 0 warnings. Metadata audit: no orphans. axe: 0 violations on 10 pages. No overflow at 320–1440px. Each guide has one H1, canonical, OG, Article + FAQPage + BreadcrumbList schema, takeaways and the contact CTA. No superlatives or statistics. Sitemap: 166 indexable URLs. |
