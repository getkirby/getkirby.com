<?php

namespace Kirby\Archive;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Server::class)]
class ServerTest extends TestCase
{
	public function testStartAndStop(): void
	{
		$server = new Server(__DIR__ . '/fixtures', __DIR__ . '/fixtures/router.php', 2);
		$origin = $server->start();

		$this->assertMatchesRegularExpression('!^http://127\.0\.0\.1:\d+$!', $origin);
		$this->assertSame('<img src="/docs/a b.png">', file_get_contents($origin . '/docs'));

		$server->stop();

		$this->assertFalse(@file_get_contents($origin . '/docs'));
	}
}
