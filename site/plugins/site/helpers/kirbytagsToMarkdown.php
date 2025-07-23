<?php

use Kirby\Cms\App;
use Kirby\Text\KirbyTags;

function kirbytagsToMarkdown(string $text): string
{
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

	// replace three consecutive newlines with two
	$text = preg_replace('/\n\n\n/', "\n\n", $text);

	return $text;
}
