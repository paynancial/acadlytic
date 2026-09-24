# Header, mega menu and footer

All navigation content lives in `data/nav.php`. Templates never hard-code links.

## Utility bar (`includes/utility-bar.php`)

- 36px navy bar, 11–13px type, subtle separators.
- Left: cyan indicator · **AI-POWERED EDUCATION PLATFORM** · *Where Education Meets Intelligence.*
- Right: **Support** and **Login ▾** (`includes/login-menu.php`). Phone and email are in the footer's *Talk to Acadlytic* CTA, the Talk to Acadlytic widget and the mobile drawer.
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

1. **Trust strip** (`footer_trust`): SECURE • SCALABLE • AI-POWERED • CLOUD-READY • ACCESSIBLE, followed by Data Protection, Enterprise Security, Role-Based Access, Cloud Infrastructure and Responsible Support. These are compact items with a cyan icon and thin dividers; each links to its trust page.
1. **Talk to Acadlytic** strip (glass panel with a short cyan accent): email (`mailto:`), phone shown masked (`CONTACT_PHONE_DISPLAY`, links to `/go/call/`), office *Patna, Bihar, India* (links to `/company/offices/patna/`), and a **Request a Demo →** gradient button.
2. **Brand column**: light logo (`logo-acadlytic-light.*`, white wordmark with the full-colour mark), *Where Education Meets Intelligence.*, AI | CRM | CLOUD | ACADEMIC MANAGEMENT, a two-line description, and social icons for LinkedIn, X, YouTube and Instagram (`data/nav.php` → `footer_social`).
3. **Five navigation columns** (`data/nav.php` → `footer`), each a `<nav>` labelled by its heading:
   - **Platform**: Overview, Academic Management, Admissions & CRM, Student Management, Analytics & AI, Integrations, Pricing.
   - **Solutions**: For Institutions, For Administrators, For Faculty, For Students, For Parents, AI for Education.
   - **Resources**: Resources, Blog, Case Studies, Whitepapers, FAQs, Help Center.
   - **Company**: About Us, Vision & Mission, Leadership, Careers, Contact Us, Our Office.
   - **Trust & Governance**: Security Center, Privacy & Data Protection, Terms, Accessibility, Data Protection Officer, Grievance Redressal Officer, Sitemap. Officer names are not shown in the footer; they appear on the approved officer pages.
4. **Bottom bar**: © year Acadlytic, Inc. All rights reserved · Privacy Policy | Terms | Security | Sitemap (`footer_legal`).

Responsive:
- ≤1180px: the contact items move below the strip heading, the brand column spans the full width above the five columns, and the trust items form 3 + 2.
- ≤1024px: three columns. ≤860px: the trust items form a 2 × 3 grid.
- ≤640px: one column, and each navigation column becomes an accordion. `app.js` inserts a button with `aria-expanded`/`aria-controls`; without JS every list stays open.

Keyboard focus shows a cyan outline. The only motion is short colour transitions.

Social profile URLs live in `config/site.php`; all five, including Facebook, still feed the Organization `sameAs` structured data.

## Floating “Talk to Acadlytic” widget (`components/contact-widget.php`)

This widget is included once, from `includes/footer.php`, on every public page (not on the auth pages). Its files are `components/contact-widget.php`, `components/contact-modal.php`, `assets/css/contact-widget.css` and `assets/js/contact-widget.js`, and the contact values come from `config/contact.php`.

**Button placement**
- Desktop: a **TALK TO ACADLYTIC** button (chat icon, `aria-label="Talk to Acadlytic"`), fixed 24px from the right at 60% of the viewport height. The panel opens to its left.
- ≤900px: bottom-right, safe-area aware.
- ≤640px: a 54px icon button.
- While the footer is on screen, the button stays visible but shrinks to icon-only so it never covers the footer CTA.
- Hidden while the mobile menu is open and when printing.

**Panel** (“Let’s Connect / How can we help you?”). It offers exactly three actions:
- **Fill Enquiry Form**: a native `<dialog>` submitted to `/enquiry/` with CSRF token, honeypot, timing check, rate limit and server-side validation.
- **Email Us**: `mailto:` from `CONTACT_EMAIL`.
- **WhatsApp Us**: `/go/whatsapp/`, with a pre-filled message.

A small masked call line links to `/go/call/`.

**Opening the panel from elsewhere.** Any `[data-acw-open]` element opens the same panel, for example **Talk to Acadlytic →** in the footer CTA. There is only ever one contact system per page. Without JS these triggers are plain links to `/core/contact/`.

**Keyboard and motion**
- Enter or Space opens the panel.
- Escape closes it and returns focus to the control that opened it; clicking outside also closes it.
- The panel focuses its first action when it opens.
- Transitions are 200–220ms fade and translate, with no pulsing, and are disabled under `prefers-reduced-motion`.
