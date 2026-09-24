# Pre-launch status

Date: 24/09/2026 · Branch: `claude/dazzling-ride-27ugxg` · PR: [paynancial/acadlytic#1](https://github.com/paynancial/acadlytic/pull/1) (open, draft) · Audited code: 88a34ae, plus a data-only marker on the director profiles (see 2).

This audit changed nothing on the live site. Nothing was merged or deployed, and no content was invented.

## Status summary

| Item | Status |
|---|---|
| **MERGE STATUS** | **WAITING FOR EXPLICIT APPROVAL** |
| **DIRECTOR BIOS** | **PENDING FINAL CONTENT** |
| **TEAM** | **NOINDEX / CONTENT PENDING** |
| **NEWS** | **NOINDEX / CONTENT PENDING** |
| **PHASE 2** | **READY FOR REVIEW** |
| **PHASE 3** | **DOCUMENTATION ONLY** |
| **PRODUCTION DEPLOYMENT** | **WAITING FOR EXPLICIT APPROVAL** |

## 1. Merge

- PR #1 is open and unmerged; it is still a draft.
- CI (lint, generated-files check, QA on PHP 8.2 / 8.3 / 8.4) is green on the latest pushed head, and the PR has no merge conflicts.
- No merge approval has been given. The PR will be merged only on the owner's explicit instruction.

## 2. Directors' biographies

- `/company/leadership/` shows Renuka Devi (Director) and Anisha Bharti (Director), each with their approved photo, LinkedIn link and Person schema. **No biography text is published.**
- Each director profile in `data/people.php` now carries `'bio_status' => 'pending'`, with a comment that bios must not be written, inferred or paraphrased from other sources. This is an internal marker only: the rendered page is byte-identical before and after the change.
- The profile structure is ready: add the approved text as `'bio' => '…'` and remove `bio_status`, and the template renders it under the name and role. Nothing else needs to change.

## 3. Team and News

| Page | Robots | In `sitemap.xml` | In `llms.txt` | Visible content |
|---|---|---|---|---|
| `/company/team/` | `noindex, nofollow` | No | No | “Team profiles are being prepared.” + link to Careers |
| `/company/news/` | `noindex, nofollow` | No | No | “Announcements will be published here as they happen.” + social links |

- Both data sources are empty (`data/people.php` → `team: []`, `data/news.php` → `[]`). There are no fictional people, stories, dates, quotes or achievements.
- The architecture is ready: each page becomes indexable automatically, and joins the sitemap on the next `php bin/build.php`, only once a genuine entry is added.
- *Observation:* both pages remain reachable from the Company menu, the `/company/` hub and the HTML sitemap page, and say plainly that content is being prepared. Hiding them from navigation is optional; tell us if you want it.

## 4. Phase 2

- All 24 SEO Phase 2 pages are intact and indexable (5 comparisons, 9 definitions, 9 guides, 1 India market page). The sitemap has 172 URLs, up from 148. See `docs/SEO_PHASE2_CONTENT_MATRIX.md`.
- No Phase 2 functionality was removed. No Phase 3 application or CMS code was added.

## 5. Phase 3

- Phase 3 exists only as documentation in `docs/architecture/` (12 files, 10 Mermaid diagrams) and `docs/CMS_PHASE3_BLUEPRINT.md`.
- **Phase A, Phase B and CMS development have not started.** There are no backend application modules, database migrations or admin areas. `robots.txt` still disallows the future `/admin/`, `/cms/`, `/student/`, `/faculty/` and `/partner/` paths; none of them exist.

## 6. Production

- The live deployment has not been touched.
- The candidate package `acadlytic-site-88a34ae.zip` was built with `git archive` and passes `php bin/qa.php --launch` (0 errors) when extracted fresh. It will be uploaded only on explicit deployment approval.
- The only change since that zip is the internal `bio_status` marker in `data/people.php`, which has no visible effect. If a new zip is needed at approval time, rebuild it from the approved commit using the steps in `docs/DEPLOYMENT.md`.

## 7. Final QA audit (non-destructive)

Run against the local development server (`php -S … bin/dev-router.php`). No forms were submitted and no emails were sent.

| Area | Check | Result |
|---|---|---|
| PHP syntax | `php -l` on every tracked `.php` file | **Pass**: 305 files, 0 errors |
| Generated files | `php bin/build.php` produces no drift | **Pass**: 0 stubs written, 0 orphans |
| QA gate | `php bin/qa.php` and `php bin/qa.php --launch` | **Pass**: 0 errors, 0 warnings |
| Broken links | Crawled 178 pages (172 sitemap URLs + Team, News, 3 sign-in pages, search); checked every internal `href`/`src` | **Pass**: 206 unique internal targets, 204 × 200, 2 × 302 (the intended `/go/call/` and `/go/whatsapp/` actions), 0 broken |
| Redirects | All 69 legacy URLs in `data/redirects.php` | **Pass**: 69 × 301 → 200 |
| External links | 8 unique: 5 social profiles, 2 director LinkedIn profiles, 1 Google Maps link | Present and correct in markup. **Not fetched**: outbound access is blocked in the audit environment. Open them once manually before launch. |
| SEO metadata | Title, description, OG, X cards, favicon, `lang`, JSON-LD on every page | **Pass**: unique titles and descriptions; 172 pages carry JSON-LD (Article 40, DefinedTerm 25, FAQPage 157, BreadcrumbList 171, LocalBusiness 1, Person 2, Organization, WebSite) |
| Canonicals | Every indexable page | **Pass**: self-referencing `https://acadlytic.com/…` canonical on all 172 |
| Sitemap | `sitemap.xml` | **Pass**: valid XML, 172 `<loc>` entries, served as `application/xml`, equal to the set of indexable pages, no noindex page included |
| robots.txt | Served, syntax, sitemap line | **Pass**: `Allow: /`; disallows `/search/`, `/go/`, `/enquiry/` and future app paths; sign-in pages left crawlable so their `noindex` is read; `Sitemap:` line present |
| noindex rules | Team, News, login, forgot-password, request-access, search, 404 | **Pass**: all `noindex, nofollow`, none in the sitemap. The 404 page returns HTTP 404. |
| Orphans | Pages with no inbound link | **Pass**: none |
| Mobile responsiveness | 177 URLs (172 sitemap + 3 sign-in, search, 404) × 5 widths (360, 390, 768, 1024, 1440px) in Chromium | **Pass**: no horizontal overflow, no console errors or warnings, no page errors, no HTTP errors. One lazy-loaded footer-logo request was cancelled when the test moved to the next page; the file itself returns 200. |
| Accessibility | axe-core, WCAG 2.x A/AA, on 59 pages (the earlier 35-page sample + all 24 Phase 2 pages) | **Pass**: 0 violations |
| Security headers | Response headers | **Pass**: strict CSP (no `unsafe-inline`; critical CSS by hash), `X-Frame-Options: DENY`, `nosniff`, `Referrer-Policy`, `Permissions-Policy`, `Cross-Origin-Opener-Policy`; no `X-Powered-By`; HSTS is sent only over HTTPS (by design); `.htaccess` forces HTTPS |
| Forms | Enquiry and contact posts without a CSRF token | **Pass**: rejected with 419. Honeypot, timing check and a rate limit of 10 per hour are unchanged. |
| Private files | Requests for `.env`, `config/`, `data/`, `includes/`, `storage/`, `.git/`, `composer.json` | **Pass**: 404 on the dev server; `.htaccess` returns 403 for private folders and each folder has its own deny file |
| Performance | 6 key pages; mobile = 4× CPU throttle + slow 4G | **Pass**: mobile LCP 1.72–1.85s; desktop LCP 0.16–0.25s; CLS ≤ 0.001; 0 render-blocking scripts; 0 third-party requests; about 270–295 KB per page |
| Enquiry widget | 7 page types × 6 devices (desktop, laptop, 2 tablets, iPhone 13, Pixel 7) | **Pass**: 42 / 42. The panel opens, the three actions (enquiry, email, WhatsApp) are present, it closes on outside click and Escape, and it goes compact over the footer. The widget appears exactly once per page (QA gate). |
| Footer CTA | “Talk to Acadlytic” in the footer opens the same panel | **Pass**: 42 / 42 (same run) |
| Masked phone number | Rendered HTML of 176 pages; repo files except `config/contact.php` | **Pass**: the full number appears on 0 pages and in no other repository file; `+91 80••••••71` shows on 175 pages (all except the 404); call and WhatsApp work through `/go/` redirects |
| Legal pages | Privacy, Terms, Grievance Redressal, DPO, GRO | **Pass**: indexable and in the sitemap; no “LEGAL REVIEW REQUIRED” banner and no counsel notes; approval recorded in `docs/LEGAL_PUBLICATION_AUDIT.md` (Renuka Devi, Director, 24/09/2026) |
| Planned vs live claims | Planned notice on product pages; claims regex; `docs/CLAIMS_REGISTER.md` | **Pass**: *Planned · In development* notice on 74 / 74 pages under `/platform/`, `/ai/`, `/solutions/`, `/industries/`, `/integrations/`; the QA claims check found no statistics, customer counts, uptime, rankings or superlatives; the only LIVE items in the register are company facts and positioning |

## 8. Items for the owner before launch

1. Approve (or not) the merge of PR #1.
2. Supply the directors' final biographies when ready.
3. Supply genuine Team profiles and News items when available. The pages stay hidden from search engines until then.
4. Give deployment approval, then upload the approved package and check the 8 external links in a browser.
