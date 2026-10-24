<?php

namespace Kirby\Archive;

use Kirby\Filesystem\Dir;
use Kirby\Filesystem\F;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(Crawler::class)]
class CrawlerTest extends TestCase
{
	protected function crawler(array $include = []): Crawler
	{
		return new Crawler(
			origin:  'http://127.0.0.1:8000',
			root:    '/snapshot/crawl',
			url:     'https://v5.getkirby.com',
			include: $include
		);
	}

	public function testCrawl(): void
	{
		$server  = new Server(__DIR__ . '/fixtures', __DIR__ . '/fixtures/router.php', 2);
		$origin  = $server->start();
		$root    = sys_get_temp_dir() . '/kirby-archive-crawler-' . uniqid();
		$crawler = new Crawler($origin, $root, 'https://v5.getkirby.com');

		try {
			$crawler->crawl([$origin . '/']);
		} finally {
			$server->stop();
		}

		// follows the redirect and links with spaces
		$this->assertSame(302, $crawler->results[$origin . '/']['status']);
		$this->assertSame('image', F::read($root . '/docs/a b.png'));
		$this->assertFileExists($root . '/docs/index.html');

		Dir::remove($root);
	}

	public function testFollow(): void
	{
		$crawler = $this->crawler();

		$this->assertSame('http://127.0.0.1:8000/docs/guide', $crawler->follow('http://127.0.0.1:8000/docs/guide#intro'));
		$this->assertSame('http://127.0.0.1:8000/docs/guide', $crawler->follow('https://v5.getkirby.com/docs/guide'));
		$this->assertSame('http://127.0.0.1:8000/assets/css/index.css?v=123', $crawler->follow('http://127.0.0.1:8000/assets/css/index.css?v=123'));
		$this->assertNull($crawler->follow('https://getkirby.com/docs/guide'));
		$this->assertNull($crawler->follow('mailto:support@getkirby.com'));
	}

	public function testFollowIncluded(): void
	{
		$crawler = $this->crawler(['docs']);

		$this->assertSame('http://127.0.0.1:8000/', $crawler->follow('http://127.0.0.1:8000/'));
		$this->assertSame('http://127.0.0.1:8000/docs', $crawler->follow('http://127.0.0.1:8000/docs'));
		$this->assertSame('http://127.0.0.1:8000/docs/guide', $crawler->follow('http://127.0.0.1:8000/docs/guide'));
		$this->assertSame('http://127.0.0.1:8000/media/pages/home/a.png', $crawler->follow('http://127.0.0.1:8000/media/pages/home/a.png'));
		$this->assertNull($crawler->follow('http://127.0.0.1:8000/docsearch'));
		$this->assertNull($crawler->follow('http://127.0.0.1:8000/releases/3.5'));
		$this->assertNull($crawler->follow('http://127.0.0.1:8000/buy'));
	}

	public function testFollowPageWithQuery(): void
	{
		$crawler = $this->crawler();

		$this->assertNull($crawler->follow('http://127.0.0.1:8000/docs/reference?advanced=yes', 'http://127.0.0.1:8000/docs'));
		$this->assertSame(['http://127.0.0.1:8000/docs/reference?advanced=yes' => 'http://127.0.0.1:8000/docs'], $crawler->queries);
	}

	public function testIsFile(): void
	{
		$this->assertTrue(Crawler::isFile('/assets/css/index.css'));
		$this->assertTrue(Crawler::isFile('/media/pages/a/a-320x.png'));
		$this->assertTrue(Crawler::isFile('/robots.txt'));
		$this->assertTrue(Crawler::isFile('/downloads/kit.tar.gz'));
		$this->assertFalse(Crawler::isFile('/docs/guide'));
		$this->assertFalse(Crawler::isFile('/releases/3.5'));
		$this->assertFalse(Crawler::isFile('/releases/5.0.0'));
	}

	public function testLinksInCss(): void
	{
		$css = '@import "framework/reset.css"; .a { background: url("../images/a.svg") } @font-face { src: url(font.woff2) }';

		$this->assertSame(['../images/a.svg', 'font.woff2', 'framework/reset.css'], Crawler::links($css, 'css'));
	}

	public function testLinksInHtml(): void
	{
		$html = <<<HTML
			<link rel="stylesheet" href="/assets/css/index.css?v=1">
			<meta property="og:image" content="https://v5.getkirby.com/media/og.png">
			<meta name="description" content="Not a link">
			<a href="/docs/guide">Guide</a>
			<img src="a-640x.png" srcset="a-320x.png 320w, a-640x.png 640w">
			<img data-src="lazy.png">
			<div style="background-image: url('/assets/images/bg.jpg')"></div>
			<script type="module">import Menu from "/assets/js/menu.js";</script>
			<pre><code>&lt;a href="/not-followed"&gt;</code></pre>
			HTML;

		$this->assertSame([
			'a-320x.png',
			'a-640x.png',
			'/assets/css/index.css?v=1',
			'/docs/guide',
			'a-640x.png',
			'lazy.png',
			'https://v5.getkirby.com/media/og.png',
			'/assets/images/bg.jpg',
			'/assets/js/menu.js',
		], Crawler::links($html, 'html'));
	}

	public function testLinksInJs(): void
	{
		$js = <<<JS
			import { a } from "./a.js";
			import "./polyfill.js";
			const prism = await import("../libraries/prism.js");
			const importance = "high";
			JS;

		$this->assertSame(['./a.js', './polyfill.js', '../libraries/prism.js'], Crawler::links($js, 'js'));
	}

	public function testLinksInOtherFiles(): void
	{
		$this->assertSame([], Crawler::links('Sitemap: /sitemap.xml', 'txt'));
	}

	public function testPath(): void
	{
		$crawler = $this->crawler();

		$this->assertSame('/snapshot/crawl/index.html', $crawler->path('http://127.0.0.1:8000', true));
		$this->assertSame('/snapshot/crawl/index.html', $crawler->path('http://127.0.0.1:8000/', true));
		$this->assertSame('/snapshot/crawl/docs/guide/index.html', $crawler->path('http://127.0.0.1:8000/docs/guide', true));
		$this->assertSame('/snapshot/crawl/assets/css/index.css', $crawler->path('http://127.0.0.1:8000/assets/css/index.css?v=1', false));
		$this->assertSame('/snapshot/crawl/media/a b.png', $crawler->path('http://127.0.0.1:8000/media/a%20b.png', false));
	}

	public static function resolveProvider(): array
	{
		$base = 'http://127.0.0.1:8000/docs/guide/quickstart';

		return [
			[$base, 'https://getkirby.com/buy', 'https://getkirby.com/buy'],
			[$base, 'mailto:support@getkirby.com', 'mailto:support@getkirby.com'],
			[$base, '//cdn.example.com/a.js', 'http://cdn.example.com/a.js'],
			[$base, '/docs/reference', 'http://127.0.0.1:8000/docs/reference'],
			[$base, 'installation', 'http://127.0.0.1:8000/docs/guide/installation'],
			[$base, './installation', 'http://127.0.0.1:8000/docs/guide/installation'],
			[$base, '../reference/system', 'http://127.0.0.1:8000/docs/reference/system'],
			[$base, '../../../../a', 'http://127.0.0.1:8000/a'],
			[$base, '?q=1&amp;p=2', 'http://127.0.0.1:8000/docs/guide/quickstart?q=1&p=2'],
			[$base, '#intro', $base],
			['http://127.0.0.1:8000/assets/css/index.css', 'site/header.css', 'http://127.0.0.1:8000/assets/css/site/header.css'],
		];
	}

	#[DataProvider('resolveProvider')]
	public function testResolve(string $base, string $link, string $expected): void
	{
		$this->assertSame($expected, Crawler::resolve($base, $link));
	}

	public function testRewrite(): void
	{
		$text = <<<HTML
			<a href="http://127.0.0.1:8000/docs/guide">Guide</a>
			<script type="application/ld+json">{"url":"http:\/\/127.0.0.1:8000\/docs"}</script>
			HTML;

		$expected = <<<HTML
			<a href="https://v5.getkirby.com/docs/guide">Guide</a>
			<script type="application/ld+json">{"url":"https:\/\/v5.getkirby.com\/docs"}</script>
			HTML;

		$this->assertSame($expected, $this->crawler()->rewrite($text));
	}
}
