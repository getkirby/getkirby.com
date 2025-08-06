<?php

layout('article.md');

$example = $page->example()->convertToMarkdown();
$details = $page->details()->convertToMarkdown();
$table   = markdownTable(
    columns: [
        'Name',
        'Type',
    ],
    rows: array_map(fn ($parameter) => [
        'Name' => '`' . $parameter->name() . '`',
        'Type' => $parameter->types()->toMarkdown(fallback: 'mixed'),
    ], [...$parameters])
);

echo cleanUpMarkdown(<<<MARKDOWN

$example

$table

$details

MARKDOWN);
