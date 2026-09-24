# Legal pages: publication audit

| | |
|---|---|
| Date | 24/09/2026 |
| Approved by | Renuka Devi (Director, Acadlytic, Inc.) |
| Approval date | 24/09/2026 |
| Scope of approval | Existing wording of all five pages, approved as-is |
| Merge | **Not merged.** PR #1 remains open until the owner explicitly approves the merge. |

## Pages published

| Page | URL |
|---|---|
| Privacy & Data Protection | `/trust/privacy/` |
| Terms of Use | `/trust/terms/` |
| Grievance redressal process | `/trust/grievance-redressal/` |
| Data Protection Officer | `/trust/data-protection-officer/` |
| Grievance Redressal Officer | `/trust/grievance-redressal-officer/` |

## What changed

The approved wording was kept exactly. Only the temporary review scaffolding was removed:

- the visible **LEGAL REVIEW REQUIRED — NOT FINAL** notice and its HTML comment (`'legal_draft' => true` removed from all five pages);
- the *For legal counsel to complete* lists on Privacy, Terms and Grievance redressal (`counsel_items` removed);
- the sentence “This section is subject to legal review.” at the end of the *Your rights* table note on the Privacy page. The rest of that note, “Which of these rights apply depends on the law that applies to you.”, is unchanged.

Nothing was added. The approval covered the existing wording as-is, so these items remain **unstated** on the site: legal entity and registered office, company registration, governing law and jurisdiction, legal bases, retention periods, sub-processors, hosting location and transfers, children's data, controller/processor roles, grievance timelines and escalation authority. Adding any of them needs a new approval (see `docs/LEGAL_REVIEW_CHECKLIST.md`).

DPO (Mr. A.K Sinha, dpo@acadlytic.com) and Grievance Redressal Officer (Mrs. Anjali Sharma, gro@acadlytic.com) details are unchanged and as supplied by Acadlytic.

## Audit results

| Check | Result |
|---|---|
| Review wording removed | No page contains “LEGAL REVIEW REQUIRED”, “For legal counsel to complete” or “subject to legal review” (crawl of all 157 pages) |
| Indexing | All five pages `index, follow`, self-referencing canonical, OG and X tags present |
| Sitemap / `llms.txt` | All five listed; sitemap now 148 URLs (was 143) |
| Structured data | WebPage + BreadcrumbList (+ FAQPage where the page has FAQs) on each page, all valid JSON |
| `php bin/qa.php` | 0 errors, 0 warnings |
| `php bin/qa.php --launch` | **0 errors** (previously 5 legal launch blockers) |
| PHP lint | 0 errors |
| HTTP | 226/226 page and redirect URLs return 200/301 |
| Accessibility | axe-core on the five legal pages and `/trust/` at 1440px and 360px: 0 violations |
| Layout | No horizontal overflow at 1440px or 360px; no console errors |
| Phone masking | Number absent from all pages, sitemap and `llms.txt` |
| Internal links | No broken links, no orphan pages |

## Recommendations (not blocking)

- Consider showing an *Effective date* or *Last updated* line on the legal pages. It would need to be approved wording, so it was not added.
- Keep the approval record in `docs/LEGAL_REVIEW_CHECKLIST.md` current whenever these pages change.

**TECHNICAL STATUS: READY** · **LEGAL STATUS: APPROVED (24/09/2026)** · **MERGE STATUS: DO NOT MERGE UNTIL EXPLICIT OWNER APPROVAL**
