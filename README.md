# Acadlytic.com — public website

**Acadlytic, Inc.** · *Where Education Meets Intelligence.*
AI | CRM | Cloud | Academic Management

Server-rendered PHP 8.2+ website for Acadlytic, deployable directly to standard
cPanel shared hosting. No Node.js, build tools, Docker, Redis or background
workers are needed in production.

## At a glance

| | |
|---|---|
| Public pages | 148 indexable URLs (in `sitemap.xml`), plus search, 404 and noindex placeholders |
| Redirects | 69 permanent (301) redirects covering duplicate URLs from the 120+ page build, every Phase 2 handoff URL, legacy `.php` URLs and common aliases (`/about-us/`, `/contact-us/`, `/blog/`, `/news/`, `/team/`, `/leadership/`) |
| Auth pages | `/login.php` (also `/login/`), `/forgot-password.php`, `/request-access.php` — noindex, not in sitemap |
| Forms | Request a Demo, Contact, Enquiry (floating widget), Request Access, Password help — CSRF, honeypot, timing check, rate limit, server-side validation |
| AEO | FAQs + FAQPage schema on 130 pages, key takeaways on guides and comparisons, `llms.txt`, visible last-updated dates |
| Contact widget | Floating “TALK TO ACADLYTIC” button on every public page (also opened from the footer CTA): enquiry form (modal), email, WhatsApp. The phone number is never printed in full; see below |
| Assets | Self-hosted Inter + Manrope, one SVG icon sprite, optimised logo (PNG + WebP), no third-party scripts |

## How it works

Every public URL is a real directory containing a two-line `index.php` stub:

```php
require dirname(__DIR__, 2) . '/includes/bootstrap.php';
acad_serve(__DIR__);
```

The stub looks up its own path in the content registry and renders it with the
shared header, footer and templates. Clean URLs therefore work even on hosts
without `mod_rewrite`. **Content lives in `data/pages/*.php`, never in the stubs.**

```
index.php, login.php, forgot-password.php, request-access.php, 404.php
<section>/<page>/index.php   generated stubs (do not edit)
assets/css/main.css          design system
assets/js/app.js             progressive enhancement (menus, drawer, forms)
assets/img/                  logo-acadlytic.png/.webp, logo-square.png, icons.svg, og-image.png
assets/fonts/                Inter + Manrope (SIL OFL)
config/site.php              brand, contacts, social profiles, feature flags
config/contact.php           the ONLY place the phone / WhatsApp number is stored
components/                  contact-widget.php, contact-modal.php ("Talk to Acadlytic" widget)
assets/css/contact-widget.css, assets/js/contact-widget.js   widget styles and behaviour
enquiry/, enquiry/token/     JSON endpoints for the widget form (POST, same-origin)
go/call/, go/whatsapp/       number-free redirects to tel: and wa.me (302, noindex)
data/people.php, data/news.php  leadership/team and news entries (empty until supplied)
config/local.example.php     template for secrets (copy to config/local.php)
data/pages/*.php             all page content (structured blocks)
data/nav.php                 mega menu, footer, login workspaces
data/redirects.php           301 map
data/sections.php            section hubs and labels
includes/                    bootstrap, security, forms, templates, header, footer,
                             utility-bar.php, login-menu.php, auth-shell.php, auth/
seo/meta.php                 titles, meta, Open Graph, X cards, JSON-LD
cms/                         reserved placeholder for the future CMS (returns 404)
database/schema.sql          enquiries + future auth tables (MySQL/MariaDB)
bin/build.php                regenerate stubs, sitemap.xml, llms.txt and icon sprite
bin/qa.php                   quality gate (run before every deploy)
bin/dev-router.php           local dev server router
docs/                        deployment, auth architecture, content guide, placeholders
```

Internal folders (`includes`, `config`, `components`, `data`, `seo`, `storage`,
`bin`, `database`, `docs`) are denied over HTTP by the root `.htaccess` and by their
own `.htaccess` files.

## Contact details and the “Talk to Acadlytic” widget

`config/contact.php` holds `CONTACT_PHONE`, `CONTACT_PHONE_DISPLAY` (masked,
e.g. `+91 80••••••71`), `CONTACT_EMAIL`, `WHATSAPP_NUMBER` and the WhatsApp
pre-filled message. Change the number there only. The full number never
appears in page HTML, `sitemap.xml` or `llms.txt` (`bin/qa.php` checks this):
Call and WhatsApp links point to `/go/call/` and `/go/whatsapp/`, which
redirect server-side. Analytics hooks: the widget dispatches a
`acadlytic:analytics` browser event (and pushes to `window.dataLayer` if one
exists) for `enquiry_widget_open`, `enquiry_form_open`, `enquiry_form_submit`,
`email_click` and `whatsapp_click`; no analytics script is bundled.

## Local development

```bash
php -S localhost:8080 bin/dev-router.php
# open http://localhost:8080/
```

## Editing content

1. Edit or add a page in `data/pages/*.php` (see `docs/CONTENT_GUIDE.md`).
2. `php bin/build.php` — writes stubs for new pages, removes orphans, rebuilds `sitemap.xml`.
3. `php bin/qa.php` — must finish with `0 error(s)`. Before launch run `php bin/qa.php --launch`, which also fails on unapproved legal drafts.
4. Commit and deploy.

## Deployment

See **`docs/DEPLOYMENT.md`** for the step-by-step cPanel guide.

## Further reading

- `docs/AUTH_ARCHITECTURE.md` — login UX, what is implemented, how to enable the future auth/CMS
- `docs/HEADER_FOOTER.md` — utility bar, mega menu, footer and governance design
- `docs/CLAIMS_REGISTER.md` — every public claim: LIVE / PLANNED / REMOVE, with evidence needed
- `docs/LEGAL_REVIEW_CHECKLIST.md` — what counsel must review and complete before launch
- `docs/PLACEHOLDERS.md` — items Acadlytic must confirm before or after launch
- `docs/FINAL_PRE_MERGE_AUDIT.md` — final technical pre-merge audit (PASS/FAIL, blockers)
- `docs/SHOULD_FIX_COMPLETION_REPORT.md` — SHOULD FIX items completed after the audit
- `docs/LEGAL_PUBLICATION_AUDIT.md` — legal pages approval and publication audit
- `docs/CONTACT_WIDGET_QA.md` — "Talk to Acadlytic" widget and footer CTA QA
- `docs/architecture/` — Phase 3 platform architecture: capability matrix, IA, RBAC, multi-tenancy, data, API, AI, security/privacy, infrastructure, roadmap, risks, ADRs
- `docs/QA_REPORT.md` — latest verification results
- `docs/CMS_PHASE3_BLUEPRINT.md` — CMS phase scope
- `docs/handoff/` — original handoff briefs this build integrates

Design quality targets (9.8–10/10) are internal goals. No page or configuration
can guarantee a particular search ranking.
