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

**Update, 24/09/2026:** the owner approved the source list for UGC, NBA, NAAC, the DPDP Act and Rules, and GDPR. Links are now added; see **Approved official sources** below. NEP 2020, ABC and APAAR remain deferred.

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
  - Contextual links to UGC, NBA, NAAC, India Code, MeitY and EUR-Lex on 4 pages.
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

Approved by the owner on 24/09/2026. Only these authorities are linked; no third-party source was substituted. Links sit in context within the text; there is no separate references block. They open in a new tab with `rel="noopener noreferrer external"` and a screen-reader “(opens in a new tab)” hint. The wording refers readers to each source (“See the official UGC guidelines…”, “refer to the applicable NBA accreditation framework”). Nothing states or implies endorsement, certification, partnership, affiliation or compliance.

| Authority | Source linked | URL | Pages where used |
|---|---|---|---|
| University Grants Commission (UGC) | UGC guidelines on adoption of the Choice Based Credit System | `https://www.ugc.gov.in/pdfnews/9555132_Guidelines.pdf` | `/glossary/choice-based-credit-system/` |
| University Grants Commission (UGC) | Curriculum and Credit Framework for Undergraduate Programmes | `https://www.ugc.gov.in/Curriculum_and_Credit_Framework_for_Undergraduate_Programmes.aspx` | `/glossary/choice-based-credit-system/` |
| National Board of Accreditation (NBA) | NBA accreditation page, which hosts the accreditation manuals | `https://www.nbaind.org/accreditation` | `/glossary/outcome-based-education/` (OBE), `/resources/accreditation-data-guide/` (program accreditation) |
| National Assessment and Accreditation Council (NAAC) | NAAC official website (assessment and accreditation information) | `https://www.naac.gov.in/` | `/resources/accreditation-data-guide/` (institutional accreditation) |
| India Code (Government of India legislation portal) | Digital Personal Data Protection Act, 2023 | `https://indiacode.gov.in/` | `/resources/student-data-privacy-guide/` |
| Ministry of Electronics and Information Technology (MeitY) | Digital Personal Data Protection Rules, 2025 (final, notified November 2025; not the January 2025 draft) | `https://www.meity.gov.in/documents/act-and-policies/digital-personal-data-protection-rules-2025-gDOxUjMtQWa` | `/resources/student-data-privacy-guide/` |
| EUR-Lex (Publications Office of the European Union) | Regulation (EU) 2016/679 (GDPR), official text | `https://eur-lex.europa.eu/eli/reg/2016/679/oj/eng` | `/resources/student-data-privacy-guide/` only, the one page that genuinely discusses GDPR |

**NAAC and NBA are kept distinct.** The accreditation guide now says NAAC assesses and accredits institutions as a whole, while NBA accredits individual programs (mainly technical and professional). Each has its own link.

**Pages deliberately not linked:**
- `/resources/exam-management-guide/`: examination rules are set by each university or board, and no single approved authority applies. The page keeps its “follow the regulations that apply to your institution” note.
- `/industries/higher-education-india/`: its DPDP mention is a planned product design statement. A legal link there could read as a compliance claim.
- FERPA and NIRF: not in the approved list. They are mentioned by name only, without links.

### Link verification

| Check | Result |
|---|---|
| Each URL is on the authority's own official domain (`ugc.gov.in`, `nbaind.org`, `naac.gov.in`, `indiacode.gov.in`, `meity.gov.in`, `eur-lex.europa.eu`) | **Pass** |
| Each URL appears in current search-engine results with the expected official title (for example “UGC GUIDELINES ON ADOPTION OF CHOICE BASED CREDIT SYSTEM”, “National Board of Accreditation”, “NAAC - Home”, “India Code :: Home”, “Digital Personal Data Protection Rules 2025”, “Regulation - 2016/679 - EN - gdpr - EUR-Lex”) | **Pass** |
| DPDP Rules link is the final rules, not the draft | **Pass**: the final-rules page is linked; the separate draft page (`/content/draft-digital-personal-data-protection-rules2025`) is not |
| Live HTTP fetch of each URL | **Not possible from the build environment**: its network policy blocks all seven domains. **Before deployment, open each link once in a browser**, or allow the domains in the environment's network settings so the check can be automated. |

**Why some links go to a home or landing page rather than a deep link:**
- **India Code** moved from `indiacode.nic.in` to `indiacode.gov.in`. The Act's old deep link could not be confirmed on the new site, so the page links to the India Code home page, from which the Act can be found by name. Replace it with the Act's direct `indiacode.gov.in` URL once confirmed in a browser.
- **NAAC**: the assessment-and-accreditation deep page is published only over `http://`. The site's link policy allows only `https://` external links, so the page links to NAAC's official `https://` home page.
- **NBA**: the accreditation page is linked rather than a single manual PDF, so the link stays valid when NBA revises its manuals.

**Content changes made with the links** (original wording; nothing copied from the official documents; no publication dates added):
- **CBCS:** new H2, “Where the framework is set out”.
- **OBE:** one sentence on NBA's outcome-based assessment.
- **Accreditation guide:** the NAAC/NBA paragraph was rewritten to separate the two bodies.
- **Privacy guide:** the DPDP Act and GDPR table rows were expanded.

## 5. Remaining Phase 2 tasks

1. **Link check in a browser.** Open the seven official links once, since the build environment cannot fetch them. Replace the India Code home-page link with the Act's direct URL when you confirm it.
2. **NEP 2020, ABC and APAAR sources.** These are still not approved. Once they are, write these pages, each citing its official source, with a *last reviewed* date and a note that policy may change.
3. ~~Official source links for CBCS, OBE, accreditation and privacy~~: **done** (see Approved official sources).
4. **Owner content.** Add the directors' final biographies, genuine Team profiles and News items as the owner supplies them. Team and News become indexable automatically only when real entries exist.
5. **Post-launch measurement** (after deployment approval only). Submit `sitemap.xml` in Google Search Console and Bing Webmaster Tools, then review indexing, queries and click-through for the Phase 2 pages before planning further content.
