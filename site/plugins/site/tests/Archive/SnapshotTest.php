<?php

namespace Kirby\Archive;

use Kirby\Filesystem\Dir;
use Kirby\Filesystem\F;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Snapshot::class)]
class SnapshotTest extends TestCase
{
	protected const ORIGIN = 'http://127.0.0.1:8000';
	protected const URL    = 'https://v5.getkirby.com';

	protected string $root;

	protected function redirect(string $location): array
	{
		return ['status' => 302, 'location' => $location, 'from' => null];
	}

	public function setUp(): void
	{
		$this->root = sys_get_temp_dir() . '/kirby-archive-snapshot-' . uniqid();
	}

	protected function snapshot(array $results = []): Snapshot
	{
		$snapshot = new Snapshot(static::URL, $this->root);

		$snapshot->crawler = new Crawler(static::ORIGIN, $this->root . '/public', static::URL);
		$snapshot->crawler->results = $results;

		return $snapshot;
	}

	public function tearDown(): void
	{
		Dir::remove($this->root);
	}

	public function testNginx(): void
	{
		$snapshot = $this->snapshot([
			static::ORIGIN . '/docs/guide' => $this->redirect(static::ORIGIN . '/docs/guide/quickstart'),
		]);

		$nginx = $snapshot->nginx();

		$this->assertStringContainsString('rsync -az public/ ploi@server:/home/ploi/v5.getkirby.com/public/', $nginx);
		$this->assertStringContainsString('absolute_redirect off;', $nginx);
		$this->assertStringContainsString("location / {\n\ttry_files \$uri \$uri/index.html @fallback;\n}", $nginx);
		$this->assertStringContainsString('return 302 https://getkirby.com$request_uri;', $nginx);
		$this->assertStringEndsWith("\nlocation = \"/docs/guide\" { return 301 \"/docs/guide/quickstart\"; }\n", $nginx);
	}

	public function testRedirects(): void
	{
		$snapshot = $this->snapshot([
			static::ORIGIN . '/docs/guide'          => $this->redirect(static::ORIGIN . '/docs/guide/quickstart'),
			static::ORIGIN                          => $this->redirect('https://v5.getkirby.com/docs/guide'),
			static::ORIGIN . '/docs/caf%C3%A9'      => $this->redirect(static::ORIGIN . '/docs/cafe'),
			static::ORIGIN . '/docs/screencasts'    => $this->redirect('https://www.youtube.com/kirbycasts'),
			// handled by the fallback anyway
			static::ORIGIN . '/buy'                 => $this->redirect('https://getkirby.com/buy'),
			static::ORIGIN . '/docs/reference'      => ['status' => 200],
			static::ORIGIN . '/docs/missing'        => ['status' => 404, 'location' => null, 'from' => null],
		]);

		$this->assertSame([
			'/'                 => '/docs/guide',
			'/docs/café'        => '/docs/cafe',
			'/docs/guide'       => '/docs/guide/quickstart',
			'/docs/screencasts' => 'https://www.youtube.com/kirbycasts',
		], $snapshot->redirects());
	}

	public function testSeeds(): void
	{
		$seeds = $this->snapshot()->seeds(static::ORIGIN);

		$this->assertSame(static::ORIGIN . '/robots.txt', $seeds[0]);
		$this->assertContains(static::ORIGIN . '/', $seeds);
		$this->assertContains(static::ORIGIN . '/docs/glossary/blueprint', $seeds);
	}

	public function testSeedsFromList(): void
	{
		$list = [
			'docs/guide',
			'/docs/reference',
			'http://localhost/docs/cookbook',
			'https://v35.getkirby.com/docs/glossary',
			'/',
			'https://v35.getkirby.com',
		];

		$this->assertSame([
			static::ORIGIN . '/robots.txt',
			static::ORIGIN . '/docs/guide',
			static::ORIGIN . '/docs/reference',
			static::ORIGIN . '/docs/cookbook',
			static::ORIGIN . '/docs/glossary',
			static::ORIGIN . '/',
			static::ORIGIN . '/',
		], $this->snapshot()->seeds(static::ORIGIN, $list));
	}

	public function testUnresolved(): void
	{
		$snapshot = $this->snapshot([
			static::ORIGIN . '/docs/b' => $this->redirect(static::ORIGIN . '/docs/a'),
		]);

		F::write($this->root . '/public/docs/a/index.html', 'Page A');
		F::write($this->root . '/public/media/a.webp', 'image');
		F::write($this->root . '/public/index.html', <<<HTML
			<a href="https://v5.getkirby.com/docs/a">exists</a>
			<a href="docs/a#intro">relative</a>
			<a href="https://v5.getkirby.com/docs/b">redirect</a>
			<a href="https://v5.getkirby.com/buy">fallback</a>
			<a href="/buy">fallback again</a>
			<img src="/media/a.webp" srcset="/media/a.webp 1x, /media/missing.webp 2x">
			<a href="https://getkirby.com/docs">external</a>
			HTML);

		$this->assertSame([
			'/buy'                => 2,
			'/media/missing.webp' => 1,
		], $snapshot->unresolved());
	}

	public function testWrite(): void
	{
		$snapshot = $this->snapshot([
			static::ORIGIN . '/docs/b'       => $this->redirect(static::ORIGIN . '/docs/a'),
			static::ORIGIN . '/docs/missing' => ['status' => 404, 'location' => null, 'from' => static::ORIGIN . '/docs'],
		]);

		$report = $snapshot->write();

		$this->assertSame([static::ORIGIN . '/docs/missing'], array_keys($report['errors']));
		$this->assertSame(['/docs/b' => '/docs/a'], $report['redirects']);
		$this->assertFileExists($this->root . '/nginx.conf');
		$this->assertFileExists($this->root . '/report.json');
	}
}
