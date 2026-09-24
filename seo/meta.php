<?php
/**
 * SEO helpers: document title, meta description, robots, canonical,
 * Open Graph, X (Twitter) cards and JSON-LD structured data.
 *
 * Structured data is limited to facts supplied by Acadlytic (name, URL,
 * logo, contact details, official profiles). No ratings, customer counts,
 * prices or certifications are emitted. SoftwareApplication is omitted
 * because Google requires offers/ratings that cannot be stated truthfully.
 */
declare(strict_types=1);

function acad_doc_title(array $page): string
{
    $title = $page['title'];
    return str_contains($title, 'Acadlytic') ? $title : $title . ' | Acadlytic';
}

function acad_head_meta(array $page): string
{
    $title = acad_doc_title($page);
    $desc = $page['desc'];
    $canonical = acad_url($page['path']);
    $image = acad_url('/assets/img/og-image.png');
    $robots = !empty($page['noindex'])
        ? 'noindex, nofollow'
        : 'index, follow, max-image-preview:large, max-snippet:-1';

    $tags = [
        '<title>' . e($title) . '</title>',
        '<meta name="description" content="' . e($desc) . '">',
        '<meta name="robots" content="' . $robots . '">',
    ];
    if (empty($page['noindex'])) {
        $tags[] = '<link rel="canonical" href="' . e($canonical) . '">';
    }
    $tags = array_merge($tags, [
        '<meta property="og:type" content="' . ($page['path'] === '/' ? 'website' : 'article') . '">',
        '<meta property="og:site_name" content="' . e(acad_config('name')) . '">',
        '<meta property="og:locale" content="' . e(acad_config('locale')) . '">',
        '<meta property="og:title" content="' . e($title) . '">',
        '<meta property="og:description" content="' . e($desc) . '">',
        '<meta property="og:url" content="' . e($canonical) . '">',
        '<meta property="og:image" content="' . e($image) . '">',
        '<meta property="og:image:width" content="1200">',
        '<meta property="og:image:height" content="630">',
        '<meta property="og:image:alt" content="Acadlytic, Inc. logo: Where Education Meets Intelligence.">',
        '<meta name="twitter:card" content="summary_large_image">',
        '<meta name="twitter:site" content="' . e(acad_config('x_handle')) . '">',
        '<meta name="twitter:title" content="' . e($title) . '">',
        '<meta name="twitter:description" content="' . e($desc) . '">',
        '<meta name="twitter:image" content="' . e($image) . '">',
    ]);

    foreach (acad_schema($page) as $graph) {
        $tags[] = '<script type="application/ld+json">'
            . json_encode($graph, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP)
            . '</script>';
    }
    return implode("\n", $tags) . "\n";
}

function acad_org_schema(): array
{
    $c = acad_config();
    return [
        '@type'       => 'Organization',
        '@id'         => acad_url('/#organization'),
        'name'        => $c['name'],
        'alternateName' => $c['short_name'],
        'url'         => acad_url('/'),
        'logo'        => [
            '@type' => 'ImageObject',
            'url'   => acad_url('/assets/img/logo-square.png'),
            'width' => 512,
            'height' => 512,
        ],
        'slogan'      => $c['tagline'],
        'description' => $c['descriptor'],
        'email'       => $c['email'],
        'telephone'   => $c['phone'],
        'contactPoint' => [[
            '@type'       => 'ContactPoint',
            'contactType' => 'sales',
            'email'       => $c['email'],
            'telephone'   => $c['phone'],
            'availableLanguage' => ['English'],
        ]],
        'sameAs'      => array_values(array_map(static fn(array $s) => $s['url'], $c['social'])),
    ];
}

function acad_schema(array $page): array
{
    if (!empty($page['noindex'])) {
        return [];
    }
    $graphs = [];
    $website = [
        '@type'     => 'WebSite',
        '@id'       => acad_url('/#website'),
        'url'       => acad_url('/'),
        'name'      => acad_config('short_name'),
        'publisher' => ['@id' => acad_url('/#organization')],
        'inLanguage' => acad_config('language'),
    ];

    if ($page['path'] === '/') {
        $graphs[] = ['@context' => 'https://schema.org', '@graph' => [
            acad_org_schema(),
            $website,
        ]];
        return $graphs;
    }

    $webPage = [
        '@type'      => 'WebPage',
        '@id'        => acad_url($page['path']) . '#webpage',
        'url'        => acad_url($page['path']),
        'name'       => $page['h1'],
        'description' => $page['desc'],
        'isPartOf'   => ['@id' => acad_url('/#website')],
        'inLanguage' => acad_config('language'),
    ];
    if (in_array($page['path'], ['/core/about/', '/core/contact/'], true)) {
        $webPage['@type'] = $page['path'] === '/core/about/' ? 'AboutPage' : 'ContactPage';
        $webPage['about'] = ['@id' => acad_url('/#organization')];
    }

    $crumbs = [];
    foreach (acad_breadcrumbs($page) as $i => $crumb) {
        $crumbs[] = [
            '@type'    => 'ListItem',
            'position' => $i + 1,
            'name'     => $crumb['label'],
            'item'     => acad_url($crumb['path']),
        ];
    }

    $graph = [$webPage, ['@type' => 'BreadcrumbList', 'itemListElement' => $crumbs]];

    if (in_array($page['path'], ['/core/about/', '/core/contact/'], true)) {
        $graph[] = acad_org_schema();
    }

    if ($page['section'] === 'glossary' && $page['template'] === 'article') {
        foreach ($page['blocks'] as $block) {
            if ($block['type'] === 'definition') {
                $graph[] = [
                    '@type'       => 'DefinedTerm',
                    'name'        => $page['nav_label'] ?: $page['h1'],
                    'description' => $block['text'],
                    'url'         => acad_url($page['path']),
                    'inDefinedTermSet' => [
                        '@type' => 'DefinedTermSet',
                        'name'  => 'Acadlytic EdTech Glossary',
                        'url'   => acad_url('/glossary/'),
                    ],
                ];
                break;
            }
        }
    }

    $graphs[] = ['@context' => 'https://schema.org', '@graph' => $graph];
    return $graphs;
}
