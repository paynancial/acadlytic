# Header, mega menu and footer

All navigation content lives in `data/nav.php`. Templates never hard-code links.

## Utility bar (`includes/utility-bar.php`)

- 36px navy bar, 11–13px type, subtle separators.
- Left: cyan indicator · **AI-POWERED EDUCATION PLATFORM** · *Where Education Meets Intelligence.*
- Right: **Support** and **Login ▾** (`includes/login-menu.php`). Phone and email are in the footer's *Talk to Acadlytic* strip, the enquiry widget and the mobile drawer.
- ≤1080px: the tagline hides. ≤760px: the left statement hides, leaving **Support** and **Login**.

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
Search · **Request a Demo**. Login lives only in the utility bar. Between
1081px and 1280px the menu spacing tightens so the header never overflows.

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
search, accordion categories (native `<details>`, built by `app.js` from the
mega-menu markup on first open so each page ships the links once), Request a
Demo, Login, phone and email. The drawer traps focus and closes with Escape.
Without JS the menu button links to `/sitemap/`.

### Header safety

- Asset URLs are root-relative and versioned by file modification time (`/assets/css/main.css?v=…`), so they cannot break because of a host mismatch (the cause of the earlier raw-button deployment).
- Critical header CSS (`includes/critical.css`) is inlined in every page and allowed in the CSP by hash, so the header renders correctly even if `main.css` is delayed.

## Footer (`includes/footer.php`)

Deep navy surface (`#071A3A` → `#050F26`) with a soft electric-blue and cyan glow, a thin cyan hairline on top, white headings and muted blue-grey links.

1. **Talk to Acadlytic** strip (glass panel with a short cyan accent): email (`mailto:`), phone shown masked (`CONTACT_PHONE_DISPLAY`, links to `/go/call/`), office *Patna, Bihar, India* (links to `/company/offices/patna/`), and a **Request a Demo →** gradient button.
2. **Brand column**: light logo (`logo-acadlytic-light.*`, white wordmark with the full-colour mark), *Where Education Meets Intelligence.*, AI | CRM | CLOUD | ACADEMIC MANAGEMENT, a two-line description, and social icons for LinkedIn, X, YouTube and Instagram (`data/nav.php` → `footer_social`).
3. **Four navigation columns** (`data/nav.php` → `footer`), each a `<nav>` labelled by its heading:
   - **Platform**: Overview, Academic Management, Admissions & CRM, Student Management, Analytics & AI, Integrations, Pricing.
   - **Solutions**: For Institutions, For Administrators, For Faculty, For Students, For Parents, AI for Education.
   - **Resources**: Resources, Blog, Case Studies, Whitepapers, FAQs, Help Center.
   - **Trust & Governance**: Security Center, Privacy & Data Protection, Terms, Accessibility, Data Protection Officer, Grievance Redressal Officer, Sitemap. Officer names are not shown in the footer; they appear on the approved officer pages.
4. **Bottom bar**: © year Acadlytic, Inc. All rights reserved · Privacy Policy | Terms | Security | Sitemap (`footer_legal`).

Responsive:
- ≤1180px: the contact items move below the strip heading, and the brand column spans the full width above four columns.
- ≤860px: two columns.
- ≤640px: one column, and each navigation column becomes an accordion. `app.js` inserts a button with `aria-expanded`/`aria-controls`; without JS every list stays open.

Keyboard focus shows a cyan outline. The only motion is short colour transitions.

Company pages (About, Leadership, Careers, Contact, Offices, and others) are linked from the header's Company menu and the `/company/` hub. Social profile URLs live in `config/site.php`; all five, including Facebook, still feed the Organization `sameAs` structured data.

## Floating enquiry widget (`components/enquiry-widget.php`)

Included once, from `includes/footer.php`, on every public page (not on the
auth pages). Desktop: “Enquire now” button fixed 24px from the right at 60% of
the viewport height; the panel opens to its left. ≤900px: bottom-right.
≤640px: 54px circular button in the safe area. Hidden while the mobile menu is
open and when printing.

The panel (“Let’s Connect / How can we help you?”) offers exactly three actions:
**Fill Enquiry Form** (native `<dialog>` modal from `components/enquiry-modal.php`,
submitted to `/enquiry/` with CSRF token, honeypot, timing check, rate limit and
server-side validation), **Email Us** (`mailto:` from `CONTACT_EMAIL`) and
**WhatsApp Us** (`/go/whatsapp/`, pre-filled message). A small masked call
line links to `/go/call/`. All contact values come from `config/contact.php`.
