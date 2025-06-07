<?php

namespace Kirby\Reference\Types;

use Kirby\Reference\Reflectable\ReflectableClass;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Types::class)]
class TypesTest extends TestCase
{
	public function setUp(): void
	{
		require_once __DIR__ . '/fixtures/classes.php';
	}

	public function testCount(): void
	{
		$types = new Types([
			new Type('string'),
			new Type('int'),
		]);
		$this->assertSame(2, $types->count());
	}

	public function testFactoryWithString(): void
	{
		$types = Types::factory('string|int');
		$this->assertInstanceOf(Types::class, $types);
		$this->assertSame(2, $types->count());
		$this->assertSame('string|int', $types->toString());
	}

	public function testHas(): void
	{
		$types = new Types([
			new Type('string'),
			new Type('int'),
		]);

		$this->assertTrue($types->has('string'));
		$this->assertFalse($types->has('float'));
	}

	public function testNot(): void
	{
		$types = new Types([
			new Type('string'),
			new Type('int'),
		]);

		$this->assertSame('string|int', $types->toString());

		$types = $types->not('int');
		$this->assertSame('string', $types->toString());
	}

	public function testToHtml(): void
	{
		$types = new Types([
			new Type('string'),
			new Type('int'),
		]);

		$this->assertSame('<code class="type type-string">string</code><span class="px-1 color-gray-400" aria-hidden="true">|</span><span class="sr-only">or</span><code class="type type-int">int</code>', $types->toHtml());

		// Replace self/static/$this with the actual class name
		// and ensure duplicates are removed
		$types = new Types(
			types: [
				new Type('static'),
				new Type('string'),
			],
			reflectable: new ReflectableClass('TestTypes\A')
		);
		$this->assertSame('<code class="type type-class">TestTypes\A</code><span class="px-1 color-gray-400" aria-hidden="true">|</span><span class="sr-only">or</span><code class="type type-string">string</code>', $types->toHtml());

		// Not types, fallback
		$types = new Types([]);
		$this->assertSame('', $types->toHtml());
		$this->assertSame('<code class="type">-</code>', $types->toHtml(fallback: '-'));

	}

	public function testToString(): void
	{
		$types = new Types([
			new Type('string'),
			new Type('int'),
		]);

		$this->assertSame('string|int', $types->toString());

		// Replace self/static/$this with the actual class name
		// and ensure duplicates are removed
		$types = new Types(
			types: [
				new Type('static'),
				new Type('self'),
			],
			reflectable: new ReflectableClass('TestTypes\A')
		);

		$this->assertSame('TestTypes\A', $types->toString());
	}
}