<?php

namespace Kirby\Reference\Types;

use Kirby\Reference\Reflectable\ReflectableClass;
use Kirby\Reference\Reflectable\ReflectableClassMethod;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Context::class)]
class ContextTest extends TestCase
{
	protected function returns(string $method): string
	{
		$reflectable = new ReflectableClassMethod('TestTypes\Generics\Items', $method);
		return $reflectable->returns()->types()->toString();
	}

	public function setUp(): void
	{
		require_once __DIR__ . '/fixtures/classes.php';
		require_once __DIR__ . '/fixtures/generics.php';
	}

	public function testFactory(): void
	{
		$reflectable = new ReflectableClassMethod('TestTypes\B', 'foo');
		$context     = Context::factory($reflectable);
		$this->assertInstanceOf(Context::class, $context);
	}

	public function testResolve(): void
	{
		$reflectable = new ReflectableClassMethod('TestTypes\A', 'foo');
		$context     = Context::factory($reflectable);
		$this->assertSame('int', $context->resolve('TValue'));

		$reflectable = new ReflectableClassMethod('TestTypes\B', 'foo');
		$context     = Context::factory($reflectable);
		$this->assertSame('string', $context->resolve('TValue'));

		$reflectable = new ReflectableClassMethod('TestTypes\C', 'foo');
		$context     = Context::factory($reflectable);
		$this->assertSame('string', $context->resolve('TValue'));

		$reflectable = new ReflectableClassMethod('TestTypes\C', 'bar');
		$context     = Context::factory($reflectable);
		$this->assertSame('string', $context->resolve('TTraitValue'));
	}

	public function testResolveNodeWithBound(): void
	{
		// the bound is resolved in the namespace of the class
		$this->assertSame('list<TestTypes\Generics\Item>', $this->returns('all'));
	}

	public function testResolveNodeWithCallable(): void
	{
		$reflectable = new ReflectableClassMethod('TestTypes\Generics\Items', 'filter');
		$types       = $reflectable->parameters()->data[0]->types;

		$this->assertSame(1, $types->count());
		$this->assertSame('callable(int|string $key): bool', $types->toString());
	}

	public function testResolveNodeWithConditional(): void
	{
		$this->assertSame('list<int|string>|string', $this->returns('pool'));
	}

	public function testResolveNodeWithImport(): void
	{
		$this->assertSame('TestTypes\A|null', $this->returns('base'));
	}

	public function testResolveNodeWithShape(): void
	{
		// the key `files` is no class name
		$this->assertSame('array{files: TestTypes\Generics\Files, count: int}', $this->returns('shape'));
	}

	public function testResolveNodeWithUnknownTemplate(): void
	{
		$this->assertSame('list<mixed>', $this->returns('reverse'));
	}

	public function testResolveWithoutType(): void
	{
		$context = Context::factory(new ReflectableClass('TestTypes\A'));
		$this->assertSame('mixed', $context->resolve('TValue'));
		$this->assertSame('Foo', $context->resolve('Foo'));
	}
}
