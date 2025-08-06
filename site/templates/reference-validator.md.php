<?php

layout('article.md');

$call = snippet('templates/reference/entry/call.md', return: true);
$text = $page->text()->convertToMarkdown();

echo cleanUpMarkdown(<<<MARKDOWN

$call

$text

MARKDOWN);
