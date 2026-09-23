# Phase 3 CMS Blueprint — after public-site approval

## Admin modules
- Dashboard
- Page Manager
- SEO Manager
- Content / Blog
- Resources / Glossary
- Media Library
- Leads & Demo Requests
- Users & Roles
- Global Settings
- Social Links
- Sitemap & Indexing Controls
- Audit Log

## Roles
Super Admin → Admin → Content Manager → SEO Manager → Sales / Enquiries

## Security
- Password hashing
- CSRF protection
- Session rotation
- MFA-ready architecture
- IP / login audit trail
- Rate limiting
- Upload MIME/type checks
- Least-privilege permissions
- Secrets outside webroot where hosting permits

## Database direction
Start with MySQL/MariaDB compatibility for cPanel, while keeping a clean repository/service boundary so a future VPS migration to PostgreSQL/Laravel remains possible.
