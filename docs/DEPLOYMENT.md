# Deploying to cPanel

## Requirements

- PHP **8.2 or 8.3** (MultiPHP Manager). Extensions: `mbstring`, `json`, `session`, `openssl`/`random` (all standard). `pdo_mysql` only if you use a database.
- Apache with `.htaccess` enabled (standard on cPanel). `mod_rewrite`, `mod_headers`, `mod_deflate` and `mod_expires` are used when available; the site still works without them.
- HTTPS (AutoSSL / Let’s Encrypt in cPanel).

## 1. Upload

Upload the **contents** of the repository into `public_html/` so that
`public_html/index.php`, `public_html/.htaccess` and `public_html/assets/` exist.
Do not nest the project inside an extra folder.

> Hidden files: make sure your upload includes `.htaccess` files (enable “Show
> Hidden Files” in File Manager). Every internal folder ships with its own
> `.htaccess` that denies web access.

Git deployment (cPanel → Git Version Control) also works: clone the repository
and deploy to `public_html`.

## 2. Storage and secrets

1. Create a folder **outside** `public_html`, e.g. `/home/CPANEL_USER/acadlytic-storage`, permissions `750`.
2. Copy `config/local.example.php` to `config/local.php` and set:
   ```php
   'storage_path' => '/home/CPANEL_USER/acadlytic-storage',
   ```
3. If you skip this, the site uses `public_html/storage/`, which is protected by `.htaccess`, but outside the web root is safer.

The storage folder holds enquiry files (when no database is configured),
rate-limit counters and an automatically generated HMAC key (`keys/app.key`).

## 3. Database (optional, recommended)

1. cPanel → MySQL Databases: create a database and user, grant all privileges.
2. phpMyAdmin → import `database/schema.sql`.
3. Add credentials to `config/local.php`:
   ```php
   'db' => ['dsn' => 'mysql:host=localhost;dbname=CPANEL_DB;charset=utf8mb4', 'user' => '...', 'password' => '...'],
   ```

Without a database, enquiries are appended to `storage/enquiries/YYYY-MM.jsonl`
(file mode `0600`).

## 4. Email notifications

Each enquiry triggers a plain-text notification to `forms.notify_email`
(`info@acadlytic.com`) using PHP `mail()`, sent from `forms.mail_from`
(`no-reply@acadlytic.com`). In cPanel → Email Deliverability, make sure SPF and
DKIM are valid for the domain. Leads are always stored before mail is attempted,
so a mail failure never loses an enquiry.

## 5. Canonical host

The site uses `https://acadlytic.com` (no `www`) as canonical. `.htaccess`
redirects HTTP→HTTPS and `www`→apex. If you prefer `www`, change `url` in
`config/site.php`, the host rule in `.htaccess` and the `Sitemap:` line in
`robots.txt`, then run `php bin/build.php`.

## 6. Verify after upload

These must all return **HTTP 200**:

- `https://acadlytic.com/`
- `https://acadlytic.com/login.php` and `/login/`
- `https://acadlytic.com/forgot-password.php`
- `https://acadlytic.com/request-access.php`
- `https://acadlytic.com/assets/css/main.css`
- `https://acadlytic.com/assets/js/app.js`
- `https://acadlytic.com/assets/img/logo-acadlytic.png`
- `https://acadlytic.com/sitemap.xml` and `/robots.txt`

These must **not** be readable (403/404):

- `https://acadlytic.com/config/site.php`
- `https://acadlytic.com/includes/bootstrap.php`
- `https://acadlytic.com/storage/`
- `https://acadlytic.com/data/nav.php`

Then submit a test demo request and confirm it arrives by email (and in the
database or storage folder).

### If pages show unstyled, default browser buttons

Asset URLs are root-relative (`/assets/...`) with a version query, so they work
on any host. If styles are still missing:

1. Open `/assets/css/main.css` directly. A 404 means the upload is incomplete.
2. A 403 usually means file permissions: files `644`, folders `755`.
3. Clear any CDN or cPanel cache.

Even if `main.css` fails, the header renders correctly because critical header
styles are inlined in every page.

## 7. Google Search Console

1. Verify the `acadlytic.com` domain property.
2. Submit `https://acadlytic.com/sitemap.xml`.
3. Inspect a sample of key URLs (home, platform, a guide, a glossary term).
4. Validate structured data with the Rich Results Test.

## Updating the site

```bash
php bin/build.php   # after editing data/pages or data/redirects
php bin/qa.php      # must report 0 errors
```

Upload changed files. Stubs, `sitemap.xml` and `assets/img/icons.svg` are
generated. Commit them so hosts without shell access get them too.
