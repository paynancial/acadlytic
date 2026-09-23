# Content guide

## Adding or editing a page

Pages are defined in `data/pages/*.php`, keyed by URL path:

```php
'/platform/example/' => [
    'title'   => 'Example Page Title',          // " | Acadlytic" is appended automatically
    'desc'    => 'Unique meta description, 70–170 characters.',
    'h1'      => 'The single visible page heading',
    'nav_label' => 'Short name',               // breadcrumbs, cards, sitemap
    'lead'    => 'Intro paragraph under the H1.',
    'icon'    => 'chart',                      // optional; see includes/icons.php
    'blocks'  => [
        sec('Heading', 'Paragraph one.', 'Paragraph two with a [link](/platform/).'),
        cards('Heading', ['Card title' => 'Card text', ...], 'Optional intro'),
        steps('Heading', ['Step' => 'Explanation', ...]),
        checks('Heading', ['Item', 'Item']),
        table('Heading', ['Col A', 'Col B'], [['Row', 'Value']]),
        split('Heading', ['Paragraph'], ['Point', 'Point'], 'Panel title'),
        faq(['Question?' => 'Answer.']),
        note('Callout text', 'Label'),
        def('Glossary definition (glossary pages only).'),
    ],
    'related' => ['/platform/admissions-crm/', ...], // contextual internal links
],
```

Optional keys: `parent` (breadcrumb parent), `template` (`article`, `hub`,
`form`, `home`, `search`, `sitemap`), `noindex`, `draft` (visible review
banner), `hide_cta`, `groups` (hub listings), `form` (`demo`, `contact`).

Inline formatting in strings: `**bold**` and `[label](/internal/path/)`.
Everything else is escaped.

Then run `php bin/build.php && php bin/qa.php`.

## Content rules

- One clear search intent per page. If a new page would overlap an existing one, improve the existing page or add a 301 in `data/redirects.php` instead.
- Write for decision-makers and practitioners: specific, practical, plain language.
- **Never publish** unverified customer names, logos, counts, percentages, rankings, awards, certifications, uptime figures, testimonials, partnerships or officer names.
- Product capability statements must match the actual product. See `docs/PLACEHOLDERS.md`.
- `bin/qa.php` flags thin pages, duplicate titles and descriptions, and sentences repeated across pages (a doorway-page signal).

## Structured data

Emitted automatically by `seo/meta.php`: Organization, WebSite and
SoftwareApplication on the homepage; WebPage and BreadcrumbList on every
indexable page; AboutPage or ContactPage plus Organization on About and Contact;
DefinedTerm on glossary pages. No ratings, prices, FAQ rich-result markup or
review markup is emitted.
