# storage/

Runtime data written by the site: `enquiries/` (JSONL fallback when no
database is configured), `ratelimit/`, and `keys/app.key` (HMAC secret,
generated on first use). Contents are git-ignored and denied over HTTP.

Recommended on cPanel: set `storage_path` in `config/local.php` to a folder
outside `public_html`, e.g. `/home/CPANEL_USER/acadlytic-storage`.
