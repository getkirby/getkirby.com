<?php

use Kirby\Reference\Reflectable\ReflectableFunction;

$reflection = $page->reflection();
$returns    = $reflection->returns();

if ($reflection instanceof ReflectableFunction === false || $returns === null || $returns?->isVoid() === true) {
	return;
}

$headline            = $returns->headline();
$types               = $returns->types()->toMarkdown();
$description         = $returns->description();
$mutationDescription = kirbytagsToMarkdown($reflection->mutationDescription());

echo cleanUpMarkdown(<<<MARKDOWN
## $headline

$types

$description

$mutationDescription

MARKDOWN);

?>
