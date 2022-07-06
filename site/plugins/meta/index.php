<?php

use Kirby\Meta\PageMeta;
use Kirby\Meta\SiteMeta;
use Kirby\Toolkit\Tpl;

load([
	'kirby\\meta\\pagemeta' => __DIR__ . '/src/PageMeta.php',
	'kirby\\meta\\sitemeta' => __DIR__ . '/src/SiteMeta.php'
]);

Kirby::plugin('kirby/meta', [
	'routes' => [
		[
			'pattern' => 'robots.txt',
			'method' => 'ALL',
			'action' => function () {
				return SiteMeta::robots();
			},
		],
		[
			'pattern' => 'sitemap.xml',
			'action' => function () {
				return SiteMeta::sitemap();
			}
		],
		[
			'pattern' => 'open-search.xml',
			'action' => function () {
				return SiteMeta::search();
			},
		],
		[
			'pattern' => '(:all)/opengraph.png',
			'action' => function (string $id) {
				return PageMeta::renderThumbnail($id);
			},
		]
	],
	'pageMethods' => [
		'meta' => function () {
			return new PageMeta($this);
		},
		'metaLead' => function ($root = null, $fallback = null) {
			$crumbs = $this->parents()->flip();

			if ($root !== null) {
				$crumbs = $crumbs->not($root->parents());
			}

			$lead = implode(' / ', $crumbs->toArray(function ($p) {
				return (string)$p->title();
			}));

			if (empty($lead) === true) {
				$lead = $fallback;
			}

			return $lead;
		}
	]
]);
