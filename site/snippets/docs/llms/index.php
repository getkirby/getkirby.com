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

		echo '- [' . Str::unhtml($page->title()->value()) . '](' . $page->menuUrl() . '.md)' . PHP_EOL;
		$children = $page->children()->listed();
		if ($children->count()) {
			printLinks($children);
		}
	}
}

?>

# <?= site()->title() ?> Docs

> The official Kirby CMS documentation for <?= site()->title() ?>, covering Guides, Reference, Cookbook and Quicktips.

<?php snippet('docs/llms/index/guide', ['docs' => $docs->find('guide')]) ?>
****

<?php snippet('docs/llms/index/reference', ['docs' => $docs->find('reference')]) ?>
****

<?php snippet('docs/llms/index/cookbook', ['docs' => $docs->find('cookbook')]) ?>
****

<?php snippet('docs/llms/index/quicktips', ['docs' => $docs->find('quicktips')]) ?>

