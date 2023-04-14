<?php

use Kirby\Cms\App;
use Kirby\Meta\PageMeta;
use Kirby\Meta\SiteMeta;

load([
    'kirby\\meta\\pagemeta' => __DIR__ . '/src/PageMeta.php',
    'kirby\\meta\\sitemeta' => __DIR__ . '/src/SiteMeta.php'
]);

App::plugin('kirby/meta', [
    'routes' => [
        [
            'pattern' => 'robots.txt',
            'method'  => 'ALL',
            'action'  => fn () => SiteMeta::robots()
        ],
        [
            'pattern' => 'sitemap.xml',
            'action'  => fn () => SiteMeta::sitemap()
        ],
        [
            'pattern' => 'open-search.xml',
            'action'  => fn () => SiteMeta::search()
        ],
        [
            'pattern' => '(:all)/opengraph.png',
            'action'  => fn (string $id) => PageMeta::renderThumbnail($id)
        ]
    ],
    'pageMethods' => [
        'meta'     => fn () => new PageMeta($this),
        'metaLead' => function ($root = null, $fallback = null) {
            $crumbs = $this->parents()->flip();

            if ($root !== null) {
                $crumbs = $crumbs->not($root->parents());
            }

            $lead = implode(
                ' / ',
                $crumbs->toArray(fn ($p) => (string)$p->title())
            );

            if (empty($lead) === true) {
                $lead = $fallback;
            }

            return $lead;
        }
    ]
]);
