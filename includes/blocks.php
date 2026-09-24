<?php
/**
 * Renders content blocks defined with includes/content-dsl.php.
 * Every string is escaped; content files never contain raw HTML.
 */
declare(strict_types=1);

/**
 * Inline formatting for content strings: **bold**, [label](/path) and
 * [label](mailto:address).
 * Applied after escaping, so only these two patterns become markup.
 */
function acad_inline(string $text): string
{
    $html = e($text);
    $html = preg_replace('/\*\*(.+?)\*\*/', '<strong>$1</strong>', $html) ?? $html;
    return preg_replace_callback('/\[([^\]]+)\]\((\/[^)\s]*|mailto:[^)\s]+|https:\/\/[^)\s]+)\)/', static function (array $m): string {
        // External links (https://) are marked as such and never pass referrer data.
        $external = str_starts_with($m[2], 'https://') ? ' rel="noopener noreferrer external"' : '';
        return '<a href="' . $m[2] . '"' . $external . '>' . $m[1] . '</a>';
    }, $html) ?? $html;
}

/** Content string without inline markup, for structured data and llms.txt. */
function acad_plain(string $text): string
{
    $text = preg_replace('/\[([^\]]+)\]\((?:\/[^)\s]*|mailto:[^)\s]+|https:\/\/[^)\s]+)\)/', '$1', $text) ?? $text;
    return str_replace('**', '', $text);
}

/** Pages that show a visible “Last updated” line and carry Article schema. */
function acad_is_editorial(array $page): bool
{
    return $page['template'] === 'article' && empty($page['noindex']) && $page['path'] !== '/resources/faqs/'
        && in_array($page['section'], ['resources', 'comparisons', 'glossary'], true);
}

function acad_page_updated(array $page): string
{
    return (string) ($page['updated'] ?? acad_config('content_updated'));
}

function acad_render_blocks(array $page): string
{
    $out = '';
    $icons = ['spark', 'workflow', 'chart', 'shield', 'users', 'cloud', 'doc', 'compass', 'layers', 'message', 'task', 'globe'];
    foreach ($page['blocks'] as $i => $b) {
        $id = 's' . ($i + 1);
        $heading = !empty($b['h']) ? '<h2 id="' . $id . '-h">' . e($b['h']) . '</h2>' : '';
        $intro = !empty($b['intro']) ? '<p class="block-intro">' . acad_inline($b['intro']) . '</p>' : '';
        $label = !empty($b['h']) ? ' aria-labelledby="' . $id . '-h"' : '';
        $open = '<section class="block block-' . e($b['type']) . '" id="' . $id . '"' . $label . '>';

        switch ($b['type']) {
            case 'text':
                $body = '';
                foreach ($b['p'] as $p) {
                    $body .= '<p>' . acad_inline($p) . '</p>';
                }
                $out .= $open . $heading . '<div class="prose">' . $body . '</div></section>';
                break;

            case 'cards':
                $items = '';
                $n = 0;
                foreach ($b['items'] as $title => $text) {
                    $ic = $icons[($i * 3 + $n++) % count($icons)];
                    $items .= '<article class="info-card"><span class="info-icon">' . icon($ic) . '</span><h3>'
                        . e((string) $title) . '</h3><p>' . acad_inline($text) . '</p></article>';
                }
                $cols = count($b['items']) % 3 === 0 || count($b['items']) > 4 ? 'cols-3' : 'cols-2';
                $out .= $open . $heading . $intro . '<div class="card-grid ' . $cols . '">' . $items . '</div></section>';
                break;

            case 'steps':
                $items = '';
                foreach ($b['items'] as $title => $text) {
                    $items .= '<li><h3>' . e((string) $title) . '</h3><p>' . acad_inline($text) . '</p></li>';
                }
                $out .= $open . $heading . $intro . '<ol class="steps">' . $items . '</ol></section>';
                break;

            case 'checks':
                $items = '';
                foreach ($b['items'] as $text) {
                    $items .= '<li>' . icon('check', 'icon check-icon') . '<span>' . acad_inline($text) . '</span></li>';
                }
                $out .= $open . $heading . $intro . '<ul class="checklist">' . $items . '</ul></section>';
                break;

            case 'table':
                $head = '';
                foreach ($b['head'] as $h) {
                    $head .= '<th scope="col">' . e($h) . '</th>';
                }
                $rows = '';
                foreach ($b['rows'] as $row) {
                    $cells = '';
                    foreach (array_values($row) as $c => $cell) {
                        $cells .= $c === 0 ? '<th scope="row">' . acad_inline($cell) . '</th>' : '<td>' . acad_inline($cell) . '</td>';
                    }
                    $rows .= '<tr>' . $cells . '</tr>';
                }
                $out .= $open . $heading . $intro . '<div class="table-wrap" role="region" aria-label="' . e($b['h'] . ' (scrollable table)') . '" tabindex="0"><table><thead><tr>'
                    . $head . '</tr></thead><tbody>' . $rows . '</tbody></table></div></section>';
                break;

            case 'faq':
                $items = '';
                foreach ($b['items'] as $q => $a) {
                    $items .= '<details class="faq-item"><summary>' . e((string) $q) . icon('chevron', 'icon faq-chevron') . '</summary><div class="faq-body"><p>'
                        . acad_inline($a) . '</p></div></details>';
                }
                $out .= $open . $heading . '<div class="faq-list">' . $items . '</div></section>';
                break;

            case 'note':
                $out .= '<aside class="block note" aria-label="' . e($b['label']) . '"><strong>' . e($b['label']) . '</strong><p>' . acad_inline($b['text']) . '</p></aside>';
                break;

            case 'takeaways':
                $items = '';
                foreach ($b['items'] as $text) {
                    $items .= '<li>' . acad_inline($text) . '</li>';
                }
                $out .= '<section class="block takeaways" id="' . $id . '" aria-labelledby="' . $id . '-h"><h2 id="' . $id . '-h">' . e($b['h']) . '</h2><ul>' . $items . '</ul></section>';
                break;

            case 'definition':
                $out .= '<section class="block definition" aria-label="Definition"><span class="def-label">Definition</span><p>' . acad_inline($b['text']) . '</p></section>';
                break;

            case 'split':
                $body = '';
                foreach ($b['p'] as $p) {
                    $body .= '<p>' . acad_inline($p) . '</p>';
                }
                $pts = '';
                foreach ($b['points'] as $pt) {
                    $pts .= '<li>' . icon('check', 'icon check-icon') . '<span>' . acad_inline($pt) . '</span></li>';
                }
                $out .= $open . '<div class="split"><div class="prose">' . $heading . $body . '</div><aside class="split-panel"><h3>' . e($b['pt']) . '</h3><ul class="checklist compact">' . $pts . '</ul></aside></div></section>';
                break;
        }
    }
    return $out;
}
