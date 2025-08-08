<?php

layout('reference.md');

$call    = snippet('templates/reference/entry/call.md', return: true);
$aliases = snippet('templates/reference/entry/aliases.md', return: true);
$text    = $page->text()->convertToMarkdown();

echo cleanUpMarkdown(<<<MARKDOWN

$call

$aliases

$text

MARKDOWN);
