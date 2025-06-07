<?php

namespace Kirby\Reference\Reflectable\Tags;

use Kirby\Reference\Reflectable\ReflectableClassMethod;
use Kirby\Reference\Types\Types;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Exception::class)]
class ExceptionTest extends TestCase
{
	public function setUp(): void
	{
		require_once __DIR__ . '/fixtures/throws.php';
	}

	public function testDescription(): void
	{
		$types = Types::factory('Kirby\Exception\Exception');
		$exception = new Exception($types, 'This is an exception');
		$this->assertSame('This is an exception', $exception->description());
	}

	public function testFactory(): void
	{
		$reflectable = new ReflectableClassMethod('Throws', 'throws');
		$tag         = $reflectable->doc()->getThrowsTagValues()[0];
		$exception   = Exception::factory($tag);
		$this->assertInstanceOf(Exception::class, $exception);
		$this->assertSame('Kirby\Exception\Exception', $exception->types()->toString());
		$this->assertSame('When something goes wrong', $exception->description());
	}

	public function testTypes(): void
	{
		$types = Types::factory('Kirby\Exception\Exception');
		$exception = new Exception($types);
		$this->assertSame($types, $exception->types());
	}
}