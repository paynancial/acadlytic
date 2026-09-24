# Pre-merge production audit: Acadlytic.com (PR #1)

Scope: every file in the PR: 145 page entry points, 61 redirects, templates,
includes, security, forms, auth shell, assets, `.htaccess`, `robots.txt`,
`sitemap.xml` and docs. Method: automated gate (`bin/qa.php`), a structural
audit script (heading hierarchy, alt text, OG/X tags, handoff-URL coverage),
HTTP checks of every URL, Chromium at 360–1440px, axe-core (WCAG 2.x A/AA),
forced-failure tests of forms and error handling, and manual code review.

## 1. Page architecture

- **All 128** URLs from the 120+ page build, **all 63** Phase 2 URLs (60 content pages + hubs + demo) and **all 9** Phase 1 legacy URLs resolve to a live page or a 301. None 404.
- 142 indexable pages, each with its own `index.php` entry point, plus the auth pages, search and 404.
- Duplicates handled by 301 to one canonical page: `/platform/platform/`, `/core/platform/`, `/core/ai-platform/`, `/resources/resources/`, `/company/company/`, `/company/resources-center/`, `/resources/crm-vs-erp/`, `/industries/universities|colleges/` and, in this audit, **`/ai/ai-automation/` → `/ai/ai-workflows/`** (the two targeted the same intent).
- Breadcrumbs (visible and BreadcrumbList schema) on every page except the homepage.

### Phase 2 classification

| Type | Pages |
|---|---|
| Core commercial | `/`, `/platform/`, `/core/academic-management/`, `/core/edtech-crm/`, `/core/cloud-platform/`, `/core/pricing/`, `/company/request-demo/`, `/core/contact/` |
| Feature | 18 `/platform/*` modules, 11 `/ai/*` capabilities + AI Assistant |
| Solution | 15 `/solutions/*` (roles and institution types), 8 `/industries/*` |
| Integration | 13 `/integrations/*` |
| Resource | 16 guides, articles and checklists, plus FAQs and 3 hubs |
| Glossary | 17 terms + hub |
| Comparison | 7 + hub |
| Company / trust | About, careers, partners, press, support, Trust Center, security, privacy, terms, accessibility, grievance redressal |

Case studies and whitepapers are **noindex placeholders**. They are not in the sitemap and are clearly labelled.

## 2–3. SEO and content

- Unique `<title>` and meta description on every page (verified), one `<h1>`, no skipped heading levels inside `<main>`, canonical on every indexable page, OG + X card on every page.
- JSON-LD: Organization (with the five official `sameAs` profiles) and WebSite on the homepage; WebPage and BreadcrumbList site-wide; AboutPage/ContactPage; DefinedTerm on glossary pages. **Removed in this audit:** `SoftwareApplication`, because Google expects offers/ratings that cannot be stated truthfully, which would show as Search Console errors. No FAQ, review or rating markup.
- No sentence of 90+ characters appears on more than one page. No fabricated customers, statistics, testimonials, certifications or officer names. The homepage dashboard preview is labelled *Sample data*.
- Remaining **topic clusters to monitor** for cannibalisation (currently differentiated by intent): automation (feature, AI workflows, strategy guide, worked example, glossary) and analytics (guide, culture article, governance article, dashboard guide).

## 4. Performance

- No third-party requests. Fonts are self-hosted with `font-display: swap`; **both fonts are now preloaded** (Manrope renders the H1, the likely LCP element).
- One render-blocking stylesheet (~11 KB gz) behind inlined critical header CSS; one deferred script (~3 KB gz); an icon sprite instead of an icon font; ~15 KB gz homepage HTML.
- The only raster image above the fold is the 8 KB WebP logo with explicit dimensions. The site has no other content images, so there is nothing to lazy-load.
- Core Web Vitals must still be measured on the production host (TTFB, compression).

## 5. Accessibility

axe-core: **0 violations** on 14 representative pages at 1440 and 390px. Skip
link, visible focus, keyboard-operable menus/popover/drawer, labelled forms
with linked errors and an error summary, reduced-motion support, and
`lang="en-IN"` to match the site's Indian English spelling.

## 6. Security

- Output escaped via `e()`. Content strings allow only `**bold**` and internal-link syntax.
- CSRF on every POST form; honeypot; signed timing token; per-IP rate limits; login throttling; hardened session cookies.
- CSP with no inline script and hash-allowed critical CSS; X-Frame-Options, Referrer-Policy, Permissions-Policy, nosniff. **HSTS no longer sends `includeSubDomains`**, which could break any future non-HTTPS subdomain.
- No uploads, no user-controlled includes (template names come from the registry and pass through `basename`), no secrets in the repository (`config/local.php` is git-ignored).
- Internal folders are denied by the root `.htaccess` and per-folder `.htaccess` files. Dotfiles, `.md`, `.sql`, `.json`, `.log` and `.key` files are blocked.
- **Added in this audit:** a global exception handler serves a branded, `noindex` 500 page without internals and logs the error.

## 7–9. Conversion, branding, responsive

- Primary CTA *Request a Demo* appears in the header, heroes and closing band; *Talk to Our Team* is secondary; the phone number is in the utility bar, footer, contact aside and error states. There are no pop-ups.
- Brand strings are consistent: *Acadlytic, Inc.*, *Where Education Meets Intelligence.* and *AI | CRM | CLOUD | ACADEMIC MANAGEMENT*. No alternate slogans; the old-tagline logo file is archived, not used.
- Verified in Chromium at 360, 390, 768, 1024 and 1440px: no horizontal overflow; drawer, tables and forms adapt. Real iOS and Android devices not yet tested.

## 10–11. Links and sitemap

- Every internal link on every page resolves; trailing slashes are consistent; canonicals use `https://acadlytic.com`; all assets return 200.
- `sitemap.xml` holds exactly the 142 indexable canonical URLs: no auth, search, 404, placeholder, admin or redirect URLs. `lastmod` is now deterministic, so CI can verify the committed file.

## 13. Production readiness

PHP lint clean. Includes are resolved from `ACAD_ROOT`; assets use root-relative
versioned paths; `.htaccess`, 404 page, **favicon.ico (added)**, sitemap, robots,
forms, header, footer and mobile menu all verified.
**GitHub Actions (added)** runs lint, a generated-files check and the QA gate on
PHP 8.2, 8.3 and 8.4.

## 14. Scores (out of 10)

| Area | Score | Why not higher |
|---|---:|---|
| UI/UX | 8.8 | Strong navigation and flows; no real product screenshots yet |
| Visual design | 8.6 | Cohesive system; illustrations are CSS/SVG, not real imagery |
| SaaS positioning | 8.8 | Clear enterprise AI-EdTech story; lacks verified proof |
| SEO architecture | 9.2 | Clean clusters and hubs; some clusters need monitoring |
| Technical SEO | 9.3 | Complete metadata, schema and sitemap; not yet validated in Search Console |
| Performance | 8.8 | Lean by design; unmeasured on the production host |
| Accessibility | 8.9 | Automated scans clean; manual screen-reader pass pending |
| Security | 9.0 | Strong defaults; `.htaccess` must be verified on the real host |
| Mobile experience | 8.8 | Verified in an emulator; real-device pass pending |
| Conversion | 8.4 | Clear CTAs; no customer proof, case studies or floating contact |
| Content quality | 8.3 | Unique and useful; product claims await owner verification |
| **Overall production readiness** | **8.6** | Code is ready; launch depends on the owner items below |

The 9.8–10 aspiration is reachable mainly through things only Acadlytic can
supply: verified proof, real product screenshots and confirmed capabilities.

## A. Critical: must fix

| # | Issue | Status |
|---|---|---|
| A1 | Enquiries silently lost (visitor told “thank you”) when storage is unwritable and `mail()` fails | **Fixed**: 503 with phone/email fallback, logged; forced-failure test passes |
| A2 | **Owner:** confirm every product, integration and security capability claim, or reword it as roadmap | Open, **launch blocker** (`docs/PLACEHOLDERS.md`) |
| A3 | **Owner:** legal review of Privacy, Terms and Grievance drafts (banners are visible) | Open, **launch blocker** |
| A4 | Support and sender mailboxes | **Resolved**: Acadlytic confirmed `info@acadlytic.com` for support, account help and notifications. Verify SPF/DKIM in cPanel at deploy. |

## B. High priority: should fix

1. On deploy, set `storage_path` outside `public_html` (`docs/DEPLOYMENT.md` §2).
2. Run the post-upload checklist on the real Apache/LiteSpeed host: blocked folders, HTTPS/www redirects, compression.
3. Measure Lighthouse/Core Web Vitals on production and fix what shows up.
4. Manual screen-reader pass (NVDA + VoiceOver) and real iPhone/Android testing.
5. The Forgot Password success text says “Check your inbox”, as the brief specified, but resets are staff-assisted until self-service reset ships. The panel explains this; keep or soften.
6. Confirm the number's “toll-free” status before labelling it so; it is shown as *Phone*.

## C. Recommended

- Minify `main.css`; add metric-matched font fallbacks to reduce layout shift.
- Unobtrusive floating contact button (from the Phase 1 brief).
- Official SVG logo; real product screenshots on feature pages.
- Monitor the automation and analytics clusters in Search Console; consolidate if they cannibalise.

## D. Nice to have

- Verified case studies and whitepapers (replace the placeholders).
- Hindi or regional-language versions of key pages.
- Privacy-friendly, first-party analytics.

---

## PHASE 2 PRE-MERGE APPROVAL REPORT

**Code:** all code-level must-fix items are resolved. QA gate: 0 errors,
0 warnings; 206 URLs verified; browser, accessibility and forced-failure tests
pass; CI added for PHP 8.2–8.4.

**Remaining blockers (content, owner action required):**
1. Confirm product, integration and security capability claims (A2).
2. Legal sign-off on Privacy, Terms and Grievance pages (A3).

A4 (mailboxes) is resolved: everything uses `info@acadlytic.com`.

**Recommendation:** merge once CI passes on PR #1 and the owner accepts that A2–A3
are pre-**launch** items (merging to `main` does not publish the site).
Otherwise, hold the merge until A2–A4 are signed off.
