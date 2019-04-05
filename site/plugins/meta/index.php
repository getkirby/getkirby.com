<?php

use Kirby\Meta\PageMeta;
use Kirby\Toolkit\File;
use Kirby\Toolkit\Xml;
use Kirby\Toolkit\Str;
use Kirby\Http\Response;

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/helpers.php';

Kirby::plugin('kirby/meta', [

    'options' => [
        'templatesInclude' => [],
        'pagesInclude' => [],
        'pagesExclude' => [],
    ],

    'routes' => [
        [
            'pattern' => 'meta-debug',
            'action' => function () {

                if (option('debug') === true) {
                    return Page::factory([
                        'slug' => 'meta-debug',
                        'template' => 'meta-debug',
                        'model' => 'meta-debug',
                        'content' => [
                            'title' => 'Metadata debug',
                        ]
                    ]);
                }

                $this->next();
            },
        ],
        [
            'pattern' => 'robots.txt',
            'method'  => 'ALL',
            'action'  => function () {
                $robots  = 'User-agent: *' . PHP_EOL;
                $robots .= 'Allow: /' . PHP_EOL;
                $robots .= 'Sitemap: ' . url('sitemap.xml');

                return kirby()
                    ->response()
                    ->type('text')
                    ->body($robots);
            }
        ],
        [
            'pattern' => 'sitemap.xml',
            'action' => function () {

                $sitemap = [];
                $templatesWhitelist = option('kirby.meta.templatesInclude', []);
                $pagesWhitelist = option('kirby.meta.pagesInclude', []);
                $pagesBlacklist = option('kirby.meta.pagesExclude', []);

                $blacklistPattern = '!^(?:' . implode('|', $pagesBlacklist) . ')$!i';

                $cache   = kirby()->cache('pages');
                $cacheId = 'sitemap.xml';

                if (!$sitemap = $cache->get($cacheId)) {

                    $sitemap[] = '<?xml version="1.0" encoding="UTF-8"?>';
                    $sitemap[] = '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

                    foreach (site()->index() as $item) {

                        if (in_array($item->intendedTemplate()->name(), $templatesWhitelist) === false && in_array($item->id(), $pagesWhitelist) === false) {
                            continue;
                        }

                        if (preg_match($blacklistPattern, $item->id())) {
                            continue;
                        }

                        $meta = $item->meta();

                        $sitemap[] = '<url>';
                        $sitemap[] = '  <loc>' . Xml::encode($item->url()) . '</loc>';
                        $sitemap[] = '  <priority>' . number_format($meta->priority(), 1, '.', '') . '</priority>';

                        $changefreq = $meta->changefreq();
                        if ($changefreq->isNotEmpty()) {
                            $sitemap[] = '  <changefreq>' . $changefreq . '</changefreq>';
                        }

                        $sitemap[] = '</url>';
                    }

                    $sitemap[] = '</urlset>';
                    $sitemap   = implode(PHP_EOL, $sitemap);

                    $cache->set($cacheId, $sitemap);
                }

                return new Response($sitemap, 'application/xml');
            }
        ],
        [
            'pattern' => 'open-search.xml',
            'action' => function () {
                return new Response('<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL .
                    '<OpenSearchDescription xmlns="http://a9.com/-/spec/opensearch/1.1/" xmlns:moz="http://www.mozilla.org/2006/browser/search/">' . PHP_EOL .
                    '  <ShortName>' . site()->title()->xml() . '</ShortName>' . PHP_EOL .
                    '  <Description>Search the Kirby website and documentation.</Description>' . PHP_EOL .
                    '  <InputEncoding>UTF-8</InputEncoding>' . PHP_EOL .
                    '  <Image width="16" height="16" type="image/x-icon">' . ('favicon.ico') . '</Image>' . PHP_EOL .
                    '  <Image width="64" height="64" type="image/png">' . (new File(kirby()->root('index') .'/opensearch.png'))->base64() . '</Image>' . PHP_EOL .
                    '  <Url type="text/html" template="' . url('search') . '">' . PHP_EOL .
                    '    <Param name="q" value="{searchTerms}"/>' . PHP_EOL .
                    '  </Url>' . PHP_EOL .
                    '  <Url type="application/opensearchdescription+xml" rel="self" template="' . Xml::encode(url('open-search.xml')) . '" />' . PHP_EOL .
                    '  <moz:SearchForm>' . Xml::encode(url('search')) . '</moz:SearchForm>' . PHP_EOL .
                    '</OpenSearchDescription>',
                    'application/opensearchdescription+xml');
            }
        ]
    ],

    'pageMethods' => [
        'meta' => function () {
            return new PageMeta($this);
        }
    ],

    'pageModels' => [
        'meta-debug' => 'Kirby\\Meta\\Models\\MetaDebugPage',
    ],

    'templates' => [
        'meta-debug' => __DIR__ . '/templates/meta-debug.php',
    ]
]);
