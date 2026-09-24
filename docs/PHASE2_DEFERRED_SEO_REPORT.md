# Phase 2: deferred SEO work

Date: 24/09/2026 · Branch: `claude/dazzling-ride-27ugxg` · PR: [paynancial/acadlytic#1](https://github.com/paynancial/acadlytic/pull/1) (open, unmerged)

Scope: Phase 2 website content only. No merge, no deployment, no Phase A, Phase B or CMS work. Team and News stay `noindex`.

## Final status

| Item | Status |
|---|---|
| **PHASE 2 SEO** | **IN PROGRESS** |
| **MERGE** | **NOT APPROVED** |
| **DEPLOYMENT** | **NOT APPROVED** |
| **PHASE A** | **NOT STARTED** |

## 1. Pages completed

| URL | Primary intent | Type | Parent | Internal links (out → in) | Index | Status |
|---|---|---|---|---|---|---|
| `/resources/exam-management-guide/` | “exam management in colleges” / examination process good practice | Guide | `/resources/guides/` | Out: academic operations, attendance guide, accreditation guide, OBE, retention strategies. In: guides hub, `/platform/academic-operations/`, attendance guide, accreditation guide | index | **Published** |

**What the page covers.** The stages of the exam cycle (schedule, eligibility, paper security, seating and invigilation, evaluation and moderation, verification and approval, re-evaluation requests), common problems and how to prevent them, and recording marks so the same data supports OBE attainment and accreditation.

**What it deliberately does not do.** It makes no claims about NEP 2020, the Academic Bank of Credits, APAAR, UGC or university regulations, or any government requirement. A *Scope* note tells readers that rules differ between universities and boards and that they must follow the regulations that apply to them. Acadlytic's exam capabilities are described only as **planned**.

**How it differs from existing pages.** `/platform/academic-operations/` lists planned product capabilities. This guide explains the process and record-keeping practice, whatever software is used.

## 2. Pages deferred

| Proposed page | Reason deferred | Unblocked by |
|---|---|---|
| NEP 2020 overview for institutions | Policy detail and its implementation status change; stating it wrongly would mislead institutions | Owner-approved official source list (see 3) |
| Academic Bank of Credits (ABC) definition or guide | Operational rules and eligibility are set by official bodies and revised over time | Same |
| APAAR ID definition or guide | Government identifier: purpose, consent and process must be stated exactly as officially published | Same |
| Any other regulation-specific page (e.g. a standalone DPDP Act guide, NAAC/NBA criteria pages) | Legal and regulatory accuracy risk. These topics are covered only at framework level, with a not-legal-advice note | Same, plus legal review for DPDP |

No city or location pages, “best/top” lists or brand-vs-brand pages are planned (rejected in the content matrix).

## 3. Sources required

**To unblock the deferred pages**, the owner should provide or approve the official source for each, as a specific document or page URL with its date or version:

| Topic | Authoritative source to approve |
|---|---|
| NEP 2020 | The National Education Policy 2020 document published by the Ministry of Education, Government of India |
| Academic Bank of Credits | The ABC regulations and guidance published by the University Grants Commission (UGC) and the official ABC portal |
| APAAR ID | Official Ministry of Education guidance on APAAR, including its consent process |
| CBCS (existing page) | Current UGC guidelines on CBCS / the current credit framework |
| NAAC / NBA (existing pages) | The current NAAC manual and the current NBA accreditation documents |
| DPDP Act (existing privacy guide) | The Digital Personal Data Protection Act, 2023, and rules made under it, as published by the Government of India |

**Existing pages that already name authoritative bodies.** These pages attribute their statements to the named body and tell readers to check current regulations, but they do not yet link to official URLs:
- `/glossary/choice-based-credit-system/` (UGC; tells readers to follow current UGC regulations and university ordinances)
- `/glossary/outcome-based-education/` (NBA)
- `/resources/accreditation-data-guide/` (NAAC, NBA, NIRF; tells readers to work from the accrediting body's current manual)
- `/resources/student-data-privacy-guide/` (DPDP Act 2023, FERPA, GDPR/UK GDPR; not-legal-advice note)

Official links were **not added**. This environment cannot reach external sites, so the URLs could not be verified, and an unverified link is worse than none. Once you approve the URLs in the table above, they can be added as “Official source” links on these pages. Each link will open in a new tab with `rel="noopener noreferrer external"`.

## 4. SEO changes made

- **New page:** `/resources/exam-management-guide/`, with:
  - a unique title (“Exam Management in Colleges: A Practical Guide”, 58 characters before the site suffix);
  - a unique 150-character meta description;
  - a self-referencing canonical;
  - one H1 and seven H2 sections;
  - OG and X tags;
  - Article + FAQPage + BreadcrumbList schema;
  - takeaways and a genuine three-question FAQ;
  - the contact CTA.
- **Hubs:** added to `/resources/guides/` (the `$guides` list).
- **Internal links:** contextual related links added from `/platform/academic-operations/`, `/resources/attendance-management-guide/` and `/resources/accreditation-data-guide/`.
- **Generated files:** new directory stub, `sitemap.xml` (173 URLs) and `llms.txt` regenerated by `php bin/build.php`.
- **Documentation:** `docs/SEO_PHASE2_CONTENT_MATRIX.md` updated. The exam guide moved from *Deferred* to *Published*, and a validation row was added.
- **Validation:**
  - `php bin/qa.php` and `--launch` report 0 errors and 0 warnings.
  - The metadata audit finds unique titles and descriptions and no orphans.
  - axe-core: 0 violations.
  - No horizontal overflow at 320–1440px.
  - The claims check flags nothing: no statistics, customers, testimonials, partnerships or superlatives.
- **Unchanged:**
  - Team and News stay `noindex, nofollow` and out of the sitemap.
  - All 24 earlier Phase 2 pages are intact.
  - The legal pages were not edited.
  - No application or CMS code was added.

## 5. Remaining Phase 2 tasks

1. **Source approval.** The owner provides or approves the official source list in section 3.
2. **Regulatory pages.** Once sources are approved, write NEP 2020, ABC and APAAR pages, each citing its official source, with a *last reviewed* date and a note that policy may change.
3. **Official source links.** Add the approved links to the CBCS, OBE, accreditation and privacy pages.
4. **Owner content.** Add the directors' final biographies, genuine Team profiles and News items as the owner supplies them. Team and News become indexable automatically only when real entries exist.
5. **Post-launch measurement** (after deployment approval only). Submit `sitemap.xml` in Google Search Console and Bing Webmaster Tools, then review indexing, queries and click-through for the Phase 2 pages before planning further content.
