<?php

namespace Kirby\Reference\Reflectable\Tags;

use Kirby\Reference\Reflectable\ReflectableClass;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Deprecated::class)]
class DeprecatedTest extends TestCase
{
	public function setUp(): void
	{
		require_once __DIR__ . '/fixtures/deprecated.php';
	}

	public function testFactory(): void
	{
		$reflectable = new ReflectableClass('DeprecatedNot');
		$deprecated  = Deprecated::factory($reflectable);
		$this->assertNull($deprecated);

		$reflectable = new ReflectableClass('Deprecated');
		$deprecated  = Deprecated::factory($reflectable);
		$this->assertInstanceOf(Deprecated::class, $deprecated);
		$this->assertSame('5.0.0', $deprecated->version());
		$this->assertSame('This is deprecated', $deprecated->description());

		$reflectable = new ReflectableClass('DeprecatedOnlyVersion');
		$deprecated  = Deprecated::factory($reflectable);
		$this->assertInstanceOf(Deprecated::class, $deprecated);
		$this->assertSame('5.0.0', $deprecated->version());
		$this->assertNull($deprecated->description());

		$reflectable = new ReflectableClass('DeprecatedOnlyTag');
		$deprecated  = Deprecated::factory($reflectable);
		$this->assertInstanceOf(Deprecated::class, $deprecated);
		$this->assertNull($deprecated->description());
		$this->assertNull($deprecated->version());
	}

	public function testVersion(): void
	{
		$deprecated = new Deprecated('5.0.0', 'This is deprecated');
		$this->assertSame('5.0.0', $deprecated->version());
		$this->assertSame('This is deprecated', $deprecated->description());

		$deprecated = new Deprecated(version: '5.0.0');
		$this->assertSame('5.0.0', $deprecated->version());
		$this->assertNull($deprecated->description());
	}
}