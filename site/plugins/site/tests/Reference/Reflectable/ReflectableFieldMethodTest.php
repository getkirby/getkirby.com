<?php

namespace Kirby\Reference\Reflectable;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(ReflectableFieldMethod::class)]
class ReflectableFieldMethodTest extends TestCase
{
	public function testCall(): void
	{
		$reflectable = new ReflectableFieldMethod('or');
		$this->assertSame('$field->or(mixed $fallback = null): Kirby\Content\Field', $reflectable->call());
	}

	public function testClass(): void
	{
		$reflectable = new ReflectableFieldMethod('or');
		$this->assertSame('Kirby\Content\Field', $reflectable->class());
		$this->assertSame('Field', $reflectable->class(short: true));
	}

	public function testName(): void
	{
		$reflectable = new ReflectableFieldMethod('or');
		$this->assertSame('$field->or', $reflectable->name());
	}
}