<?php

layout('article.md');

$attributes = snippet('templates/reference/attributes.md', return: true);
$text       = $page->text()->convertToMarkdown();

echo cleanUpMarkdown(<<<MARKDOWN

$attributes

$text

MARKDOWN);
