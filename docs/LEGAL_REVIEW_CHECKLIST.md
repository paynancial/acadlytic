# Legal review checklist

**Status: LEGAL REVIEW REQUIRED — NOT FINAL.** None of the legal or governance pages
has been approved by legal counsel. They are drafts written in plain language
from the website's actual behaviour, structured for a lawyer to review.

## Pages under review

| Page | URL | Data key |
|---|---|---|
| Privacy & Data Protection | `/trust/privacy/` | `data/pages/80-company.php` |
| Terms of Use | `/trust/terms/` | same |
| Grievance redressal process | `/trust/grievance-redressal/` | same |
| Grievance Redressal Officer | `/trust/grievance-redressal-officer/` | same |
| Data Protection Officer | `/trust/data-protection-officer/` | same |

While a page is a draft (`'legal_draft' => true`) it:
- shows a visible **LEGAL REVIEW REQUIRED — NOT FINAL** marker, with a “For legal counsel to complete” list;
- carries an HTML comment marker for developers;
- is `noindex` and excluded from `sitemap.xml` and `llms.txt`;
- blocks `php bin/qa.php --launch`.

**Sign-off procedure:** counsel approves the final text, a developer replaces the draft text, removes `'legal_draft' => true` and `counsel_items`, runs `php bin/build.php && php bin/qa.php --launch`, and records the approval (date, approver) at the bottom of this file.

## What the drafts contain today, and what counsel must decide

Items marked ☐ are **not stated anywhere on the site** and must not be invented.

### Privacy Policy
- [ ] **Legal entity** name, registered office, company registration number ☐
- [ ] **Applicable law(s)** and legal bases for each processing purpose ☐ (the draft makes no GDPR or DPDP Act compliance claim)
- [ ] **Data collection**: the draft lists website forms, the security session cookie, hashed network identifiers and server logs. Confirm completeness.
- [ ] **Data retention**: the draft only says “only as long as necessary” and logs “for a limited period”. Specific periods ☐
- [ ] **Third-party services / sub-processors**: hosting, email delivery, any messaging providers ☐
- [ ] **Hosting location, data residency, international transfers** ☐
- [ ] **User rights**: the draft lists access, correction, erasure, consent withdrawal, nomination and grievance, “depending on applicable law”. Confirm the list and procedure.
- [ ] **Children and minors**: handling of applicants and students under 18 and parental consent ☐
- [ ] **Security statements**: the draft points to the Security Center, which is labelled *in development*. Confirm wording.
- [ ] **AI and data usage**: the draft states a *design principle* that institutional data will not train public AI models. Confirm as a commitment or keep it as a principle.
- [ ] **“We do not sell personal data”**: confirm this is an accurate, binding statement.
- [ ] **Controller / processor roles** for platform data processed on behalf of institutions ☐

### Cookie / tracking disclosure
- [ ] Current behaviour (verified in code): no analytics or advertising cookies; one `HttpOnly`, `SameSite=Lax` session cookie on form and sign-in pages for CSRF protection and sign-in. Decide whether a separate cookie notice is required.
- [ ] Update the disclosure before adding any analytics, chat or marketing tools.

### Terms of Use
- [ ] **Legal entity** details ☐
- [ ] **Governing law and jurisdiction** ☐ (not stated in the draft)
- [ ] **Limitation of liability / disclaimers**: the draft has generic wording; confirm enforceability
- [ ] Acceptable use, intellectual property, third-party links, changes to terms
- [ ] Relationship to institution platform agreements (separate contracts)
- [ ] **Refund obligations**: none stated ☐ (the website sells nothing directly)

### Grievance policy and mechanism
- [ ] **Grievance Redressal Officer**: Mrs. Anjali Sharma, gro@acadlytic.com (supplied by Acadlytic). Confirm the designation and whether statutory publication requirements apply.
- [ ] **Data Protection Officer**: Mr. A.K Sinha, dpo@acadlytic.com (supplied by Acadlytic). Confirm the designation and legal basis.
- [ ] **Acknowledgement and resolution timelines** ☐ (the draft says “timelines required by applicable law”)
- [ ] **Escalation route** and any external authority complainants may approach ☐
- [ ] Record-keeping for grievances ☐

### Contact information
- [ ] info@acadlytic.com (general, support, enquiries), dpo@acadlytic.com, gro@acadlytic.com and the phone/WhatsApp number held in `config/contact.php` (shown masked on the site): confirm all are monitored.
- [ ] Postal address for legal notices: the office address supplied by Acadlytic (#203, Sharda Mansions Apartment, Kailashpuri, Hanuman Nagar, Patna, Bihar 800020) is published as an *office*. Confirm whether it is also the registered office and the address for legal notices ☐

### Other
- [ ] Accessibility statement (`/trust/accessibility/`): not a legal document, but confirm the WCAG 2.2 AA *target* wording (no audit has been completed).
- [ ] Security Center (`/core/security/`): confirm the vulnerability-reporting wording.

## Approval record

| Page | Approved by | Date | Notes |
|---|---|---|---|
| — | — | — | Not yet approved |
