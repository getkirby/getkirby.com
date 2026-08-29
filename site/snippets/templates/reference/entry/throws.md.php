<?php
/**
 * @var ReferenceArticlePage $page
 */

if (!$throws = $page->reflection()->throws()) {
	return;
}

$table = markdownTable(
    columns: [
        'Type',
        'Description',
    ],
    rows: array_map(fn ($exception) => [
        'Type'        => $exception->types()->toMarkdown(),
        'Description' => $exception->description() ?? '–',
    ], [...$throws])
);

echo cleanUpMarkdown(<<<MARKDOWN

## Exceptions

$table

MARKDOWN);
