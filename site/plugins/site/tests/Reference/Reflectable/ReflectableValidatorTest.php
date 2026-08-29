<?php

namespace Kirby\Reference\Reflectable;

use Exception;
use Kirby\Toolkit\V;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(ReflectableValidator::class)]
class ReflectableValidatorTest extends TestCase
{
	public function testConstruct(): void
	{
		$reflectable = new ReflectableValidator('email');
		$this->assertSame('email', $reflectable->name);
		$this->assertSame('email', $reflectable->method);
		$this->assertSame(V::class, $reflectable->class);
	}

	public function testConstructWithUnknownValidator(): void
	{
		$this->expectException(Exception::class);
		$this->expectExceptionMessage('Validator "doesNotExist" not found');
		new ReflectableValidator('doesNotExist');
	}

	public function testCall(): void
	{
		$reflectable = new ReflectableValidator('email');
		$this->assertSame('V::email($value): bool', $reflectable->call());
	}

	public function testClass(): void
	{
		$reflectable = new ReflectableValidator('email');
		$this->assertSame('Kirby\Toolkit\V', $reflectable->class());
		$this->assertSame('V', $reflectable->class(short: true));
	}

	public function testName(): void
	{
		$reflectable = new ReflectableValidator('email');
		$this->assertSame('V::email', $reflectable->name());
	}

	public function testSummary(): void
	{
		$reflectable = new ReflectableValidator('email');
		$this->assertSame(
			'Checks for valid email addresses',
			$reflectable->summary()
		);
	}
}
