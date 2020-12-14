<?php

namespace Kirby\Meta;

use Kirby\Cms\Responder;
use Kirby\Http\Response;
use Kirby\Toolkit\Tpl;
use Kirby\Toolkit\Xml;

class SiteMeta
{


    public static function robots(): Responder
    {
        $robots = 'User-agent: *' . PHP_EOL;
        $robots .= 'Allow: /' . PHP_EOL;
        $robots .= 'Sitemap: ' . url('sitemap.xml');

        return kirby()
            ->response()
            ->type('text')
            ->body($robots);
    }

    public static function search(): Response
    {
        return new Response(
            Tpl::load(__DIR__ . '/snippets/search.php'),
            'application/opensearchdescription+xml'
        );
    }

    public static function sitemap(): Response
    {
        $sitemap = [];
        $cache   = kirby()->cache('pages');
        $cacheId = 'sitemap.xml';

        if (!$sitemap = $cache->get($cacheId)) {
            $sitemap[] = '<?xml version="1.0" encoding="UTF-8"?>';
            $sitemap[] = '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

            $allowTemplates = option('kirby.meta.templatesInclude', []);
            $allowPages     = option('kirby.meta.pagesInclude', []);
            $ignorePages    = option('kirby.meta.pagesExclude', []);
            $ignorePattern  = '!^(?:' . implode('|', $ignorePages) . ')$!i';

            foreach (site()->index() as $item) {

                if (
                    in_array($item->intendedTemplate()->name(), $allowTemplates) === false &&
                    in_array($item->id(), $allowPages) === false
                ) {
                    continue;
                }

                if (preg_match($ignorePattern, $item->id())) {
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
}
