# Items for Acadlytic to confirm

The site avoids invented facts. These items need an owner's confirmation or
real content.

## Must confirm before launch

| Item | Where | Why |
|---|---|---|
| SPF/DKIM pass for `info@acadlytic.com` on the hosting server | cPanel → Email Deliverability | Enquiry notifications are sent from `info@acadlytic.com` via `mail()`. Support, account help and notifications all use this confirmed mailbox. |
| Privacy, Terms and Grievance pages reviewed by counsel | `/trust/privacy/`, `/trust/terms/`, `/trust/grievance-redressal/` | Written as plain-language drafts with a visible “pending legal review” banner. Remove the `draft` key once approved. |
| Grievance response timelines | `/trust/grievance-redressal/` | Not stated. Currently “timelines required by applicable law”. |
| Security Center controls match production | `/core/security/` | Describes encryption in transit/at rest, RBAC, audit logs, backups and incident handling. Engineering should confirm each statement. |
| Product capability statements | All `/platform/`, `/ai/`, `/integrations/` pages | Describe the modules named in the handoff briefs. Product owners should confirm each capability, and mark any roadmap items as such. |
| SSO protocols (SAML 2.0 / OIDC), sandbox environments, API and webhooks | Integrations pages, IT solutions page | Confirm availability, or reword as planned. |
| “Toll-free” status of +91 8010707171 | Utility bar, footer, contact routes | Shown as **Phone**. Indian toll-free numbers use the 1800/1860 series; this is a standard 10-digit number. Only relabel if the provider confirms toll-free status. |

## Placeholders (noindex until real content exists)

| Page | Status |
|---|---|
| `/company/case-studies/` | Placeholder; publish only verified, institution-approved case studies. |
| `/resources/whitepapers/` | Placeholder. |

## Optional, when available

- Dedicated DPO and Grievance Officer mailboxes and names → update `config/site.php` → `governance` and `/trust/` table.
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
