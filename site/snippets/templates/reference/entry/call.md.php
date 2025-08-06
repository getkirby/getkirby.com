<?php

$parameters = snippet('templates/reference/entry/parameters.md', return: true);
$returns    = snippet('templates/reference/entry/returns.md', return: true);
$throws     = snippet('templates/reference/entry/throws.md', return: true);
$callblock  = null;

if ($call = $page->reflection()->call()) {
	$callblock = <<<MARKDOWN
	```php
	$call
	```
	MARKDOWN;
}

echo cleanUpMarkdown(<<<MARKDOWN
$callblock

$parameters

$returns

$throws
MARKDOWN);
