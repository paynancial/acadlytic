<?php
/**
 * Leadership and team profiles for /company/leadership/ and /company/team/.
 *
 * Add only real, consenting people. Each page stays noindex (and shows an
 * "in preparation" note) until at least one profile is listed here, then it
 * becomes indexable automatically on the next `php bin/build.php`.
 *
 * Profile keys: name (required), role (required), bio, linkedin (URL),
 * photo (root-relative path to a square WebP/PNG under /assets/img/people/).
 */
declare(strict_types=1);

return [
    'leadership' => [
        // ['name' => 'Full Name', 'role' => 'Chief Executive Officer', 'bio' => 'One or two factual sentences.', 'linkedin' => 'https://www.linkedin.com/in/...'],
        ['name' => 'Renuka Devi', 'role' => 'Director'],
        ['name' => 'Anisha Bharti', 'role' => 'Director'],
    ],
    'team' => [
        // ['name' => 'Full Name', 'role' => 'Product Designer', 'bio' => '...'],
    ],
];
