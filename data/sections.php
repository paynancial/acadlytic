<?php
/**
 * Site sections: hub URL, breadcrumb label, eyebrow text and default icon.
 * `core` holds the original top-level pages from the 120+ page build; they
 * keep their URLs and declare their own parent hub.
 */
declare(strict_types=1);

return [
    'platform'     => ['label' => 'Platform',      'hub' => '/platform/',     'eyebrow' => 'Platform',        'icon' => 'layers', 'planned' => true],
    'ai'           => ['label' => 'Acadlytic AI',  'hub' => '/ai/',           'eyebrow' => 'Acadlytic AI',    'icon' => 'ai', 'planned' => true],
    'solutions'    => ['label' => 'Solutions',     'hub' => '/solutions/',    'eyebrow' => 'Solutions',       'icon' => 'users', 'planned' => true],
    'industries'   => ['label' => 'Institutions',  'hub' => '/industries/',   'eyebrow' => 'Institutions',    'icon' => 'building', 'planned' => true],
    'integrations' => ['label' => 'Integrations',  'hub' => '/integrations/', 'eyebrow' => 'Integrations',    'icon' => 'plug', 'planned' => true],
    'resources'    => ['label' => 'Resources',     'hub' => '/resources/',    'eyebrow' => 'Resources',       'icon' => 'book'],
    'glossary'     => ['label' => 'Glossary',      'hub' => '/glossary/',     'eyebrow' => 'Glossary',        'icon' => 'book'],
    'comparisons'  => ['label' => 'Comparisons',   'hub' => '/comparisons/',  'eyebrow' => 'Comparison',      'icon' => 'scale'],
    'company'      => ['label' => 'Company',       'hub' => '/company/',      'eyebrow' => 'Company',         'icon' => 'building'],
    'trust'        => ['label' => 'Trust Center',  'hub' => '/trust/',        'eyebrow' => 'Trust & Governance', 'icon' => 'shield'],
    'core'         => ['label' => 'Acadlytic',     'hub' => null,             'eyebrow' => 'Acadlytic',       'icon' => 'spark'],
    'utility'      => ['label' => 'Acadlytic',     'hub' => null,             'eyebrow' => 'Acadlytic',       'icon' => 'spark'],
];
