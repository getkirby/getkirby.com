<?php

layout('article.md');

$entries = snippet('templates/reference/section.md', $entries, return: true);
$text    = $page->text()->convertToMarkdown();

echo cleanUpMarkdown(<<<MARKDOWN

$entries

$text

MARKDOWN);
