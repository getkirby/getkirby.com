<?php

namespace Kirby\Reference\Reflectable;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use ReflectionProperty;

#[CoversClass(ReflectableProperty::class)]
class ReflectablePropertyTest extends TestCase
{
	public function setUp(): void
	{
		require_once __DIR__ . '/fixtures/property.php';
	}

	public function testConstruct(): void
	{
		$reflectable = new ReflectableProperty('Bar\Doe', 'name');
		$this->assertSame('Bar\Doe', $reflectable->class);
		$this->assertSame('name', $reflectable->property);
		$this->assertInstanceOf(ReflectionProperty::class, $reflectable->reflection);
	}

	public function testName(): void
	{
		$reflectable = new ReflectableProperty('Bar\Doe', 'name');
		$this->assertSame('name', $reflectable->name());
	}

	public function testSummary(): void
	{
		// only the first block of the doc block is the summary
		$reflectable = new ReflectableProperty('Bar\Doe', 'name');
		$this->assertSame('The name of the doe', $reflectable->summary());

		$reflectable = new ReflectableProperty('Bar\Doe', 'undocumented');
		$this->assertNull($reflectable->summary());
	}
}
