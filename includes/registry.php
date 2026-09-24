<?php
/**
 * Content registry: loads every page definition from data/pages/*.php,
 * applies section defaults and answers lookups for routing, navigation,
 * related links, search and the sitemap.
 */
declare(strict_types=1);

/** /core/ pages that describe planned product capabilities. */
const ACAD_PLANNED_CORE = ['/core/academic-management/', '/core/edtech-crm/', '/core/cloud-platform/', '/core/ai-assistant/', '/core/security/'];

function acad_sections(): array
{
    static $sections = null;
    return $sections ??= require ACAD_ROOT . '/data/sections.php';
}

function acad_pages(): array
{
    static $pages = null;
    if ($pages !== null) {
        return $pages;
    }
    $pages = [];
    $files = glob(ACAD_ROOT . '/data/pages/*.php') ?: [];
    sort($files);
    foreach ($files as $file) {
        $defs = require $file;
        foreach ($defs as $path => $page) {
            if (isset($pages[$path])) {
                throw new RuntimeException("Duplicate page path {$path} in {$file}");
            }
            $page['source'] = basename($file);
            $pages[$path] = acad_normalize_page($path, $page);
        }
    }
    return $pages;
}

function acad_normalize_page(string $path, array $page): array
{
    $segments = array_values(array_filter(explode('/', $path)));
    $first = $segments[0] ?? '';
    $sections = acad_sections();
    $section = $page['section'] ?? ($sections[$first] ?? null ? $first : 'home');
    $meta = $sections[$section] ?? ['label' => 'Acadlytic', 'hub' => '/', 'eyebrow' => 'Acadlytic'];

    $isHub = $path === ($meta['hub'] ?? null);
    // Product sections describe capabilities that are in development.
    $planned = !empty($meta['planned']) || in_array($path, ACAD_PLANNED_CORE, true);
    $defaults = [
        'path'      => $path,
        'section'   => $section,
        'template'  => $isHub ? 'hub' : 'article',
        'eyebrow'   => $meta['eyebrow'] ?? $meta['label'],
        'parent'    => $isHub || $path === '/' ? '/' : ($meta['hub'] ?? '/'),
        'nav_label' => $page['h1'] ?? '',
        'blocks'    => [],
        'related'   => [],
        'noindex'   => false,
        'lead'      => $page['desc'] ?? '',
        'priority'  => $isHub ? 0.8 : 0.6,
        'icon'      => $meta['icon'] ?? 'spark',
        'status'    => $planned ? 'planned' : null,
        'legal_draft' => false,
    ];
    $page = array_replace($defaults, $page);
    // Legal drafts stay out of search results until counsel approves them.
    if (!empty($page['legal_draft'])) {
        $page['noindex'] = true;
    }
    return $page;
}

function acad_page(string $path): ?array
{
    return acad_pages()[$path] ?? null;
}

function acad_redirects(): array
{
    static $redirects = null;
    return $redirects ??= require ACAD_ROOT . '/data/redirects.php';
}

/** Pages that list $hub as their parent, in registry order. */
function acad_children(string $hub): array
{
    return array_filter(acad_pages(), static fn(array $p) => $p['parent'] === $hub && $p['path'] !== $hub);
}

/** Indexable public pages (sitemap, HTML sitemap, search). */
function acad_public_pages(): array
{
    return array_filter(acad_pages(), static fn(array $p) => empty($p['noindex']));
}

/** Breadcrumb trail from home to the page. */
function acad_breadcrumbs(array $page): array
{
    $trail = [];
    $cursor = $page;
    $guard = 0;
    while ($cursor && $cursor['path'] !== '/' && $guard++ < 6) {
        array_unshift($trail, ['path' => $cursor['path'], 'label' => $cursor['nav_label'] ?: $cursor['h1']]);
        $cursor = $cursor['parent'] !== $cursor['path'] ? acad_page($cursor['parent']) : null;
    }
    array_unshift($trail, ['path' => '/', 'label' => 'Home']);
    return $trail;
}

/**
 * Related pages: explicit `related` first, then siblings in the same
 * section, capped. Keeps internal linking contextual rather than random.
 */
function acad_related(array $page, int $limit = 6): array
{
    $out = [];
    foreach ($page['related'] as $path) {
        $target = acad_page($path);
        if ($target && $path !== $page['path']) {
            $out[$path] = $target;
        }
    }
    if (count($out) < 3) {
        foreach (acad_children($page['parent']) as $path => $sibling) {
            if (count($out) >= $limit) {
                break;
            }
            if ($path !== $page['path'] && empty($sibling['noindex']) && !isset($out[$path])) {
                $out[$path] = $sibling;
            }
        }
    }
    return array_slice($out, 0, $limit, true);
}

/** Headings of text-like blocks, used for the "On this page" panel. */
function acad_outline(array $page): array
{
    $out = [];
    foreach ($page['blocks'] as $i => $block) {
        if (!empty($block['h'])) {
            $out['s' . ($i + 1)] = $block['h'];
        }
    }
    return $out;
}

/** Plain text of a page, used by site search and QA. */
function acad_page_text(array $page): string
{
    $parts = [$page['title'], $page['desc'], $page['h1'], $page['lead']];
    $structural = ['type', 'h', 'p', 'intro', 'items', 'head', 'rows', 'label', 'text', 'points', 'pt'];
    $walk = static function (array $node) use (&$walk, &$parts, $structural): void {
        foreach ($node as $key => $value) {
            if (is_string($key) && !in_array($key, $structural, true)) {
                $parts[] = $key; // card / step / FAQ titles are stored as keys
            }
            if (is_array($value)) {
                $walk($value);
            } elseif (is_string($value) && $key !== 'type') {
                $parts[] = $value;
            }
        }
    };
    $walk($page['blocks']);
    return trim(implode(' ', $parts));
}
