<?php

use Kirby\Cms\Pages;
use Kirby\Cms\Page;
use Kirby\Http\Remote;
use Kirby\Toolkit\Str;

return function () {
	$pages = new Pages();

	try {
		$plugins = Remote::get('https://plugins.getkirby.com/plugins.json')->json();

		foreach ($plugins as $plugin) {
			$slug = 'plugins/' . Str::after($plugin['url'], 'https://plugins.getkirby.com/');

			$pages->append(
				Page::factory([
					'slug'     => $slug,
					'template' => 'plugin',
					'model'    => 'plugin',
					'url'      => $plugin['url'],
					'content'  => [
						'title'       => $plugin['title'],
						'description' => $plugin['description'],
						'keywords'    => implode(', ', $plugin['topics'] ?? []),
						'text'        => $plugin['text'] ?? '',
					]
				])
			);
		}
	} catch (Throwable) {
		//
	}

	return $pages;
};
