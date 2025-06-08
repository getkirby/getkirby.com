<?php

namespace Kirby\Reference\Reflectable;

use Kirby\Cms\App;
use Kirby\Reference\Reflectable\Tags\Throws;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(ReflectableClass::class)]
#[CoversClass(Reflectable::class)]
class ReflectableClassTest extends TestCase
{
	public function setUp(): void
	{
		require_once __DIR__ . '/fixtures/class.php';
	}

	public function testExamples(): void
	{
		$reflectable = new ReflectableClass('Bar\FooWithDocBlock');
		$this->assertSame('```php
new FooWithDocBlock();
```', $reflectable->examples());
	}

	public function testIsDeprecated(): void
	{
		$reflectable = new ReflectableClass('Bar\Foo');
		$this->assertFalse($reflectable->isDeprecated());

		$reflectable = new ReflectableClass('Bar\FooWithDocBlock');
		$this->assertTrue($reflectable->isDeprecated());
		$this->assertSame('6.0.0', $reflectable->deprecated()->version());
		$this->assertSame('Use Bar\Foo instead', $reflectable->deprecated()->description());
	}

	public function testIsInternal(): void
	{
		$reflectable = new ReflectableClass('Bar\Foo');
		$this->assertFalse($reflectable->isInternal());

		$reflectable = new ReflectableClass('Bar\FooWithDocBlock');
		$this->assertTrue($reflectable->isInternal());
	}

	public function testIsTrait(): void
	{
		$reflectable = new ReflectableClass('Bar\Foo');
		$this->assertFalse($reflectable->isTrait());

		$reflectable = new ReflectableClass('Bar\FooTrait');
		$this->assertTrue($reflectable->isTrait());
	}

	public function testMethods(): void
	{
		$reflectable = new ReflectableClass('Bar\Foo');
		$this->assertCount(3, $reflectable->methods());
		$this->assertSame('__construct', $reflectable->methods()[0]->getName());
		$this->assertSame('bar', $reflectable->methods()[1]->getName());
		$this->assertSame('baz', $reflectable->methods()[2]->getName());
	}

	public function testName(): void
	{
		$reflectable = new ReflectableClass('Bar\Foo');
		$this->assertSame('Bar\Foo', $reflectable->name());
		$this->assertSame('Foo', $reflectable->name(short: true));
	}

	public function testSee(): void
	{
		$reflectable = new ReflectableClass('Bar\FooWithDocBlock');
		$this->assertSame('Bar\Foo', $reflectable->see());
	}

	public function testSince(): void
	{
		$reflectable = new ReflectableClass('Bar\FooWithDocBlock');
		$this->assertSame('5.0.0', $reflectable->since()->version());
	}

	public function testSource(): void
	{
		$reflectable = new ReflectableClass('Bar\Foo');
		$this->assertSame('https://github.com/getkirby/kirby/tree/' . App::instance()->version() . '/src/Bar/Foo.php#L5', $reflectable->source());
	}

	public function testSummary(): void
	{
		$reflectable = new ReflectableClass('Bar\FooWithDocBlock');
		$this->assertSame('This is a class with a doc block', $reflectable->summary());
	}

	public function testThrows(): void
	{
		$reflectable = new ReflectableClass('Bar\FooWithDocBlock');
		$this->assertInstanceOf(Throws::class, $reflectable->throws());

		$exception = $reflectable->throws()->data[0];
		$this->assertSame('Exception', $exception->types()->toString());
		$this->assertSame('when foo is not found', $exception->description());
	}
}