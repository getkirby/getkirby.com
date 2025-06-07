<?php

namespace Kirby\Reference\Reflectable;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(ReflectableClassMethod::class)]
class ReflectableClassMethodTest extends TestCase
{
	public function setUp(): void
	{
		require_once __DIR__ . '/fixtures/classmethod.php';
	}

	public function testCall(): void
	{
		$reflectable = new ReflectableClassMethod('Bar\Fox', 'bar');
		$this->assertSame('$fox->bar(string $a, int $b): Bar\Fox', $reflectable->call());

		$reflectable = new ReflectableClassMethod('Bar\Fox', 'barStatic');
		$this->assertSame('Fox::barStatic()', $reflectable->call());
	}

	public function testClass(): void
	{
		$reflectable = new ReflectableClassMethod('Bar\Fox', 'bar');
		$this->assertSame('Bar\Fox', $reflectable->class());
		$this->assertSame('Fox', $reflectable->class(short: true));
	}

	public function testInheritedFrom(): void
	{
		$reflectable = new ReflectableClassMethod('Bar\ChildFox', 'bar');
		$this->assertSame('Bar\Fox', $reflectable->inheritedFrom()->toString());

		$reflectable = new ReflectableClassMethod('Bar\Fox', 'bar');
		$this->assertNull($reflectable->inheritedFrom());
	}

	public function testIsMagic(): void
	{
		$reflectable = new ReflectableClassMethod('Bar\Fox', 'bar');
		$this->assertFalse($reflectable->isMagic());

		$reflectable = new ReflectableClassMethod('Bar\Fox', '__construct');
		$this->assertTrue($reflectable->isMagic());
	}

	public function testName(): void
	{
		$reflectable = new ReflectableClassMethod('Bar\Fox', 'bar');
		$this->assertSame('$fox->bar', $reflectable->name());

		$reflectable = new ReflectableClassMethod('Bar\Fox', 'barStatic');
		$this->assertSame('Fox::barStatic', $reflectable->name());

		$reflectable = new ReflectableClassMethod('Bar\Fox', '__construct');
		$this->assertSame('new Fox', $reflectable->name());

		$reflectable = new ReflectableClassMethod('Bar\Fox', 'bar', 'fancyFox');
		$this->assertSame('$fancyFox->bar', $reflectable->name());
	}

	public function testSee(): void
	{
		$reflectable = new ReflectableClassMethod('Bar\Fox', 'barWithDocBlock');
		$this->assertSame('Bar\Fox::baz', $reflectable->see());
	}

	public function testSource(): void
	{
		$reflectable = new ReflectableClassMethod('Bar\Fox', 'bar');
		$this->assertStringEndsWith('#L10', $reflectable->source());
	}
}