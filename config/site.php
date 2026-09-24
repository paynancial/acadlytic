<?php
/**
 * Central Acadlytic site configuration.
 *
 * Public, non-secret values only. Secrets (database credentials, mail
 * settings, OAuth keys) belong in config/local.php, which is git-ignored
 * and blocked from web access. See config/local.example.php.
 */
declare(strict_types=1);

$contact = require __DIR__ . '/contact.php';

return [
    'name'        => 'Acadlytic, Inc.',
    'short_name'  => 'Acadlytic',
    'tagline'     => 'Where Education Meets Intelligence.',
    'descriptor'  => 'AI-powered EdTech CRM & Cloud Platform for Academic Management',
    'pillars'     => ['AI', 'CRM', 'Cloud', 'Academic Management'],

    // Canonical origin used for canonical tags, sitemap and structured data.
    'url'         => 'https://acadlytic.com',
    'locale'      => 'en_IN',
    'language'    => 'en-IN',

    'contact'       => $contact,
    'email'         => $contact['CONTACT_EMAIL'],
    // Confirmed by Acadlytic: all support and account help goes to the central mailbox.
    'support_email' => 'info@acadlytic.com',
    // Masked for display; calls go through a number-free redirect endpoint.
    'phone'         => $contact['CONTACT_PHONE_DISPLAY'],
    'phone_href'    => $contact['CALL_URL'],

    // Office address supplied by Acadlytic. It is an office address only; do
    // not describe it as the registered office unless counsel confirms.
    'office' => [
        'label'    => 'Patna office',
        'street'   => '#203, Sharda Mansion, Kailashpuri, Hanuman Nagar',
        'locality' => 'Patna',
        'region'   => 'Bihar',
        'postal'   => '800020',
        'country'  => 'IN',
        'country_name' => 'India',
        'page'     => '/company/offices/patna/',
    ],

    // Governance officers, as designated and confirmed by Acadlytic, Inc.
    'governance' => [
        'dpo'       => ['label' => 'Data Protection Officer', 'name' => 'Mr. A.K Sinha', 'email' => 'dpo@acadlytic.com', 'subject' => 'Data Protection Officer request', 'page' => '/trust/data-protection-officer/'],
        'grievance' => ['label' => 'Grievance Redressal Officer', 'name' => 'Mrs. Anjali Sharma', 'email' => 'gro@acadlytic.com', 'subject' => 'Grievance Redressal request', 'page' => '/trust/grievance-redressal-officer/'],
    ],

    'social' => [
        'linkedin'  => ['label' => 'LinkedIn',  'url' => 'https://www.linkedin.com/company/acadlytic'],
        'x'         => ['label' => 'X',         'url' => 'https://x.com/acadlytic'],
        'youtube'   => ['label' => 'YouTube',   'url' => 'https://www.youtube.com/@acadlytic'],
        'instagram' => ['label' => 'Instagram', 'url' => 'https://www.instagram.com/acadlytic/'],
        'facebook'  => ['label' => 'Facebook',  'url' => 'https://www.facebook.com/acadlytic/'],
    ],
    'x_handle' => '@acadlytic',

    // Enquiry handling (demo, contact, request access).
    'forms' => [
        'notify_email'   => 'info@acadlytic.com',
        'send_mail'      => true,             // uses PHP mail(); leads are always stored first
        'mail_from'      => 'info@acadlytic.com',       // confirmed sender mailbox; Reply-To is the enquirer
        'rate_limit'     => ['max' => 10, 'window' => 3600], // submissions per IP per window (shared campus networks)
        'min_fill_secs'  => 3,                // bot heuristic: faster submissions are rejected
    ],

    // Workspace authentication is intentionally disabled in this release.
    // Enable only after the CMS/auth backend, database and mail are configured
    // (see docs/AUTH_ARCHITECTURE.md).
    'auth' => [
        'enabled'           => false,
        'max_attempts'      => 5,     // per email+IP within the lockout window
        'lockout_secs'      => 900,
        'session_idle_secs' => 1800,
        'oauth'             => ['google' => false, 'microsoft' => false],
    ],

    // Storage for leads, rate-limit counters and logs. Prefer a path outside
    // public_html in production (set in config/local.php).
    'storage_path' => dirname(__DIR__) . '/storage',

    // Database is optional for the public site. When configured in
    // config/local.php, enquiries are written to MySQL via PDO.
    'db' => [
        'dsn'      => '',
        'user'     => '',
        'password' => '',
    ],

    // Sitemap <lastmod> default. Update when content changes materially, or set
    // 'updated' => 'YYYY-MM-DD' on an individual page in data/pages.
    'content_updated'   => '2026-09-24',
    'content_published' => '2026-09-24', // Article datePublished default

    // Bump when assets change if file modification times are unreliable.
    'asset_version' => '2026.09.23',
];
