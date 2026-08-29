<?php
/**
 * @var ReferenceArticlePage $page
 * @var string|null $intro
 * @var Kirby\Reference\Reflectable\Tags\Parameters|array $parameters
 * @var Kirby\Reference\Reflectable\Reflectable|null $reflectable
 * @var string|null $title
 */

$title         ??= 'Parameters';
$intro         ??= null;
$reflectable   ??= $page->reflection();
$parameters    ??= $reflectable?->parameters();
$hasDescriptions = $parameters?->hasDescriptions() ?? false;
$parameters    ??= [];

if (count($parameters) === 0) {
	return;
}

$title = $title ? '## ' . $title : null;
$intro = $intro ? kirbytagsToMarkdown($intro) : null;

$table = markdownTable(
    columns: [
        'Name',
        'Type',
        'Default',
        'Description',
    ],
    rows: array_map(fn ($parameter) => [
        'Name'        => '`' . $parameter->name() . '`' . ($parameter->isRequired() ? ' (required)' : ''),
        'Type'        => $parameter->types()->toMarkdown(fallback: 'mixed'),
        'Default'     => $parameter->default() ? '`' . $parameter->default() . '`' : '–',
        'Description' => $parameter->description() ?? '–',
    ], [...$parameters])
);

echo cleanUpMarkdown(<<<MARKDOWN

$title

$intro

$table

MARKDOWN);
?>
