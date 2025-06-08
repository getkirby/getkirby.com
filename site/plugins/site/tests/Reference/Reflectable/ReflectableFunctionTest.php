<?php

namespace Kirby\Reference\Reflectable;

use Kirby\Reference\Reflectable\Tags\Parameters;
use Kirby\Reference\Reflectable\Tags\Returns;
use Kirby\Reference\Reflectable\Tags\Throws;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(ReflectableFunction::class)]
#[CoversClass(Reflectable::class)]
class ReflectableFunctionTest extends TestCase
{
	public function setUp(): void
	{
		require_once __DIR__ . '/fixtures/function.php';
	}

	public function testCall(): void
	{
		$reflectable = new ReflectableFunction('foo');
		$this->assertSame('foo(string $bar = \'baz\', int|null $optional = null): string', $reflectable->call());

		$reflectable = new ReflectableFunction('fooWithoutReturnType');
		$this->assertSame('fooWithoutReturnType()', $reflectable->call());

		$reflectable = new ReflectableFunction('fooWithVoidReturnType');
		$this->assertSame('fooWithVoidReturnType(): void', $reflectable->call());
	}

	public function testExamples(): void
	{
		$reflectable = new ReflectableFunction('fooWithDocBlock');
		$this->assertSame('```php
fooWithDocBlock();
```', $reflectable->examples());
	}

	public function testIsDeprecated(): void
	{
		$reflectable = new ReflectableFunction('foo');
		$this->assertFalse($reflectable->isDeprecated());

		$reflectable = new ReflectableFunction('fooWithDocBlock');
		$this->assertTrue($reflectable->isDeprecated());
		$this->assertSame('6.0.0', $reflectable->deprecated()->version());
		$this->assertSame('Use foo() instead', $reflectable->deprecated()->description());
	}

	public function testIsInternal(): void
	{
		$reflectable = new ReflectableFunction('foo');
		$this->assertFalse($reflectable->isInternal());

		$reflectable = new ReflectableFunction('fooWithDocBlock');
		$this->assertTrue($reflectable->isInternal());
	}

	public function testIsStatic(): void
	{
		$reflectable = new ReflectableFunction('foo');
		$this->assertFalse($reflectable->isStatic());
	}

	public function testName(): void
	{
		$reflectable = new ReflectableFunction('foo');
		$this->assertSame('foo', $reflectable->name());
	}

	public function testParameters(): void
	{
		$reflectable = new ReflectableFunction('foo');
		$parameters  = $reflectable->parameters();
		$this->assertInstanceOf(Parameters::class, $parameters);
		$this->assertSame(2, $parameters->count());
	}

	public function testReturns(): void
	{
		$reflectable = new ReflectableFunction('foo');
		$returns     = $reflectable->returns();
		$this->assertInstanceOf(Returns::class, $returns);
		$this->assertSame('string', $returns->types()->toString());
	}

	public function testSee(): void
	{
		$reflectable = new ReflectableFunction('fooWithDocBlock');
		$this->assertSame('foo', $reflectable->see());
	}

	public function testSince(): void
	{
		$reflectable = new ReflectableFunction('fooWithDocBlock');
		$this->assertSame('5.0.0', $reflectable->since()->version());
	}

	public function testSummary(): void
	{
		$reflectable = new ReflectableFunction('fooWithDocBlock');
		$this->assertSame('This is a function with a doc block', $reflectable->summary());
	}

	public function testThrows(): void
	{
		$reflectable = new ReflectableFunction('fooWithDocBlock');
		$throws      = $reflectable->throws();
		$this->assertInstanceOf(Throws::class, $throws);

		$exception = $throws->data[0];
		$this->assertSame('Exception', $exception->types()->toString());
		$this->assertSame('when foo is not found', $exception->description());
	}
}