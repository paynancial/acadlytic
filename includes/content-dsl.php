<?php
/**
 * Small helpers used by data/pages/*.php to describe page content as
 * structured blocks. Rendering lives in includes/blocks.php, so content
 * files stay free of markup and can later be migrated into the CMS.
 */
declare(strict_types=1);

/** Heading + one or more paragraphs. */
function sec(string $heading, string ...$paragraphs): array
{
    return ['type' => 'text', 'h' => $heading, 'p' => $paragraphs];
}

/** Card grid. $items: ['Title' => 'Body', ...] */
function cards(string $heading, array $items, string $intro = ''): array
{
    return ['type' => 'cards', 'h' => $heading, 'items' => $items, 'intro' => $intro];
}

/** Ordered process. $items: ['Step title' => 'Body', ...] */
function steps(string $heading, array $items, string $intro = ''): array
{
    return ['type' => 'steps', 'h' => $heading, 'items' => $items, 'intro' => $intro];
}

/** Checklist of plain strings. */
function checks(string $heading, array $items, string $intro = ''): array
{
    return ['type' => 'checks', 'h' => $heading, 'items' => $items, 'intro' => $intro];
}

/** Comparison or reference table. */
function table(string $heading, array $head, array $rows, string $intro = ''): array
{
    return ['type' => 'table', 'h' => $heading, 'head' => $head, 'rows' => $rows, 'intro' => $intro];
}

/** Questions and answers rendered as accessible disclosure widgets. */
function faq(array $items, string $heading = 'Frequently asked questions'): array
{
    return ['type' => 'faq', 'h' => $heading, 'items' => $items];
}

/** Highlighted callout. */
function note(string $text, string $label = 'Good to know'): array
{
    return ['type' => 'note', 'label' => $label, 'text' => $text];
}

/** Answer-first summary shown at the top of guides and comparisons. */
function takeaways(string ...$items): array
{
    return ['type' => 'takeaways', 'h' => 'Key takeaways', 'items' => $items];
}

/** Glossary definition box (rendered prominently, used for DefinedTerm schema). */
function def(string $text): array
{
    return ['type' => 'definition', 'text' => $text];
}

/** Two-column: prose on the left, key points on the right. */
function split(string $heading, array $paragraphs, array $points, string $pointsTitle = 'Key points'): array
{
    return ['type' => 'split', 'h' => $heading, 'p' => $paragraphs, 'points' => $points, 'pt' => $pointsTitle];
}
