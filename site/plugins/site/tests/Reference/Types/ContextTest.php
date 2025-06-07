<?php

namespace Kirby\Reference\Types;

use Kirby\Reference\Reflectable\ReflectableClassMethod;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Context::class)]
class ContextTest extends TestCase
{
	public function setUp(): void
	{
		require_once __DIR__ . '/fixtures/classes.php';
	}

	public function testFactory(): void
	{
		$reflectable = new ReflectableClassMethod('TestTypes\B', 'foo');
		$context     = Context::factory($reflectable);
		$this->assertInstanceOf(Context::class, $context);
	}

	public function testResolve(): void
	{
		$reflectable = new ReflectableClassMethod('TestTypes\B', 'foo');
		$context     = Context::factory($reflectable);
		$this->assertSame('string', $context->resolve('TValue'));

		$reflectable = new ReflectableClassMethod('TestTypes\C', 'foo');
		$context     = Context::factory($reflectable);
		$this->assertSame('string', $context->resolve('TValue'));

		// TODO: support resolving trait templates
		// $reflectable = new ReflectableClassMethod('TestTypes\C', 'bar');
		// $context     = Context::factory($reflectable);
		// $this->assertSame('string', $context->resolve('TTraitValue'));
	}
}