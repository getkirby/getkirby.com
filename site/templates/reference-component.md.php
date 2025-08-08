<?php

layout('reference.md');

$parameters = snippet('templates/reference/entry/parameters.md', return: true);
$returns    = snippet('templates/reference/entry/returns.md', return: true);
$text       = $page->text()->convertToMarkdown();

echo cleanUpMarkdown(<<<MARKDOWN

$text

$parameters

$returns

MARKDOWN);
