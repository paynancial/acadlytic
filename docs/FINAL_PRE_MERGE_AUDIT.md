# Final technical pre-merge audit: PR #1

| | |
|---|---|
| Branch | `claude/dazzling-ride-27ugxg` (production review branch, **kept open**) |
| Audit date | 2026-09-24 |
| Environment | PHP 8.4 built-in server via `bin/dev-router.php` (mirrors `.htaccess` routing), Chromium (Playwright), axe-core; CI runs PHP 8.2 / 8.3 / 8.4 |
| Scope | Technical audit only. Legal text was **not** changed. No merge was performed. |

> **Update 24/09/2026:** the five legal pages were approved as-is by Renuka Devi (Director, Acadlytic, Inc.) and published. See `docs/LEGAL_PUBLICATION_AUDIT.md`. Section E below is kept as the pre-approval record.

**TECHNICAL STATUS: READY FOR LEGAL APPROVAL**
**LEGAL STATUS: LEGAL REVIEW REQUIRED — NOT FINAL**
**MERGE STATUS: DO NOT MERGE YET** (explicit owner approval required)

---

## A. PASS

| # | Check | Result and evidence |
|---|---|---|
| 1 | PHP syntax | `php -l` on all 281 PHP files: 0 errors. CI lint green on PHP 8.2, 8.3, 8.4. |
| 2 | Broken links | `bin/qa.php` resolves every internal link, nav link and redirect target: 0 errors. Crawl of all pages: no internal link to a missing page. |
| 3 | Missing pages | 157 registry pages + 69 redirects = 226 URLs: every page 200, every redirect 301 to a live target, no chains. All directory stubs present; `bin/build.php` produces no diff. |
| 4 | Mobile responsiveness | Every page at 360px (and a sample at 390/768px): no horizontal overflow, main CSS applied. |
| 5 | Desktop responsiveness | Every page at 1440px (and a sample at 1024px): no overflow. |
| 6 | Accessibility | axe-core (WCAG 2.0/2.1/2.2 A and AA + best practices) on 35 pages covering every template, the legal drafts, forms, auth pages and 404, at 1440px and 390px: **0 violations**. Single `<h1>` and `lang` on every page. Widget: keyboard reachable, Escape/outside-click close, focus return, dialog focus trap. |
| 7 | SEO metadata | Every page has a `<title>` and meta description; titles and descriptions are unique across all 143 indexable pages. |
| 8 | Canonical URLs | Every indexable page's canonical equals its own absolute `https://acadlytic.com/…/` URL. `www`→apex and HTTP→HTTPS 301 rules in `.htaccess`. |
| 9 | robots.txt | 200 `text/plain`. Allows the site; disallows `/cms/`, `/search/`, `/go/`, `/enquiry/` and future app areas; `Sitemap:` line present. Auth pages crawlable so their `noindex` is seen. |
| 10 | sitemap.xml | Valid XML, 143 URLs = exactly the indexable pages, all `https://`, `lastmod` present. No noindex page listed; **none of the five legal drafts listed**. |
| 11 | Structured data | 143 JSON-LD blocks, all parse. Types: WebSite, WebPage (140), AboutPage, ContactPage, BreadcrumbList (142), FAQPage (126, each matching visible FAQs), Article (25), DefinedTerm (17), Organization (with `sameAs`, PostalAddress, DPO/GRO contact points), LocalBusiness (Patna office), Person (2 directors). No telephone in any schema. |
| 12 | Open Graph | `og:title`, `og:description`, `og:url` (= canonical), `og:image`, `og:type`, `og:site_name`, `og:locale` on every indexable page. |
| 13 | Twitter/X metadata | `twitter:card`, `twitter:title`, `twitter:description`, `twitter:image`, `twitter:site` on every indexable page. |
| 14 | Core Web Vitals risks | Lab run (6 pages, mobile with 4× CPU throttle + slow 4G): LCP ≈ 1.6–1.8s, CLS 0.000. Desktop LCP ≈ 0.2–0.3s. 0 render-blocking scripts, 0 images without dimensions, 0 third-party requests, 9–11 requests per page, fonts self-hosted with preload and `font-display: swap`. See D.3 for DOM size. |
| 15 | Security headers | CSP (`default-src 'self'`, no inline script, hashed critical CSS, `frame-ancestors 'none'`, `form-action 'self'`, `object-src 'none'`), X-Content-Type-Options, Referrer-Policy, X-Frame-Options DENY, Permissions-Policy, COOP; HSTS on HTTPS. `X-Powered-By` **removed during this audit** (PHP `header_remove` + `.htaccess`). |
| 16 | CSRF / form security | Missing or invalid token → 419 (demo, contact, enquiry JSON). Honeypot → silent 303, nothing stored. Submission faster than 3s → silent accept, nothing stored. Rate limit: 6th request/hour → 429. Enquiry endpoints refuse cross-site requests (`Sec-Fetch-Site`/`Origin`) with 403, and GET on `/enquiry/` → 403. Session cookie `HttpOnly; SameSite=Lax` (+`Secure`, `__Host-` on HTTPS), form pages `no-store`, content pages cookie-free. Verified: no records stored by the bot tests. |
| 17 | Input validation | Server-side per-field rules (required, email format, length caps, allowed select values, consent). Tested: empty/invalid → 422 with per-field messages; 500-character name → 422 “under 120 characters”. Client-side validation mirrors the server messages. |
| 18 | Output escaping | Every template output goes through `e()` / `acad_inline()` (which escapes before adding markup), or is built from escaped parts. XSS test: `<script>alert(1)</script>` in a field is re-rendered as `&lt;script&gt;…` (0 raw occurrences). JSON-LD encoded with `JSON_HEX_TAG`. |
| 19 | Enquiry widget | Present exactly once on every public page (not on auth pages). At 1440/1024/768/390/360px: button and panel within viewport and not overlapping; opens by click and keyboard; Escape and outside click close; focus returns; modal empty submit → 3 inline errors; valid submit → “Enquiry received successfully.”; analytics events fire; no console errors. Without JS: plain link to `/core/contact/`. Hidden while the mobile menu is open and in print. |
| 20 | Email CTA | `mailto:info@acadlytic.com?subject=Enquiry%20from%20acadlytic.com`; `email_click` event fires. |
| 21 | WhatsApp CTA | `/go/whatsapp/` → 302 `https://wa.me/918010707171?text=…` (the specified pre-filled message), `no-store`, `noindex`; opens in a new tab with `rel="noopener nofollow"`; `whatsapp_click` event fires. |
| 22 | Mobile number masking | Displayed only as `+91 80••••••71`. The number in any format is absent from all 157 pages, `sitemap.xml`, `llms.txt`, `robots.txt` and all structured data (checked by crawler and by `bin/qa.php`). |
| 23 | +91 8010707171 configuration | Stored only in `config/contact.php` (`CONTACT_PHONE` `+918010707171`, `WHATSAPP_NUMBER` `918010707171`); web access to `config/` is 404. `/go/call/` → 302 `tel:+918010707171`. Changing the number requires editing one file. |
| 24 | Internal linking | No orphan pages. Every indexable page except `/sitemap/` (linked from the footer) has at least one in-content inbound link. Breadcrumbs and related links on every article. |
| 25 | 100+ page architecture | 157 registry pages, 143 indexable, 69 permanent redirects (all legacy, duplicate-intent and alias URLs). Each URL is a directory with a 2-line stub; content in `data/pages/*.php`. |
| 26 | Duplicate / thin content | `bin/qa.php`: no duplicate titles or descriptions, no 90+ character sentence repeated across pages, depth thresholds met. Median main-content length 392 words. See D.1 and D.2 for two short pages. |
| 27 | Planned vs live claims | All product pages carry the *Planned · In development* notice; QA gate fails on present-tense availability claims. `docs/CLAIMS_REGISTER.md` is current (leadership and office rows added). |
| 28 | Unsupported statistics / testimonials / logos | QA gate and a repository scan: no institution counts, uptime figures, outcome percentages, testimonials or customer logos. |
| 29 | 404 handling | Unknown URL → HTTP 404 with a branded page (`noindex, nofollow`, header, footer, widget). Missing trailing slash → 301. `ErrorDocument 404/403 /404.php` in `.htaccess`. |
| 30 | Favicon | `/favicon.ico` 200 (32px), 192px PNG icon, Apple touch icon, `theme-color` on every page. |
| 31 | Header / footer consistency | Exactly one site header, a footer and one widget on every public page. Auth pages use the dedicated auth shell by design. Footer shows email, masked phone and the Patna office; governance links on every page. |
| 32 | Mobile menu | Drawer builds 6 groups / 76 links from the mega-menu markup on first open; reopen works; focus trapped; Escape closes. Without JS the menu button links to `/sitemap/`. |
| 33 | Console errors | None on any page at 360/1440px (plus sample widths). The only error logged was the deliberate 404 probe. |
| 34 | Production configuration | `display_errors` off for web requests, errors logged; auth disabled (`auth.enabled = false`, no fake sign-in); canonical `https://acadlytic.com`; mail notifications to info@acadlytic.com with leads stored first; secrets only in git-ignored `config/local.php`; internal folders and dotfiles/`.md`/`.sql`/`.json`/`.key` files blocked. Deploy zip built from the committed tree passes QA when extracted on its own. |

**Legal-draft controls verified (unchanged by this audit):** Privacy Policy, Terms, Grievance Redressal, Data Protection Officer and Grievance Redressal Officer pages each show **LEGAL REVIEW REQUIRED — NOT FINAL**, are `noindex`, and are excluded from `sitemap.xml` and `llms.txt`. `php bin/qa.php --launch` reports exactly these 5 launch blockers.

## B. FAIL

None open.

Found and fixed during this audit:
- `X-Powered-By: PHP/x.y.z` response header disclosed the PHP version. Fixed with `header_remove('X-Powered-By')` in `includes/security.php` and `Header unset X-Powered-By` in `.htaccess`. Re-tested: header absent, QA 0 errors.

## C. MUST FIX BEFORE MERGE

**Technical: none.**

Merge stays blocked by the non-technical gates:
1. Legal approval of the five legal pages (section E).
2. Explicit owner approval to merge PR #1 into `main`.

## D. SHOULD FIX

1. **`/company/leadership/` is short (≈70 words).** Add the directors' bios (pending from the owner). Indexable and valid, but thin.
2. **`/company/offices/` hub is short (≈126 words) with one office.** Enrich it or add offices as they open. Optionally set `noindex` until a second office exists; the Patna page carries the local SEO value.
3. **DOM size on the homepage ≈1,640 elements** (other pages 1,100–1,300). Lighthouse flags more than ~1,400. Main contributor: mega-menu panels in every page. Option: render mega panels on first hover/focus from a JSON template (as already done for the mobile drawer). Not a blocker: CLS is 0 and LCP is well within limits.
4. **Storage location.** The default `storage/` is inside the web root (protected by `.htaccess`). On production set `storage_path` outside `public_html` in `config/local.php` (`docs/DEPLOYMENT.md` §2).
5. **Verify on the real host** (not testable here): Apache headers and compression, HTTPS/HSTS, `www`→apex redirect, `ErrorDocument`, PHP `mail()` delivery with SPF/DKIM, and the post-upload checklist in `docs/DEPLOYMENT.md` §6.
6. **External profile URLs not verified:** LinkedIn/X/YouTube/Instagram/Facebook company URLs and the directors' LinkedIn URLs (outbound access to these sites was blocked in the audit environment). Open each once before launch.
7. **Real-device and screen-reader checks:** iOS Safari, Android Chrome, and a manual pass with VoiceOver/NVDA.
8. ~~**Rate limit 5 enquiries/hour per IP**~~ Raised to 10/hour (see `SHOULD_FIX_COMPLETION_REPORT.md`).
9. **Open Graph image** is one site-wide image. Optional: section-specific images for better social previews.
10. **Team and News pages** stay `noindex` until real entries are added (by design).

## E. LEGAL BLOCKERS

These must be resolved by legal counsel. Nothing here was invented or changed to look final.

1. **Five draft pages awaiting counsel approval:** `/trust/privacy/`, `/trust/terms/`, `/trust/grievance-redressal/`, `/trust/data-protection-officer/`, `/trust/grievance-redressal-officer/`. They remain `noindex` with the **LEGAL REVIEW REQUIRED — NOT FINAL** marker until approval (`docs/LEGAL_REVIEW_CHECKLIST.md`).
2. **Items counsel must supply** (not stated anywhere on the site): legal entity and registered office, company registration number, governing law and jurisdiction, retention periods, controller/processor roles, sub-processors, hosting location and transfers, children's data, grievance timelines and escalation route.
3. **Enquiry widget and contact channels in the Privacy Policy:** the draft should be reviewed to cover data submitted through the enquiry widget, and that choosing *WhatsApp Us* or *Email Us* hands the visitor to a third-party service (WhatsApp/Meta, the visitor's email provider).
4. **DPO and Grievance Officer details:** Mr. A.K Sinha (dpo@acadlytic.com) and Mrs. Anjali Sharma (gro@acadlytic.com) were supplied by Acadlytic. Besides the draft pages, these names and emails also appear in the site-wide footer, on the Contact page and in the Organization structured data. Counsel should confirm the designations and that publishing them before policy approval is acceptable. Remove them from those places if counsel advises.
5. **Office address:** published as an *office* only. Counsel to confirm whether it is also the registered office or the address for legal notices.
6. **Consent wording** on the enquiry form (“I agree to be contacted by Acadlytic regarding my enquiry.”) should be confirmed against the final Privacy Policy.

## F. SEO BLOCKERS

**None.**

Notes:
- The legal and trust drafts are intentionally `noindex` until approval, so they will not appear in search results yet. This is expected.
- After launch: verify the domain in Google Search Console and Bing Webmaster Tools, submit `sitemap.xml`, and request indexing of the home page.

## G. SECURITY BLOCKERS

**None.** (Version disclosure fixed during the audit; see B.)

## H. PERFORMANCE BLOCKERS

**None.** DOM size is a recommendation (D.3). Field Core Web Vitals should be confirmed on the production host with PageSpeed Insights once live (compression and TTFB depend on the server).

---

### How this audit was run

- `php -l` on every PHP file; `php bin/build.php` (no diff); `php bin/qa.php` (0 errors, 0 warnings); `php bin/qa.php --launch` (5 legal launch blockers, expected).
- HTTP sweep of all 226 page and redirect URLs; blocked-path probes (`/config/`, `/includes/`, `/data/`, `/components/`, `/storage/`, `/bin/`, `/docs/`, `/database/`, `/.git/`, `.md` files).
- Metadata crawler over every page: title, description, canonical, robots, OG, X, JSON-LD parse and types, sitemap and `llms.txt` membership, `<h1>` count, header/footer/widget count, phone-number absence, inbound link graph.
- Browser: every page at 360 and 1440px (sample at 390/768/1024px) for overflow, console errors and failed requests; axe-core on 35 pages at two widths; enquiry widget suite at five widths; mobile drawer test; lab performance run with CPU and network throttling.
- Form security: CSRF, honeypot, timing, validation, length caps, XSS escaping, cross-origin refusal, rate limiting, storage check.
