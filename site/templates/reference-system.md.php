<?php

layout('reference.md');

$example = $page->example()->convertToMarkdown();
$setup   = $page->setup()->convertToMarkdown();
$text    = $page->text()->convertToMarkdown();

echo cleanUpMarkdown(<<<MARKDOWN

## Example

$example

## Custom setup

$setup

$text

MARKDOWN);
