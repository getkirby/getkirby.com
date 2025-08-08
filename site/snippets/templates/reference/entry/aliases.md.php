<?php

use Kirby\Toolkit\A;

$aliases = $page->reflection()->aliases();

if (count($aliases) === 0) {
	return;
}

$aliases = markdownList(A::map($aliases, fn ($alias) => '`$field->' . $alias . '(…)`'));

echo cleanUpMarkdown(<<<MARKDOWN

## Aliases

You can use the following aliases for this field method in your template:

$aliases

MARKDOWN);
