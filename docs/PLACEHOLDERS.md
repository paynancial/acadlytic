# Items for Acadlytic to confirm

The site avoids invented facts. These items need an owner's confirmation or
real content.

## Confirmed by Acadlytic

- Support, account help and form notifications: `info@acadlytic.com`.
- Leadership: Renuka Devi (Director) and Anisha Bharti (Director), on `/company/leadership/`. LinkedIn profiles added for both. Short bios and photos can be added in `data/people.php`.
- Office: #203, Sharda Mansions Apartment, Kailashpuri, Hanuman Nagar, Patna, Bihar 800020 (`config/site.php` → `office`). Used on `/company/offices/patna/` (LocalBusiness schema), the Contact page, the footer and the Organization schema. It is presented as an **office**, not the registered office.
- Phone / WhatsApp number: stored only in `config/contact.php`, shown masked on the site.
- Data Protection Officer: Mr. A.K Sinha, `dpo@acadlytic.com` (`/trust/data-protection-officer/`).
- Grievance Redressal Officer: Mrs. Anjali Sharma, `gro@acadlytic.com` (`/trust/grievance-redressal-officer/`).
  Contact-form enquiries on the Privacy and Grievance topics are also emailed to these officers. Make sure both mailboxes exist and receive mail.

## Must confirm before launch

- **Product claims:** every product capability is currently **PLANNED** and labelled on the site. See `docs/CLAIMS_REGISTER.md` for the evidence needed to promote each one to LIVE.
- **Legal pages:** Privacy, Terms, Grievance process and both officer pages are drafts marked **LEGAL REVIEW REQUIRED — NOT FINAL** and noindex. See `docs/LEGAL_REVIEW_CHECKLIST.md`. `php bin/qa.php --launch` fails until they are signed off.
- **Mailboxes:** info@, dpo@ and gro@acadlytic.com exist and are monitored; SPF/DKIM pass on the hosting server.

## Placeholders (noindex until real content exists)

| Page | Status |
|---|---|
| `/company/case-studies/` | Placeholder; publish only verified, institution-approved case studies. |
| `/resources/whitepapers/` | Placeholder. |
| `/company/team/` | Same as above (`team` group in `data/people.php`). |
| `/company/news/` | Needs dated, factual announcements in `data/news.php`. |

`/company/vision-mission/` is live and indexable. Its wording was drafted from the existing positioning; leadership should approve it.

## Optional, when available

- Independent security attestations or accessibility audit results → add to `/core/security/` and `/trust/accessibility/` with dates.
- Real customer proof (logos, metrics, testimonials) → only with written approval from each institution.
- Enable OAuth buttons (`auth.oauth.*`) once implemented. See `AUTH_ARCHITECTURE.md`.

## Brand asset note

The supplied `logo-acadlytic.png` in the 120+ page package carried an older
tagline (“Intelligence for a Smarter Education Ecosystem.”). The header logo was
cut from the supplied banner with the current tagline and optimised
(`assets/img/logo-acadlytic.png`/`.webp`: mark and wordmark, since the small
tagline is illegible at header size). Originals are kept in `docs/references/`.
Replace with official vector (SVG) files when available.
