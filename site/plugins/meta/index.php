<?php

use Kirby\Http\Response;
use Kirby\Meta\PageMeta;
use Kirby\Toolkit\File;
use Kirby\Toolkit\Str;
use Kirby\Toolkit\Xml;

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

                if (option('debug') !== true) {
                    $this->next();
                }

                return Page::factory([
                    'slug' => 'meta-debug',
                    'template' => 'meta-debug',
                    'model' => 'meta-debug',
                    'content' => [
                        'title' => 'Metadata debug',
                    ],
                ]);
            },
        ],
        [
            'pattern' => 'meta-check-page',
            'action' => function () {
                if (option('debug') !== true) {
                    $this->next();
                }

                $id = get('id');
                $baseUrl = url();

                if (empty($id) === null) {
                    return Response::json("Empty ID parameter.", 500);
                }

                if (($p = page($id)) === null) {
                    return Response::json("The page with $id could not be found.", 500);
                }

                // intercept redirects, so the link checker always returns
                // a 200 status code.
                $handleRedirect = function () use ($baseUrl) {
                    if (in_array(http_response_code(), [301, 302, 303, 304, 307])) {
                        $target = '';
                        foreach(headers_list() as $header) {
                            if (Str::contains($header, ':') === false) {
                                continue;
                            }
                            
                            list($key, $value) = explode(':', $header, 2);
                            
                            if (strtolower($key) === 'location') {
                                $target = str_replace($baseUrl, '', trim($value));
                                break;
                            }
                        }

                        header_remove('location');
                        Header::success();
                        echo Response::json([
                            'type' => 'redirect',
                            'message' => "Links where not checked, because page is a redirect to:\n$target",
                        ], 200);
                    }
                };
                header_register_callback($handleRedirect);
                register_shutdown_function($handleRedirect);


                $html = $p->render();

                $brokenLinks = [];

                try {
                    $doc = new DOMDocument();
                    $doc->validateOnParse = true;
                    libxml_use_internal_errors(true);
                    $doc->loadHTML($html);
                    libxml_clear_errors();

                    $elements = array_merge(
                        iterator_to_array($doc->getElementsByTagName('a')),
                    );

                    foreach ($elements as $item) {
                        $href = $item->getAttribute('href');

                        if (empty($href) === true || $href === '#') {
                            continue;
                        }

                        if (Str::contains($href, '#') === true) {
                            // anchor link
                        
                            list($targetUrl, $targetId) = explode('#', $href);

                            if (empty($targetUrl) === true || $targetUrl === $p->url()) {
                                $targetEl = $doc->getElementById($targetId);
                            } else {
                                // only evaluate same-page anchor links for now.
                                continue;
                            }

                            if ($targetEl === null) {
                                // broken anchor link
                                $brokenLinks[] = "Broken anchor link: {$href}";
                            }

                            continue;

                        } else {

                            if (Str::startsWith($href, '/')) {
                                $href = $baseUrl . $href;
                            }

                            if (Str::startsWith($href, $baseUrl) === false) {
                                // skip external links
                                continue;
                            }

                            if (Str::contains(pathinfo($href, PATHINFO_BASENAME), '.')) {
                                // skip links to files
                                continue;
                            }

                            $id = trim(parse_url($href, PHP_URL_PATH), '/');

                            if (empty($id) === true) {
                                // skip links to homepage
                                continue;
                            }

                            if (page($id) === null) {
                                // target page does not exist
                                $brokenLinks[] = $id;
                            }
                        }
                    }
                } catch (Exception $e) {
                    return Response::json([
                        'type' => 'page',
                        'message' => $e->getMessage(),
                    ], 500);
                }

                return Response::json([
                    'type' => 'page',
                    'message' => sizeof($brokenLinks) > 0 ? "This page contains some broken links: \n- " . implode("\n- ", $brokenLinks): null,
                    'brokenLinks' => $brokenLinks,
                ], 200);
            },
        ],
        [
            'pattern' => 'robots.txt',
            'method' => 'ALL',
            'action' => function () {
                $robots = 'User-agent: *' . PHP_EOL;
                $robots .= 'Allow: /' . PHP_EOL;
                $robots .= 'Sitemap: ' . url('sitemap.xml');

                return kirby()
                    ->response()
                    ->type('text')
                    ->body($robots);
            },
        ],
        [
            'pattern' => 'sitemap.xml',
            'action' => function () {

                $sitemap = [];
                $templatesWhitelist = option('kirby.meta.templatesInclude', []);
                $pagesWhitelist = option('kirby.meta.pagesInclude', []);
                $pagesBlacklist = option('kirby.meta.pagesExclude', []);

                $blacklistPattern = '!^(?:' . implode('|', $pagesBlacklist) . ')$!i';

                $cache = kirby()->cache('pages');
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
                    $sitemap = implode(PHP_EOL, $sitemap);

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
                    '  <Image width="16" height="16" type="image/x-icon">' . url('favicon.ico') . '</Image>' . PHP_EOL .
                    '  <Image width="64" height="64" type="image/png">' . (new File(kirby()->root('index') . '/opensearch.png'))->base64() . '</Image>' . PHP_EOL .
                    '  <Url type="text/html" method="get" template="' . url('search') . '?q={searchTerms}"/>' . PHP_EOL .
                    '  <Url type="application/opensearchdescription+xml" rel="self" template="' . Xml::encode(url('open-search.xml')) . '"/>' . PHP_EOL .
                    '  <moz:SearchForm>' . Xml::encode(url('search')) . '</moz:SearchForm>' . PHP_EOL .
                    '</OpenSearchDescription>',
                    'application/opensearchdescription+xml');
            },
        ]
    ],

    'pageMethods' => [
        'meta' => function () {
            return new PageMeta($this);
        },
    ],

    'pageModels' => [
        'meta-debug' => 'Kirby\\Meta\\Models\\MetaDebugPage',
    ],

    'templates' => [
        'meta-debug' => __DIR__ . '/templates/meta-debug.php',
    ]
]);
