# Acadlytic.com — public website

**Acadlytic, Inc.** · *Where Education Meets Intelligence.*
AI | CRM | Cloud | Academic Management

Server-rendered PHP 8.2+ website for Acadlytic, deployable directly to standard
cPanel shared hosting. No Node.js, build tools, Docker, Redis or background
workers are needed in production.

## At a glance

| | |
|---|---|
| Public pages | 142 indexable URLs (in `sitemap.xml`), plus search, 404 and noindex placeholders |
| Redirects | 61 permanent (301) redirects covering duplicate URLs from the 120+ page build, every Phase 2 handoff URL and legacy `.php` URLs |
| Auth pages | `/login.php` (also `/login/`), `/forgot-password.php`, `/request-access.php` — noindex, not in sitemap |
| Forms | Request a Demo, Contact, Request Access, Password help — CSRF, honeypot, timing check, rate limit, server-side validation |
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
bin/build.php                regenerate stubs, sitemap.xml and icon sprite
bin/qa.php                   quality gate (run before every deploy)
bin/dev-router.php           local dev server router
docs/                        deployment, auth architecture, content guide, placeholders
```

Internal folders (`includes`, `config`, `data`, `seo`, `storage`, `bin`,
`database`, `docs`) are denied over HTTP by the root `.htaccess` and by their
own `.htaccess` files.

## Local development

```bash
php -S localhost:8080 bin/dev-router.php
# open http://localhost:8080/
```

## Editing content

1. Edit or add a page in `data/pages/*.php` (see `docs/CONTENT_GUIDE.md`).
2. `php bin/build.php` — writes stubs for new pages, removes orphans, rebuilds `sitemap.xml`.
3. `php bin/qa.php` — must finish with `0 error(s)`.
4. Commit and deploy.

## Deployment

See **`docs/DEPLOYMENT.md`** for the step-by-step cPanel guide.

## Further reading

- `docs/AUTH_ARCHITECTURE.md` — login UX, what is implemented, how to enable the future auth/CMS
- `docs/HEADER_FOOTER.md` — utility bar, mega menu, footer and governance design
- `docs/PLACEHOLDERS.md` — items Acadlytic must confirm before or after launch
- `docs/QA_REPORT.md` — latest verification results
- `docs/CMS_PHASE3_BLUEPRINT.md` — CMS phase scope
- `docs/handoff/` — original handoff briefs this build integrates

Design quality targets (9.8–10/10) are internal goals. No page or configuration
can guarantee a particular search ranking.
