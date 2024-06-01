<?php

use Caxy\HtmlDiff\HtmlDiff;
use Kirby\Cms\App;
use Kirby\Cms\Page;

return function (App $kirby, Page $page) {
	// redirect from the parent to the latest version
	if ($latest = $page->latestVersion()) {
		return go($latest, 302);
	}

	$introDiff = $textDiff = null;

	if (get('diff') !== null && $page->hasPrev()) {
		// try to get the diff from cache
		$prevPage = $page->prev();
		$cacheKey = $page->parent()->uri() . '/' . $prevPage->uid() . '_' . $page->uid();
		$cache    = $kirby->cache('diffs');
		$diff     = $cache->get($cacheKey);

		if (!$diff) {
			$diff = [];

			// keep heading IDs for TOC links
			$config = HTMLPurifier_Config::createDefault();
			$config->set('Attr.EnableID', true);

			$introDiffObj = new HtmlDiff($page->prev()->intro()->kt(), $page->intro()->kt());
			$introDiffObj->setHTMLPurifierConfig(clone $config);
			$diff['intro'] = $introDiffObj->build();

			$textDiffObj = new HtmlDiff($page->prev()->text()->kt(), $page->text()->kt());
			$textDiffObj->setHTMLPurifierConfig(clone $config);
			$diff['text'] = $textDiffObj->build();

			$cache->set($cacheKey, $diff);
		}

		$introDiff = $diff['intro'];
		$textDiff  = $diff['text'];
	}

	$siblings = $page->siblings()->flip();
	return compact('introDiff', 'textDiff', 'siblings');
};
