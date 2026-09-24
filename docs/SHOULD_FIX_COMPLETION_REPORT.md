# SHOULD FIX completion report: PR #1

| | |
|---|---|
| Date | 2026-09-24 |
| Scope | Technical SHOULD FIX items from `docs/FINAL_PRE_MERGE_AUDIT.md` (section D), plus the favicon crop fix requested by Acadlytic |
| Legal status | Unchanged. Privacy, Terms, Grievance Redressal, DPO and Grievance Redressal Officer pages remain marked **LEGAL REVIEW REQUIRED — NOT FINAL** and `noindex`. |
| Merge | Not merged. PR #1 remains open. |

## Items fixed

### 1. Page size: mega menu loaded on demand (audit D.3)

- **Change:** each mega-menu panel's markup now ships inside a `<noscript>` element in its panel. Without JavaScript the browser renders it normally, so the CSS hover/focus menus still work with no JS. With JavaScript it is inert text and only becomes DOM when a visitor first hovers, focuses or clicks that menu. The mobile drawer reads links from a detached copy and never inserts the desktop panels.
- **Files:** `includes/header.php`, `assets/js/app.js`, `assets/css/main.css`
- **Impact (DOM elements):**

| Page | Before | After |
|---|---|---|
| Homepage | 1,637 | **1,064** (−35%) |
| Product page (`/platform/admissions-crm/`) | 1,267 | **694** (−45%) |
| Guide (`/resources/academic-crm-guide/`) | 1,301 | **728** |
| Leadership | 1,111 | **572** |
| Contact | 1,205 | **632** |

Every page is now below Lighthouse's ~1,400-element DOM warning.
- **Verified:** hover and click open the full panel (14 links in Solutions); ArrowDown focuses the first link, arrows move within it, Escape closes it and returns focus; with JS disabled the panels still open on hover (13 links in AI); the mobile drawer still builds 6 groups / 76 links; links remain in the HTML source for crawlers; no console errors.

### 2. Offices page strengthened (audit D.2)

- **Change:** `/company/offices/` now has a *Where to find us* section with an at-a-glance list, *Ways to meet the team* (online demo, discovery call, office meeting, partnership conversation), *Arranging an in-person visit* steps and an FAQ with FAQPage schema. It uses only confirmed facts: Patna office address, visits by appointment, info@acadlytic.com.
- **Files:** `data/pages/80-company.php`
- **Impact:** ≈126 → **381** words of main content, plus FAQ rich-result eligibility.

### 3. Leadership page strengthened (audit D.1, partial)

- **Change:** added a *Leading Acadlytic* section and an FAQ (who leads Acadlytic, how to contact the leadership team, where Acadlytic is based), using only supplied facts: the two directors, their titles, the office and the contact email.
- **Files:** `data/pages/80-company.php`
- **Impact:** ≈70 → **214** words, plus FAQPage schema. Individual bios remain pending from Acadlytic (see *Remaining*).

### 4. Duplicate code removed

- **Change:**
  - The `<head>` block, previously duplicated in the site and auth shells, is now `acad_head_common()`.
  - The logo markup, duplicated in three places, is now `acad_logo_html()`.
  - The enquiry widget's copy of the inline field-error routine now uses the shared `AcadlyticForms.fieldError` from `app.js`.
  - The mega-menu source lookup is shared by `hydrateMega()` and `megaContent()`.
- **Files:** `includes/render.php`, `includes/header.php`, `includes/footer.php`, `includes/auth-shell.php`, `assets/js/app.js`, `assets/js/enquiry-widget.js`
- **Impact:** one source of truth for head tags, logo and form errors; about 50 fewer lines. The widget's empty-submit inline errors (3) and success flow were re-tested.

### 5. CSS/JS and asset optimisation

- **Change:** removed the only unreferenced CSS rule set (`.human-note`). A static scan found all other 328 classes in use.
- **Files:** `assets/css/main.css`
- **Measured, not changed:**
  - CSS minification would save only ~0.9 KB gzipped and would need a build step in production.
  - Palette-compressing the PNGs showed visible grain in the brand gradient. These files are not on the page-render path (social preview, schema and home-screen icons only), so they were left untouched to protect the approved branding.

### 6. Favicon: re-cropped from Acadlytic's supplied mark and fully integrated

- **Problem:** the previous icons were cut from the banner and included a sliver of the next letter at the right edge.
- **Change:** all icons are regenerated from Acadlytic's supplied transparent cut-out (`docs/references/logo-mark-cropped-source.png`), centred with even padding:
  - `favicon.ico` (16/32/48, transparent)
  - `assets/img/favicon-32.png`
  - `icon-192.png`, `icon-512.png` and `icon-maskable-512.png` (safe-zone padding)
  - `apple-touch-icon.png` (180)
  - `logo-square.png` (512, used in Organization and LocalBusiness schema)
- **New `site.webmanifest`:** name, theme colour and icons.
- **Head tags on every page:** `.ico`, 32px PNG, 192px PNG, Apple touch icon and manifest, all cache-busted.
- **`.htaccess`:** served with the correct MIME types (`application/manifest+json`, `image/x-icon`).
- **QA:** `bin/qa.php` now requires every icon file.
- **Files:** `favicon.ico`, `assets/img/*.png` (icons), `site.webmanifest`, `includes/render.php`, `.htaccess`, `bin/qa.php`
- **Verified:** all icon URLs return 200 with correct types; the mark is legible at 16px on light and dark browser tabs.

### 7. Enquiry rate limit (audit D.8)

- **Change:** 5 → **10** submissions per connection per hour, to avoid blocking several people on one campus network. Bots are still stopped by CSRF, honeypot and timing checks.
- **Files:** `config/site.php`

### 8. Security hardening carried from the audit

- `X-Powered-By` removal (audit section B) is confirmed still in place.

## Re-verification after all changes

| Check | Result |
|---|---|
| PHP lint | 0 errors across all PHP files |
| `bin/build.php` | no drift in generated files |
| `bin/qa.php` | **0 errors, 0 warnings** |
| `bin/qa.php --launch` | 5 launch blockers, exactly the 5 legal drafts (expected) |
| HTTP | 226/226 page and redirect URLs return 200/301; unknown URL returns 404 |
| Internal links | no broken links, no orphan pages |
| SEO | unique titles and descriptions; canonical = own URL; OG and X tags complete; 143 valid JSON-LD blocks (FAQPage now on 128 pages); sitemap = 143 indexable pages; legal drafts absent from sitemap and `llms.txt` |
| Accessibility | axe-core on 35 pages at 1440px and 390px: **0 violations** |
| Responsive | every page at 360px and 1440px (sample at 390/768/1024): no overflow, no console errors |
| Security | CSRF 419, honeypot and timing silent-accept, validation 422, cross-origin 403, rate-limit 429, no `X-Powered-By`, headers unchanged |
| Enquiry widget | 5 widths: open/close, Escape, outside click, focus return, 3 inline errors on empty submit, success on valid submit, analytics events, no console errors |
| Phone masking | number absent from all pages, sitemap, `llms.txt` and schema; `/go/call/` → `tel:+918010707171`; `/go/whatsapp/` → `wa.me/918010707171` with pre-filled message |
| Performance (lab) | mobile (4× CPU, slow 4G) LCP 1.65–1.83s, CLS 0; desktop LCP ≈0.2s; 0 render-blocking scripts, 0 third-party requests |

## Remaining

| Item | Why it remains | Owner |
|---|---|---|
| Directors' individual bios | Must come from Acadlytic (LinkedIn could not be read from this environment) | Acadlytic |
| Team and News pages | `noindex` until real entries are supplied | Acadlytic |
| Storage outside the web root | Server setting: set `storage_path` in `config/local.php` on the host (`docs/DEPLOYMENT.md` §2) | Host / deployer |
| Production-host checks | Apache headers and compression, HTTPS/HSTS, mail delivery (SPF/DKIM), real-device and screen-reader tests, external profile URLs | Deployer |
| Section-specific social images | Optional enhancement | Optional |
| All legal items | See `docs/FINAL_PRE_MERGE_AUDIT.md` section E | Legal counsel |

## Final technical status

**TECHNICAL CHANGES COMPLETE — PR REMAINS OPEN — DO NOT MERGE.**

Legal status: **LEGAL REVIEW REQUIRED — NOT FINAL**.
