# Header, mega menu and footer

All navigation content lives in `data/nav.php`. Templates never hard-code links.

## Utility bar (`includes/utility-bar.php`)

- 36px navy bar, 11–13px type, subtle separators.
- Left: cyan indicator · **AI-POWERED EDUCATION PLATFORM** · *Where Education Meets Intelligence.*
- Right: phone, email, Support, Resources, **Login ▾** (`includes/login-menu.php`).
- ≤1080px: phone, email and Resources hide (they move into the mobile drawer). ≤760px: the left statement hides, leaving **Support** and **Login**.

## Login popover (`includes/login-menu.php`)

“Access your Acadlytic account → Choose your workspace”, with four options
(Institution / Admin, Faculty / Staff, Student / Parent, Partner / B2B), each
with its own icon. Help link to support email, **Continue to Login →**, and
“Secure access · Encrypted sessions · Role-based access”. It is a selector
only; sign-in happens on `/login.php`.

Keyboard: Enter/Space or ArrowDown opens; Escape closes and returns focus;
clicking outside closes. Without JavaScript it opens on hover/focus.

## Main header (`includes/header.php`)

Logo · Platform · AI · Solutions · Integrations · Resources · Company ·
Search · Login · **Request a Demo** (the only filled button, so Login never
competes with it).

### Mega menu

Each panel has three columns: an **intro** (section title, one-line
explanation and a hub link), **grouped links** (6–8 destinations with icon and
description, plus an “Also explore” row) and a **conversion card** (dashboard
preview, AI prompt, integration planning, resource or contact).

- Desktop: hover intent (90ms open, 160ms close), click toggle, 180ms fade and slide, blurred backdrop below the header, active-section underline.
- Keyboard: ArrowDown opens and focuses the first link; ArrowUp/Down move within the panel; ArrowLeft/Right move between top-level items; Home/End; Escape closes and returns focus; focus leaving a panel closes it.
- No JavaScript: panels open with CSS `:hover` and `:focus-within`, so navigation is never dependent on JS.

### Mobile

Header shows logo, **Demo** and menu. The menu opens a full-screen drawer with
search, accordion categories (native `<details>`, which work without JS), Request a
Demo, Login, phone and email. The drawer traps focus and closes with Escape.
Without JS the menu button links to `/sitemap/`.

### Header safety

- Asset URLs are root-relative and versioned by file modification time (`/assets/css/main.css?v=…`), so they cannot break because of a host mismatch (the cause of the earlier raw-button deployment).
- Critical header CSS (`includes/critical.css`) is inlined in every page and allowed in the CSP by hash, so the header renders correctly even if `main.css` is delayed.

## Trust bar and footer (`includes/footer.php`)

1. **Trust bar**: SECURE • SCALABLE • AI-POWERED • CLOUD-READY • ACCESSIBLE, with cards for Data Protection, Enterprise Security, Role-Based Access, Cloud Infrastructure and Responsible Support.
2. **Five columns**: brand (logo, tagline, AI | CRM | CLOUD | ACADEMIC MANAGEMENT, social icons), Platform, Solutions, Resources, Company.
3. **Trust & Governance**: Security Center, Privacy & Data Protection, Data Protection Officer, Grievance Redressal Officer, Accessibility, Terms, Sitemap. The DPO and Grievance links open their officer pages, and the note underneath names **Mr. A.K Sinha** (`dpo@acadlytic.com`) and **Mrs. Anjali Sharma** (`gro@acadlytic.com`). Both come from `config/site.php` → `governance`.
4. **Contact**: `info@acadlytic.com` and **Phone** +91 8010707171 (labelled Phone, not toll-free).
5. Legal bar: copyright plus Privacy, Terms, Security, Accessibility, Sitemap.

Social profiles (LinkedIn, X, YouTube, Instagram, Facebook) come from
`config/site.php` and also feed the Organization `sameAs` structured data.
