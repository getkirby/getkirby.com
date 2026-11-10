<?php

namespace Kirby\Reference\Types;

use Kirby\Reference\Reflectable\ReflectableClassMethod;
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

		$type = Type::factory('list<int>');
		$this->assertInstanceOf(Compound::class, $type);

		$type = Type::factory('array{a: int}');
		$this->assertInstanceOf(Compound::class, $type);

		$type = Type::factory('callable(int): bool');
		$this->assertInstanceOf(Compound::class, $type);

		$type = Type::factory('Kirby\Cms\Page[]');
		$this->assertInstanceOf(Compound::class, $type);

		// Vue components aren't compound types
		$type = Type::factory('<k-button>');
		$this->assertInstanceOf(Identifier::class, $type);
	}

	public function testFactoryWithClassContext(): void
	{
		$reflectable = new ReflectableClassMethod('Kirby\Form\Field', 'resolve');

		$type = Type::factory('static', $reflectable);
		$this->assertInstanceOf(Identifier::class, $type);
		$this->assertSame('Kirby\Form\Field', $type->type);
		$this->assertTrue($type->is('static'));

		// `self` and `static` in compound types
		$type = Type::factory('class-string<static>', $reflectable);
		$this->assertSame('class-string<Kirby\Form\Field>', $type->type);

		$type = Type::factory('array<string, self>|list<$static>', $reflectable);
		$this->assertSame('array<string, Kirby\Form\Field>|list<$static>', $type->type);
	}

	public static function genericProvider(): array
	{
		return [
			['integer', 'int'],
			['object', 'object'],
			['"foo"', 'string'],
			['[1, 2, 3]', 'array'],
			['list', 'array'],
			['non-empty-string', 'string'],
			['positive-int', 'int'],
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

		// no generic type
		$type = new Type('foo');
		$this->assertSame('<code class="type">foo</code>', $type->toHtml());
	}

	public function testToString(): void
	{
		$type = new Type('string');
		$this->assertSame('string', $type->toString());
	}
}
