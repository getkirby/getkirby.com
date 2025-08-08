<?php

layout('reference.md');

$call  = snippet('templates/reference/entry/call.md', return: true);
$class = snippet('templates/reference/entry/class.md', return: true);
$text  = $page->text()->convertToMarkdown();

echo cleanUpMarkdown(<<<MARKDOWN

$call

$class

$text

MARKDOWN);
