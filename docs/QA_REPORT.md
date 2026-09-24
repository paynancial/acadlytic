# QA report

Environment: PHP 8.4 CLI + built-in server via `bin/dev-router.php` (mirrors
the `.htaccess` rules), Chromium (Playwright), axe-core. Re-run with
`php bin/qa.php` plus the checks below before each deployment. GitHub Actions
(`.github/workflows/qa.yml`) runs lint, a generated-files check and the QA
gate on PHP 8.2, 8.3 and 8.4 for every push.

## Automated gate: `php bin/qa.php`

**Result: 0 errors, 0 warnings.** 149 registry pages (142 indexable + search,
404, 3 auth pages, 2 noindex placeholders) and 61 redirects.

Checked on every page: exactly one `<h1>`; `<title>` present and unique;
meta description present, unique, 70–170 chars; canonical on indexable pages;
`noindex` on non-indexable pages; every internal link resolves; no duplicate
element IDs; no placeholder text; content depth (≥180 words for articles,
≥100 for glossary); no 90+ character sentence repeated across pages. Also
checked: redirect targets exist with no chains, every directory stub exists,
all navigation links resolve, the sitemap matches the indexable pages, required
assets exist, the icon sprite is current and every referenced icon name exists.
AEO: every FAQ has FAQPage schema; every article page has an FAQ; guides and
comparisons have key takeaways, Article schema and a visible last-updated line;
`llms.txt` lists every indexable page.

## HTTP checks

| Check | Result |
|---|---|
| All 145 page URLs | 200 |
| All 61 redirects | 301 to the correct target |
| `/favicon.ico` | 200 |
| `/llms.txt` | 200 (`text/plain`) |
| `/`, `/login.php`, `/login/`, `/forgot-password.php`, `/request-access.php` | 200 |
| `/assets/css/main.css`, `/assets/js/app.js`, `/assets/img/logo-acadlytic.png` | 200 |
| `/sitemap.xml`, `/robots.txt` | 200 |
| `/config/site.php`, `/includes/bootstrap.php`, `/data/nav.php`, `/storage/` | blocked (404 page) |
| Unknown URL | 404 with branded page |
| Missing trailing slash | 301 to the slash form |
| Security headers | CSP (hash-allowed critical CSS, no inline scripts), X-Frame-Options, Referrer-Policy, Permissions-Policy, nosniff; HSTS on HTTPS |
| Content pages | No cookies set (`Cache-Control: public, max-age=300`) |
| Form and auth pages | Session cookie `HttpOnly; SameSite=Lax` (+`Secure`, `__Host-` prefix on HTTPS), `no-store` |
| PHP warnings or notices in server log | none |
| Storage and mail both failing on submit | 503 with phone/email fallback; failure logged (no silent lead loss) |
| Uncaught exception | branded 500 page, `noindex`, no internals leaked, logged |

## Forms

| Scenario | Result |
|---|---|
| Missing or invalid CSRF token | 419, “session expired” message |
| Honeypot filled or submitted in under 3s | silently accepted, nothing stored |
| Invalid input | 422, error summary + per-field messages with `aria-invalid` / `aria-describedby` |
| Valid demo request | stored (`0600` JSONL, or MySQL), PRG 303, one-time success panel |
| HTML in message | stored as data, escaped on output |
| Login with auth disabled | 503 with an honest “sign-in isn’t open yet” message; password never echoed |
| Login validation | per-field errors |
| Client-side | required and email checks, focus to first invalid field, loading state |

## Browser (Chromium)

- Every page at **360px and 1440px**, and a sample at 390, 768 and 1024px: **no horizontal overflow**, main CSS applied, **no console errors**, no failed requests.
- Mega menu: hover opens and closes; ArrowDown opens and focuses the first link; Up/Down move inside; Left/Right move between menus; Escape closes and restores focus; the blurred backdrop sits below the header.
- **JavaScript disabled:** mega panels still open on hover/focus; the mobile menu button falls back to `/sitemap/`; the drawer accordions use native `<details>`.
- Login popover: opens on click, closes on Escape and outside click.
- Mobile drawer: opens, accordion expands, focus is trapped, Escape closes.
- Password toggle switches field type and label.

## Accessibility (axe-core, WCAG 2.0/2.1/2.2 A & AA + best practices)

14 representative pages (home, hubs, article, comparison, glossary, forms,
auth pages, search, sitemap, privacy) at 1440px and 390px: **no violations**
after fixes (KPI caption contrast, unique landmark names, empty table
headers). Manual review is still recommended with a screen reader (NVDA/VoiceOver).

## Weight (homepage)

| Resource | Gzipped |
|---|---|
| HTML | ~15 KB |
| main.css | ~11 KB |
| app.js | ~3 KB (deferred) |
| Icon sprite | ~2.5 KB (cached) |
| Logo (WebP, 1x/2x) | ~4–8 KB |
| Inter (preloaded) + Manrope | 48 KB + 25 KB (self-hosted, `font-display: swap`) |

No third-party requests. Lighthouse/Core Web Vitals should be measured on the
production host (TTFB and compression depend on the server).

## Not verifiable in this environment

- Apache-specific behaviour (`.htaccess` rewrites, `ErrorDocument`, compression, caching headers). Verify with the checklist in `DEPLOYMENT.md`.
- Email delivery via `mail()` on the production host.
- Real-device testing on iOS Safari and Android Chrome.
