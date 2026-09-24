# Login experience and auth architecture

> **Phase 3 note:** the SaaS platform will have its own identity, MFA, SSO and RBAC in a separate application (`app.acadlytic.com`). See `docs/architecture/` (ADR-001, [08 Security](architecture/08-security-privacy.md), [03 RBAC](architecture/03-rbac.md)). The website sign-in shell described here is not the product's authentication. It will hand off to the application at launch.

## What ships in this release

| Route | Purpose | Indexing |
|---|---|---|
| Utility bar **Login ▾** | Workspace selector popover. Routes to the sign-in page with a workspace hint; collects no credentials. | n/a |
| `/login.php` and `/login/` | Standalone split-screen sign-in page | `noindex, nofollow`, not in sitemap |
| `/forgot-password.php` | Password help request | `noindex, nofollow` |
| `/request-access.php` | Access request form | `noindex, nofollow` |
| `/cms/` | Reserved placeholder, returns 404 | disallowed in robots.txt |

**Workspace authentication is disabled** (`config/site.php` → `auth.enabled = false`).
The site does not pretend to sign anyone in:

- Sign-in form: validated and CSRF-protected. With auth disabled, a correct-looking submission shows *“Workspace sign-in isn’t open yet”* with links to Request Access and support.
- Forgot password: stores a verified-by-staff help request (type `reset`) and shows the success state. Staff follow up manually until self-service reset exists.
- Request access: stores the request (type `access`) and notifies `info@acadlytic.com`.
- Google / Microsoft buttons render **disabled**, with a note, until OAuth is configured (`auth.oauth.google|microsoft`).

## Login UX details

- Split layout: brand story (~55%) and auth card (~45%); stacks on tablets and phones, with the story reduced to logo, headline and pillars.
- The optional **Workspace** selector (Institution Admin, Faculty & Staff, Student, Parent, Partner) is prefilled from `?workspace=` in the popover links. The backend will determine real permissions after authentication.
- Password visibility toggle (`aria-pressed`, label switches Show/Hide), `autocomplete="username"` / `current-password` for password managers, `inputmode="email"`.
- Client-side hints plus server-side validation; errors are linked to fields with `aria-describedby`; the submit button shows a loading state and `aria-busy`.
- Credentials are only sent by POST, never placed in URLs, never logged, never echoed back.

## Security building blocks already implemented

| Concern | Where |
|---|---|
| Hardened sessions (`HttpOnly`, `Secure`, `SameSite=Lax`, `__Host-` prefix on HTTPS, strict mode, idle timeout, periodic ID rotation) | `includes/security.php` → `acad_session_start()` |
| CSRF tokens (`hash_equals`) | `acad_csrf_token()`, `acad_csrf_valid()` |
| Rate limiting / login throttling (file-based, no Redis) | `acad_rate_limit()`, `acad_rate_limited()` |
| Password hashing & verification (`password_hash`, `password_verify`, `password_needs_rehash`) | `includes/auth/AuthService.php` |
| Constant-work lookups (no account enumeration) | `AuthService::attempt()` |
| Session regeneration on login, full teardown on logout | `AuthService` |
| Audit log of auth events | `auth_audit` table, `AuthService::audit()` |
| MFA hand-off state | `AuthResult::MFA_REQUIRED` → `/login/verify/` (to be built) |
| Prepared statements only | all PDO calls |
| Security headers (CSP with hashed inline critical CSS, HSTS on HTTPS, X-Frame-Options, Referrer-Policy, Permissions-Policy) | `acad_send_security_headers()` |

Schema for `users`, `password_resets`, `user_sessions` and `auth_audit` is in
`database/schema.sql`.

## Enabling authentication (CMS phase)

Do these in order; do not flip `auth.enabled` before all are done:

1. Import `database/schema.sql`, configure `config/local.php` DB credentials.
2. Build the authenticated areas: `/admin/` (or `cms.acadlytic.com`), `/faculty/`, `/student/`, `/partner/`. Each must call `acad_session_start()` and check `AuthService::user()` and role on **every** request.
3. Build `/login/verify/` for MFA (TOTP) and `/reset-password.php` for token consumption: single-use tokens, stored as SHA-256 hashes, 60-minute expiry, invalidate other sessions on reset.
4. Replace the manual password-help flow in `includes/auth/pages.php` with token emails.
5. OAuth: implement `/login/oauth/{google,microsoft}/` with state and PKCE, map identities to existing users only (no open sign-up), then set `auth.oauth.*` to `true`.
6. Device/session management using `user_sessions`, plus an admin UI for revocation.
7. Penetration test, then set `auth.enabled = true`.

Keep the CMS a separate authenticated application. Never expose drafts,
credentials or configuration through the public site.
