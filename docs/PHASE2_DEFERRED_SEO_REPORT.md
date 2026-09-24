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

**Update, 24/09/2026:** the owner approved the source list for UGC, NBA, NAAC, the DPDP Act and Rules, and GDPR. The owner then independently verified the final URLs, and the site uses exactly those; see **Approved official sources** below. NEP 2020, ABC and APAAR remain deferred until their own official sources are approved.

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
- **Official source links (24/09/2026):**
  - Contextual links to UGC (credit framework and NAAC), NBA (OBE manual and accreditation programmes), India Code, MeitY and EUR-Lex on 4 pages. They were updated on 24/09/2026 to the 7 owner-verified URLs.
  - Inline external links now open in a new tab with `rel="noopener noreferrer external"` and a screen-reader hint (`includes/blocks.php`).
  - Structured data and `llms.txt` keep plain text.
  - Titles, descriptions, canonicals and H1s unchanged.
  - After the change: QA and `--launch` report 0 errors and 0 warnings; axe finds 0 violations on the 4 pages; no overflow; no orphans.
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

## APPROVED OFFICIAL SOURCES

The source list was approved by the owner on 24/09/2026, and the owner **independently verified** each URL below on the same day. Only these seven URLs are used; no third-party source has been substituted.

**How the links appear:**
- Each link sits inside the relevant sentence; there is no separate references block.
- Links open in a new tab with `rel="noopener noreferrer external"` and a screen-reader “(opens in a new tab)” hint.
- The wording only refers readers to the source (“See the official UGC framework…”, “refer to NBA's current accreditation manual…”, “refer to the UGC information on NAAC”).
- No page states or implies that Acadlytic is endorsed, accredited, certified, partnered with or compliant with any of these bodies or laws.

| # | Authority | Source | URL | Used on | Status |
|---|---|---|---|---|---|
| 1 | University Grants Commission (UGC) | Curriculum and Credit Framework for Undergraduate Programmes (current credit framework) | https://www.ugc.gov.in/KeyInitiative?ID=yiPY1rgAlvz9%2F1chFf86gg%3D%3D | `/glossary/choice-based-credit-system/`: the “Where the framework is set out” section | **VERIFIED** |
| 2 | National Board of Accreditation (NBA) | Manual for UG Engineering, Tier I, 2026 edition (outcome-based accreditation) | https://www.nbaind.org/files/Manual%20for%20UG%20Engineering%20Tier%20I-%202026%20Edition_Format_20260521165316.pdf | `/glossary/outcome-based-education/`: the “Why OBE matters in India” section | **VERIFIED** |
| 3 | UGC, on NAAC | UGC information on the National Assessment and Accreditation Council | https://www.ugc.gov.in/Aboutus/NAAC | `/resources/accreditation-data-guide/`: institutional assessment and accreditation | **VERIFIED** |
| 4 | National Board of Accreditation (NBA) | Accreditation programmes | https://www.nbaind.org/Accreditationprogram | `/resources/accreditation-data-guide/`: program accreditation | **VERIFIED** |
| 5 | India Code | Digital Personal Data Protection Act, 2023 | https://www.indiacode.nic.in/indiacode/handle/123456789/22037?view_type=browse | `/resources/student-data-privacy-guide/`: frameworks table | **VERIFIED** |
| 6 | Ministry of Electronics and Information Technology (MeitY) | Digital Personal Data Protection Rules, 2025 (final rules, not the draft) | https://www.meity.gov.in/documents/act-and-policies/digital-personal-data-protection-rules-2025-gDOxUjMtQWa?pageTitle=Digital-Personal-Data-Protection-Rules-2025 | `/resources/student-data-privacy-guide/`: frameworks table | **VERIFIED** |
| 7 | EUR-Lex | Regulation (EU) 2016/679 (GDPR) | https://eur-lex.europa.eu/legal-content/EN/TXT/?uri=CELEX%3A32016R0679 | `/resources/student-data-privacy-guide/` only: the one page that genuinely discusses GDPR, with applicability tied to territorial scope | **VERIFIED** |

**How each source is applied:**
- **Credit framework:** the CBCS page now points only to UGC's current Curriculum and Credit Framework. The older CBCS guidelines PDF link was removed, because it is not on the verified list and the current framework is preferred.
- **NBA and NAAC are never interchangeable:**
  - The OBE page uses NBA's outcome-based manual.
  - The accreditation guide uses UGC's NAAC information for *institutional* assessment and NBA's accreditation programmes for *program* accreditation, in separate sentences.
- **DPDP Act and Rules:** used only as factual legal references in the privacy guide, which keeps its not-legal-advice note.
- **GDPR:** linked only where the privacy guide explains when it matters, never as a claim about Acadlytic.

**Pages deliberately not linked:**
- `/resources/exam-management-guide/`: exam rules are set by each university or board, and none of the seven sources governs them. The guide keeps its “follow the regulations that apply to your institution” note.
- `/industries/higher-education-india/`: its DPDP mention describes a planned product design. A legal link there could read as a compliance claim.
- FERPA and NIRF: named without links, because they are not on the verified list.

### Link validation

| Check | Result |
|---|---|
| Owner verification of all 7 URLs | **VERIFIED** (owner, 24/09/2026) |
| External source links rendered on the site vs the verified list | **Exact match**: 7 unique source URLs; no extra, missing or leftover unapproved URLs in the page content |
| Earlier URLs replaced (`indiacode.gov.in` home page, `naac.gov.in` home page, `nbaind.org/accreditation`, `/oj/eng` EUR-Lex form, the UGC CBCS PDF, the old CCFUP `.aspx` page) | **Removed**: none remain in `data/` |
| Link attributes | Every source link has `target="_blank" rel="noopener noreferrer external"` and a screen-reader new-tab hint |
| Internal links (full crawl of 179 pages) | **Pass**: 207 unique targets, 205 × 200 and 2 × 302 (the intended call and WhatsApp actions), 0 broken |
| Automated live fetch from the build environment | Not possible: its network policy blocks these domains. This is covered by the owner's independent verification. |

**Content edits with the links** (original wording; nothing copied from official documents; no publication dates added beyond the edition named in the NBA manual's own title):
- The CBCS paragraph now refers to UGC's current framework.
- The OBE sentence directs readers to NBA's manual for how outcomes and attainment are assessed.
- The accreditation paragraph links UGC's NAAC page and NBA's accreditation programmes.
- In the privacy table, the DPDP Act, DPDP Rules and GDPR links were updated to the verified URLs.

## 5. Remaining Phase 2 tasks

1. ~~Browser check of the official links~~: **done**. The owner verified all 7 URLs, and the site now uses exactly those.
2. **NEP 2020, ABC and APAAR sources.** These are still not approved. Once they are, write these pages, each citing its official source, with a *last reviewed* date and a note that policy may change.
3. ~~Official source links for CBCS, OBE, accreditation and privacy~~: **done** (see Approved official sources).
4. **Owner content.** Add the directors' final biographies, genuine Team profiles and News items as the owner supplies them. Team and News become indexable automatically only when real entries exist.
5. **Post-launch measurement** (after deployment approval only). Submit `sitemap.xml` in Google Search Console and Bing Webmaster Tools, then review indexing, queries and click-through for the Phase 2 pages before planning further content.
