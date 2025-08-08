<?php

use Kirby\Cms\App;
use Kirby\Cms\Page;
use Kirby\Cms\Pages;
use Kirby\Text\KirbyTags;
use Kirby\Toolkit\A;

function cleanUpMarkdown(string|null $text): string
{
	$text ??= '';

	// replace three consecutive newlines with two
	$text = preg_replace('/\n\n\n/', "\n\n", $text);

	return trim($text);
}

function kirbytagsToMarkdown(string|null $text): string
{
	$text ??= '';

	$kirby = App::instance();

	$data['kirby']  ??= $kirby;
	$data['site']   ??= $kirby->site();
	$data['parent'] ??= $kirby->site()->page();

	$options = $kirby->options();
	$options['kirbytags'] = false;

	$text = $kirby->apply('kirbytags:before', compact('text', 'data', 'options'));
	$text = KirbyTags::parse($text, $data, $options);
	$text = $kirby->apply('kirbytags:after', compact('text', 'data', 'options'));

	// convert (columns…) $1 (…columns) to just $1
	$text = preg_replace_callback('/\(columns…\)(.*?)\(…columns\)/s', function ($matches) {
		return trim($matches[1]);
	}, $text);

	$text = preg_replace('/\n(\+){4,}\n/', "\n****\n", $text);

	// convert (tabs…) $1 (…tabs)
	$text = preg_replace_callback('/\(tabs…\)(.*?)\(…tabs\)/s', function ($matches) {

		$tabs = preg_replace_callback('/\n===(.*?)/', function ($matches) {
			return '### ' . trim($matches[1]);
		}, $matches[1]);

		return trim($tabs);
	}, $text);

	// convert (\file: something) into (file: something)
	$text = $text = preg_replace('/\\(\\\\([^:]+):/', '($1:', $text);

	return cleanUpMarkdown($text);
}

function markdownBreak(): string
{
	return PHP_EOL . PHP_EOL;
}

function markdownCodeBlock(string $code, string $language = 'php'): string
{
	return '```' . $language . PHP_EOL . $code . PHP_EOL . '```' . markdownBreak();
}

function markdownHeading(string $text, int $level = 1): string
{
	return str_repeat('#', $level) . ' ' . $text . markdownBreak();
}

function markdownHorizontalRule(): string
{
	return markdownBreak() . '****' . markdownBreak();
}

function markdownImage(string $url, string $alt = ''): string
{
	return '![' . $alt . '](' . $url . ')';
}

function markdownLink(string $text, string $url): string
{
	return '[' . $text . '](' . $url . ')';
}

function markdownLinkList(Pages|array $items): string
{
	return implode(PHP_EOL, A::map([...$items], fn (Page $page) => '- ' . markdownLink($page->title()->unhtml(), $page->markdownUrl()))) . markdownBreak();
}

function markdownList(array $items): string
{
	// remove empty items
	$items = array_filter($items, fn ($item) => $item !== null && $item !== '');

	// convert items to markdown list items
	$items = A::map($items, fn ($item) => markdownListItem($item));

	return trim(implode('', $items)) . markdownBreak();
}

function markdownListItem(string $item): string
{
	return '- ' . $item . PHP_EOL;
}

function markdownTable(array $columns, array $rows): string
{
	$table[] = markdownTableheader($columns);

	foreach ($rows as $row) {
		$table[] = markdownTableRow($row);
	}

	return implode(PHP_EOL, $table);
}

function markdownTableHeader(array $columns): string
{
	$rows[] = markdownTableRow($columns);
	$rows[] = markdownTableRow(array_fill(0, count($columns), '----'));

	return implode(PHP_EOL, $rows);
}

function markdownTableRow(array $cells): string
{
	return '| ' . implode(' | ', $cells) . ' |';
}
