<?php

namespace Kirby\Reference\Reflectable;

use Exception;
use Kirby\Content\Field;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(ReflectableFieldMethod::class)]
class ReflectableFieldMethodTest extends TestCase
{
	public function testAliases(): void
	{
		// aliases are resolved from the `@see` tags on the `Field` class
		$reflectable = new ReflectableFieldMethod('escape');
		$this->assertSame(['esc'], $reflectable->aliases());
		$this->assertFalse($reflectable->isAlias());

		$reflectable = new ReflectableFieldMethod('esc');
		$this->assertSame([], $reflectable->aliases());
		$this->assertTrue($reflectable->isAlias());
		$this->assertSame('escape', $reflectable->see()->for());
	}

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

	public function testConstruct(): void
	{
		$reflectable = new ReflectableFieldMethod('or');
		$this->assertSame('or', $reflectable->method);
		$this->assertSame(Field::class, $reflectable->class);
	}

	public function testConstructWithUnknownMethod(): void
	{
		$this->expectException(Exception::class);
		$this->expectExceptionMessage('Field method "doesNotExist" not found');
		new ReflectableFieldMethod('doesNotExist');
	}

	public function testName(): void
	{
		$reflectable = new ReflectableFieldMethod('or');
		$this->assertSame('$field->or', $reflectable->name());
	}

	public function testParameters(): void
	{
		$reflectable = new ReflectableFieldMethod('escape');
		$parameters  = $reflectable->parameters();
		$this->assertCount(1, $parameters);
		$this->assertSame('context', $parameters->data[0]->name);
	}

	public function testSource(): void
	{
		// all field methods live in the `FieldMethods` trait
		$reflectable = new ReflectableFieldMethod('or');
		$this->assertStringContainsString(
			'/src/Content/FieldMethods.php#L',
			$reflectable->source()
		);
	}
}
