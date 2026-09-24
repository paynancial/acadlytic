# “Talk to Acadlytic” contact widget: QA report

Date: 24/09/2026 · Branch: `claude/dazzling-ride-27ugxg` (PR #1, **not merged**)

Test setup:
- Chromium (Playwright) against the PHP dev router, which mirrors the `.htaccess` rules.
- Pages: homepage, product (`/platform/admissions-crm/`), solution (`/solutions/for-faculty/`), resource guide (`/resources/academic-crm-guide/`), blog (`/resources/blog/`), contact and Patna office.
- Viewports: desktop 1440×900, laptop 1100×760, tablet 768×1024 and 1024×768, **iPhone 13** and **Pixel 7** device profiles (touch, mobile viewport, device pixel ratio).
- Total: 7 pages × 6 viewports = **42 combinations, all passing**.

## 1. New floating label

**TALK TO ACADLYTIC** replaces “ENQUIRE NOW”.
- The button has a chat-bubble icon and `aria-label="Talk to Acadlytic"`.
- The hover tooltip reads “Enquiry form · Email · WhatsApp”.
- No user-facing “Enquire now / ENQUIRE NOW” remains. The repository search found it in the widget, five page texts, the contact page description and the internal notification label; all were replaced with “Talk to Acadlytic”. The crawl of every page confirms 0 occurrences.
- “Fill Enquiry Form” and “Send Enquiry” are kept on purpose: they name the form itself, as specified.

## 2. Footer CTA status

A new conversion area sits directly above the footer navigation:
- Kicker **TALK TO ACADLYTIC**.
- Heading **Let’s build a smarter academic future together.**
- Text: “Talk to the Acadlytic team about our AI-powered EdTech CRM and academic management platform.”
- Buttons **Request a Demo →** (`/company/request-demo/`) and **Talk to Acadlytic →**.
- Contact row: email, masked phone, Patna office.

**Talk to Acadlytic →** opens the same panel as the floating button (`[data-acw-open]`), with no duplicate widget or form. It passed on all 42 combinations: the panel opens within the viewport, focus moves into the panel, the page does not navigate, and Escape returns focus to the footer button.

## 3. Desktop status

Pass.
- The button is fixed 24px from the right at 60% of the viewport height (226×52px), z-index above all page content and the header.
- The panel opens to its left, always inside the viewport, and never overlaps the button.
- When the footer is on screen the button stays visible but becomes a 52px icon button, so it never covers the footer CTA (checked on every page and viewport).
- The header was also verified free of overflow between 1081 and 1290px.

## 4. Mobile and tablet status

Pass.
- ≤900px: the button is bottom-right and safe-area aware (`env(safe-area-inset-bottom/right)`).
- ≤640px: a 54×54px icon button, above the 44px minimum touch target.
- The footer bottom bar has extra bottom padding (96px + safe-area inset) at ≤900px. When scrolled to the very bottom, the button covers **no** footer link or accordion control (checked on every page at every viewport).
- The footer CTA uses full-width buttons on phones.
- No horizontal overflow at any tested width (320–1440px).

## 5. Accessibility status

Pass.
- axe-core (WCAG 2.0/2.1/2.2 A and AA plus best practices) on 35 pages at 1440px and 390px: 0 violations.
- The button and footer trigger get `role="button"`, `aria-controls`, `aria-haspopup="dialog"` and `aria-expanded`, kept in sync.
- Enter and Space open the panel; Escape closes it and returns focus to whichever control opened it; clicking outside closes it.
- The first action is focused on open, and the focus ring is visible.
- The form modal is a native `<dialog>` with a built-in focus trap.
- Motion is 200–220ms fade and translate, with no pulsing (the previous attention glow was removed). Transitions are off under `prefers-reduced-motion`.

## 6. WhatsApp status

Pass. **WhatsApp Us** → `/go/whatsapp/` → `302` to `https://wa.me/918010707171?text=…` with the pre-filled message. It opens in a new tab (`noopener nofollow`) and fires the `whatsapp_click` event.

## 7. Email status

Pass. **Email Us** → `mailto:info@acadlytic.com?subject=Enquiry%20from%20acadlytic.com` and fires `email_click`.

## 8. Enquiry form status

Pass on desktop and mobile. An empty submit shows 3 inline errors. A valid submit shows “Enquiry received successfully.” and the enquiry is stored and emailed.

Server protections are unchanged: CSRF token, honeypot, timing check, a rate limit of 10 per hour, validation and output escaping.

## 9. Mobile number masking status

Pass.
- The visible number is always `+91 80••••••71`. The full number appears in no page, `sitemap.xml`, `llms.txt` or structured data.
- It lives only in `config/contact.php`.
- Call (`/go/call/` → `tel:+918010707171`) and WhatsApp still work.

## 10. Files changed

| File | Change |
|---|---|
| `components/contact-widget.php` | Renamed from `enquiry-widget.php`; new label, `aria-label`, tooltip; references the renamed CSS/JS/modal |
| `components/contact-modal.php` | Renamed from `enquiry-modal.php` (content unchanged) |
| `assets/css/contact-widget.css` | Renamed; button and panel positioned as one fixed unit; compact mode near the footer; pulse removed; tablet and phone rules |
| `assets/js/contact-widget.js` | Renamed; shared `[data-acw-open]` triggers, Space key, focus return to the opening control, `aria-expanded` sync, compact-near-footer observer; pulse removed |
| `includes/footer.php` | New footer CTA (heading, text, Request a Demo, Talk to Acadlytic), includes the renamed widget |
| `assets/css/main.css` | Footer CTA layout, secondary button style, bottom padding for the fixed button at ≤900px |
| `data/pages/80-company.php`, `data/pages/00-core.php` | “Enquire now/Enquire Now” → “Talk to Acadlytic” |
| `includes/forms.php` | Internal notification label: “Website enquiry (Talk to Acadlytic widget)” |
| `bin/qa.php` | Required-asset list uses the renamed files |
| `README.md`, `docs/HEADER_FOOTER.md`, `docs/QA_REPORT.md` | Documentation updated |

`config/contact.php` is unchanged and remains the single source for the phone, WhatsApp and email values.

## 11. Remaining issues

- **Real devices.** iPhone and Android were tested with Chromium device emulation (viewport, touch, pixel ratio), not physical Safari or Chrome. Check once on a real iPhone (Safari) and an Android phone after deployment.
- **Cookie banners.** The site has no cookie banner today (no tracking cookies). If one is added later, give it a z-index below 1000 or offset the widget.
- **Mid-scroll overlap on phones.** While scrolling, the fixed button can pass over content, which is inherent to any floating button. At rest and at the bottom of the page it covers no links, and on desktop it shrinks while the footer is visible.
- **Justified text on phones.** The footer CTA sentence switches to left alignment on phones (≤640px) to avoid wide word gaps. The brand description stays justified at all sizes.
