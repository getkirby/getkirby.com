<?php

namespace Kirby\Meta;

use Kirby\Cms\App;
use Kirby\Cms\Responder;
use Kirby\Http\Response;
use Kirby\Toolkit\Tpl;
use Kirby\Toolkit\Xml;

class SiteMeta
{
	public static function robots(): Responder
	{
		$robots  = 'User-agent: *' . PHP_EOL;
		$robots .= 'Allow: /' . PHP_EOL;
		$robots .= 'Sitemap: ' . url('sitemap.xml');

		return App::instance()
			->response()
			->type('text')
			->body($robots);
	}

	public static function search(): Response
	{
		return new Response(
			Tpl::load(__DIR__ . '/templates/search.php'),
			'application/opensearchdescription+xml'
		);
	}

	public static function sitemap(): Response
	{
		$kirby   = App::instance();
		$sitemap = [];
		$cache   = $kirby->cache('pages');
		$id      = 'sitemap.xml';

		if (!$sitemap = $cache->get($id)) {
			$sitemap[] = '<?xml version="1.0" encoding="UTF-8"?>';
			$sitemap[] = '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

			$templates = $kirby->option('meta.exclude.templates', []);
			$pages     = $kirby->option('meta.exclude.pages', []);

			if (is_callable($pages) === true) {
				$pages = $pages();
			}

			foreach ($kirby->site()->index() as $item) {

				if (in_array($item->intendedTemplate()->name(), $templates) === true) {
					continue;
				}

				if (preg_match('!^(?:' . implode('|', $pages) . ')$!i', $item->id())) {
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

			$cache->set($id, $sitemap);
		}

		return new Response($sitemap, 'application/xml');
	}
}
