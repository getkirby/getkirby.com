<?php
/**
 * @var \Kirby\Cms\Pages $docs
 * @var array $ignore
 */
header('Content-Type: text/plain; charset=UTF-8');


function printLinks($pages, array $ignore = []): void
{
	foreach ($pages as $page) {
		if (in_array($page->intendedTemplate()->name(), $ignore)) {
			continue;
		}

		echo '- [' . $page->title()->html() . '](' . $page->url() . '.md)' . PHP_EOL;
		$children = $page->children()->listed();
		if ($children->count()) {
			printLinks($children);
		}
	}
}

echo '# ' . site()->title() . ' Docs' . PHP_EOL . PHP_EOL;
echo '> The official Kirby CMS documentation for ' . site()->title() . ', covering Guides, Reference, Cookbook and Quicktips.' . PHP_EOL . PHP_EOL;

foreach ($docs as $doc) {
	echo '## ' . $doc->title()->value() . PHP_EOL;
	printLinks($doc->children()->listed(), $ignore);
	echo PHP_EOL;
}

