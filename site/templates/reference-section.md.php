<?php

layout('reference.md');

$entries = trim(snippet('templates/reference/section.md', ['section' => $page], return: true));
$text    = $page->text()->convertToMarkdown();

echo cleanUpMarkdown(<<<MARKDOWN

$entries

$text

MARKDOWN);
