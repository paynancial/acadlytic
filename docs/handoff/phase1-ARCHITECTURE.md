# Acadlytic.com — PHP SaaS Architecture

## Positioning
**Acadlytic, Inc.** — AI-Powered EdTech CRM & Cloud Platform for Academic Management.
Master tagline: **Where Education Meets Intelligence.**
Toll-free/support: **+91 8010707171**.

## Architecture
- Presentation: semantic HTML5 + PHP server-rendered templates.
- Styling: responsive CSS with design tokens; no framework dependency for the marketing layer.
- Interaction: progressive-enhancement JavaScript.
- Backend target: PHP 8.3+ / PHP-FPM, Composer for dependencies.
- Database target: MySQL 8 / MariaDB with PDO and prepared statements.
- Production: HTTPS, CDN/cache, Brotli/Gzip, WebP/AVIF assets, server-side caching, database indexes, monitoring.
- Application boundary: keep `config/`, `includes/`, logs and secrets outside public exposure where hosting permits.

PHP supports Apache, Nginx/FastCGI and database access through PDO; PHP's official security guidance emphasizes careful configuration and isolation of sensitive server content. See the official PHP manual before production hardening. 

## Recommended production structure
```
public_html/
  index.php
  .htaccess
  robots.txt
  sitemap.xml
  assets/
  pages/
app/
  Controllers/
  Services/
  Repositories/
  Validators/
  AI/
config/
includes/
storage/
  cache/
  logs/
  uploads/
```

For a cPanel deployment, the current starter keeps the marketing site simple and deployable. For the future SaaS application, separate the public marketing site from authenticated product routes and services.

## Homepage information architecture
1. Hero — AI-first value proposition + Request Demo.
2. Trust/credibility strip.
3. One Intelligent Academic Ecosystem.
4. Acadlytic AI — actual workflows, not generic AI claims.
5. Stakeholder solutions: Institutions, Administrators, Faculty, Students, Parents.
6. Measurable outcomes.
7. Security, cloud and integrations.
8. Partner proof/testimonials.
9. Global ecosystem.
10. Conversion CTA.
11. SEO-rich footer.

## 9.8/10 quality gate
This is a design/engineering target, **not a guaranteed Google ranking**. Before launch, require:
- Lighthouse/Core Web Vitals testing on mobile and desktop.
- WCAG 2.2 AA-oriented keyboard, focus, contrast and form checks.
- Unique title/meta/canonical for every indexable page.
- Organization/SoftwareApplication/Breadcrumb/FAQ schema only where accurate.
- XML sitemap + robots.txt + Search Console validation.
- No duplicate, thin or placeholder pages indexed.
- Image dimensions specified; lazy-load below-the-fold media; use WebP/AVIF.
- Critical CSS/HTML rendered immediately; defer non-critical JS.
- HTTPS, secure cookies, CSRF protection, output escaping, prepared SQL statements, rate limiting and upload validation.
- Privacy, Terms, Cookie/consent policy where applicable.
- Real proof only: never publish fabricated institution logos, student counts, uptime or testimonials.
