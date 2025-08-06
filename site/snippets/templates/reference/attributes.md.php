<?php

if (count($attributes) === 0) {
	return;
}

$attributes = implode(', ', array_map(fn ($attribute) => "`$attribute`", $attributes));
$option     = $page->slug();

echo cleanUpMarkdown(<<<MARKDOWN

## Attributes

In addition to the main `$option` option, the tag supports the following attributes: $attributes

MARKDOWN);
