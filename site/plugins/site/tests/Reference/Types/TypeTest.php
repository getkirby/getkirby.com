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

		$type = Type::factory('Kirby\Cms\App');
		$this->assertInstanceOf(Identifier::class, $type);
		$this->assertSame('Kirby\Cms\App', $type->type);

		$type = Type::factory('Kirby\Cms\App::user');
		$this->assertInstanceOf(Chain::class, $type);
		$this->assertSame('Kirby\Cms\App::user', $type->type);

		$type = Type::factory('Kirby\Cms\App->user');
		$this->assertInstanceOf(Chain::class, $type);
		$this->assertSame('Kirby\Cms\App->user', $type->type);
	}

	public static function genericProvider(): array
	{
		return [
			['integer', 'int'],
			['object', 'object'],
			['"foo"', 'string'],
			['[1, 2, 3]', 'array']
		];
	}

	#[DataProvider('genericProvider')]
	public function testGeneric(string $type, string $expected): void
	{
		$this->assertSame($expected, Type::generic($type));
	}

	public function testIs(): void
	{
		$type = Type::factory('string');
		$this->assertTrue($type->is('string'));
		$this->assertFalse($type->is('int'));

		$type = Type::factory('Kirby\Cms\App');
		$this->assertTrue($type->is('Kirby\Cms\App'));
		$this->assertFalse($type->is('static'));
		$this->assertFalse($type->is('string'));

		$type = new Identifier('Kirby\Cms\App', 'static');
		$this->assertTrue($type->is('static'));
		$this->assertFalse($type->is('self'));
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