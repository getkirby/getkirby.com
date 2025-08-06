<?php

use Kirby\Reference\Reflectable\ReflectableClassMethod;

$reflection = $page->reflection();

if ($reflection instanceof ReflectableClassMethod === false) {
	return;
}

$class     = $reflection->class(typed: true)->toMarkdown();
$inherited = $reflection->inheritedFrom() ? 'inherited from ' . $reflection->inheritedFrom()->toMarkdown() : null;

echo cleanUpMarkdown(<<<MARKDOWN

## Parent class

$class $inherited

MARKDOWN);
