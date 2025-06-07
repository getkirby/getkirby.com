<?php

namespace Kirby\Reference\Reflectable\Tags;

use Kirby\Reference\Reflectable\ReflectableFunction;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Since::class)]
class SinceTest extends TestCase
{
	public function setUp(): void
	{
		require_once __DIR__ . '/fixtures/since.php';
	}

	public function testFactory(): void
	{
		$reflectable = new ReflectableFunction('sinceNoDocBlock');
		$since       = Since::factory($reflectable);
		$this->assertNull($since);

		$reflectable = new ReflectableFunction('sinceDocBlock');
		$since       = Since::factory($reflectable);
		$this->assertInstanceOf(Since::class, $since);
		$this->assertSame('5.0.0', $since->version());

		$reflectable = new ReflectableFunction('sinceNotSameMajorVersion');
		$since       = Since::factory($reflectable);
		$this->assertNull($since);
	}

	public function testToHtml(): void
	{
		$since = new Since('5.0.0');
		$this->assertSame('<a href="https://github.com/getkirby/kirby/releases/tag/5.0.0">5.0.0</a>', $since->toHtml());
	}

	public function testVersion(): void
	{
		$since = new Since('5.0.0');
		$this->assertSame('5.0.0', $since->version());
	}
}