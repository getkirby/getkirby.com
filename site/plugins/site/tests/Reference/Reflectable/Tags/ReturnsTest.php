<?php

namespace Kirby\Reference\Reflectable\Tags;

use Kirby\Reference\Reflectable\ReflectableFunction;
use Kirby\Reference\Types\Types;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Returns::class)]
class ReturnsTest extends TestCase
{
	public function setUp(): void
	{
		require_once __DIR__ . '/fixtures/returns.php';
	}

	public function testDescription(): void
	{
		$types       = Types::factory('string');
		$reflectable = new Returns($types, 'The answer to life');
		$this->assertSame('The answer to life', $reflectable->description());

		$reflectable = new Returns($types);
		$this->assertNull($reflectable->description());
	}

	public function testFactory(): void
	{
		$reflectable = new ReflectableFunction('returnsString');
		$returns     = Returns::factory($reflectable);
		$this->assertInstanceOf(Returns::class, $returns);
		$this->assertSame('string', $returns->types()->toString());
		$this->assertNull($returns->description());

		$reflectable = new ReflectableFunction('returnsVoid');
		$returns     = Returns::factory($reflectable);
		$this->assertInstanceOf(Returns::class, $returns);
		$this->assertSame('void', $returns->types()->toString());

		$reflectable = new ReflectableFunction('returnsNoHint');
		$returns     = Returns::factory($reflectable);
		$this->assertNull($returns);

		$reflectable = new ReflectableFunction('returnsNoHintDocBlock');
		$returns     = Returns::factory($reflectable);
		$this->assertInstanceOf(Returns::class, $returns);
		$this->assertSame('string', $returns->types()->toString());
		$this->assertSame('The answer to life', $returns->description());
	}

	public function testIsMutable(): void
	{
		$types       = Types::factory('static');
		$reflectable = new Returns($types);
		$this->assertFalse($reflectable->isMutable());

		$types       = Types::factory('self');
		$reflectable = new Returns($types);
		$this->assertFalse($reflectable->isMutable());

		$types       = Types::factory('$this');
		$reflectable = new Returns($types);
		$this->assertTrue($reflectable->isMutable());
	}

	public function testIsImmutable(): void
	{
		$types       = Types::factory('static');
		$reflectable = new Returns($types);
		$this->assertTrue($reflectable->isImmutable());

		$types       = Types::factory('self');
		$reflectable = new Returns($types);
		$this->assertTrue($reflectable->isImmutable());

		$types       = Types::factory('$this');
		$reflectable = new Returns($types);
		$this->assertFalse($reflectable->isImmutable());
	}

	public function testIsVoid(): void
	{
		$types       = Types::factory('void');
		$reflectable = new Returns($types);
		$this->assertTrue($reflectable->isVoid());
	}

	public function testToHtml(): void
	{
		$types       = Types::factory('string');
		$reflectable = new Returns($types);
		$this->assertSame('<code class="type type-string">string</code>', $reflectable->types()->toHtml());
	}

	public function testToString(): void
	{
		$types       = Types::factory('string');
		$reflectable = new Returns($types);
		$this->assertSame('string', $reflectable->types()->toString());
	}

	public function testTypes(): void
	{
		$types       = Types::factory('string');
		$reflectable = new Returns($types);
		$this->assertInstanceOf(Types::class, $reflectable->types());
		$this->assertSame($types, $reflectable->types());
	}
}