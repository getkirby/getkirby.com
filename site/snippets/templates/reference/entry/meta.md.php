<?php

use Kirby\Cms\App;
use Kirby\Reference\Reflectable\ReflectableClass;
use Kirby\Toolkit\Str;

$reflection = $page->reflection();
$since      = $page->since();
$alias      = $reflection?->alias();
$auth       = $page->auth()->value();
$read       = $page->read()->value();
$source     = $page->source();

$html = [];

if ($since || $reflection instanceof ReflectableClass || $alias || $auth || $read || $source) {
	$html[] = markdownList([
		$since ? 'Since ' . $since->toMarkdown() : null,
		$reflection instanceof ReflectableClass ? 'Full class name: `' . $reflection->name(short: false) . '`' : null,
		$alias ? 'Alias: `' . $alias . '`' : null,
		$auth ? 'Auth: ' . $auth : null,
		$read ? 'Read more: <' . url($read) . '>' : null,
		$source ? 'Source: <' . $source . '>' : null,
	]);
}

if ($deprecated = $page->deprecated()) {
	$html[] = '<deprecation-warning>';

	if ($version = $deprecated->version()) {
		$html[] = '**Deprecated in ' . version($version, '%s') . '**';
	} else {
		$html[] = '**Deprecated**';
	}

	if ($description = $deprecated->description()) {
		$html[] = $description->convertToMarkdown();
	}

	$html[] = '</deprecation-warning>';
	$html[] = markdownBreak();
}

if ($page->isUnstable() === true) {
	$html[] = '<unstable-notice>';
	$html[] = '`' . $page->title() . '` has been **marked as unstable**. It might be changed in a future Kirby major or minor release without being considered a breaking change. Use with caution.';
	$html[] = '</unstable-notice>';
	$html[] = markdownBreak();
}

echo cleanUpMarkdown(implode(PHP_EOL, $html));
echo markdownHorizontalRule();
