<?php

layout('reference.md');

$text       = $page->text()->convertToMarkdown();
$parameters = snippet('templates/reference/entry/parameters.md', [
	'title'       => 'Field options',
	'reflectable' => $page->options()
], return: true);

echo cleanUpMarkdown(<<<MARKDOWN

$parameters

$text

MARKDOWN);
