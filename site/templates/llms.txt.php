<?php
/**
 * @var $site \Kirby\Cms\Site
 */
header('Content-Type: text/plain; charset=UTF-8');

$ignore   = [];
$sections = [
	'guide'     => 'Guides',
	'reference' => 'Reference',
	'cookbook'  => 'Cookbook',
	'quicktips' => 'Quicktips'
];

function printLinks($pages): void
{
	foreach ($pages as $page) {
		echo '- [' . $page->title()->html() . '](' . $page->url() . '.md)' . PHP_EOL;
		$children = $page->children()->listed();
		if ($children->count()) {
			printLinks($children);
		}
	}
}

echo '# ' . $site->title() . ' Docs' . PHP_EOL . PHP_EOL;
echo '> The official Kirby CMS documentation for ' . $site->title() . ', covering Guides, Reference, Cookbook, and Quicktips.' . PHP_EOL . PHP_EOL;

$docs = page('docs')->children()->listed();

foreach ($sections as $uid => $label) {
	$section = $docs->find($uid);

	if (
		$section === null ||
		in_array($section->intendedTemplate()->name(), $ignore)
	) {
		continue;
	}

	echo '## ' . $label . PHP_EOL;
	printLinks($section->children()->listed());
	echo PHP_EOL;
}

