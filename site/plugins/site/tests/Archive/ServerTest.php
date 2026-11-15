<?php

namespace Kirby\Archive;

use Exception;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Server::class)]
class ServerTest extends TestCase
{
	public function testPages(): void
	{
		$server = new Server(__DIR__ . '/fixtures/archive', __DIR__ . '/fixtures/router.php');

		$this->assertSame(['/docs', '/docs/guide'], $server->pages());
	}

	public function testPagesWithoutSite(): void
	{
		$server = new Server(__DIR__ . '/fixtures', __DIR__ . '/fixtures/router.php');

		$this->expectException(Exception::class);
		$this->expectExceptionMessage('The pages of the site could not be listed');

		$server->pages();
	}

	public function testStartAndStop(): void
	{
		$server = new Server(__DIR__ . '/fixtures', __DIR__ . '/fixtures/router.php', 2);
		$origin = $server->start();

		$this->assertMatchesRegularExpression('!^http://127\.0\.0\.1:\d+$!', $origin);
		$this->assertSame('image', file_get_contents($origin . '/docs/a%20b.png'));

		$server->stop();

		$this->assertFalse(@file_get_contents($origin . '/docs/a%20b.png'));
	}
}
