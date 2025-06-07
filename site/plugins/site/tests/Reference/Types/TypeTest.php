<?php

namespace Kirby\Reference\Types;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(Type::class)]
class TypeTest extends TestCase
{
	public function testFactory(): void
	{
		$type = Type::factory('string');
		$this->assertInstanceOf(Type::class, $type);
		$this->assertSame('string', $type->type);

		$type = Type::factory('stdClass');
		$this->assertInstanceOf(Identifier::class, $type);
		$this->assertSame('stdClass', $type->type);
	}

	public static function genericProvider(): array
	{
		return [
			['integer', 'int'],
			['$this', 'object'],
			['self', 'object'],
			['static', 'object'],
			['"foo"', 'string'],
			['[1, 2, 3]', 'array']
		];
	}

	#[DataProvider('genericProvider')]
	public function testGeneric(string $type, string $expected): void
	{
		$this->assertSame($expected, Type::generic($type));
	}

	public function testToHtml(): void
	{
		$type = new Type('string');
		$this->assertSame('<code class="type type-string">string</code>', $type->toHtml());

		$this->assertSame('<code class="type type-string">This is a string</code>', $type->toHtml('This is a string'));
	}

	public function testToString(): void
	{
		$type = new Type('string');
		$this->assertSame('string', $type->toString());
	}
}