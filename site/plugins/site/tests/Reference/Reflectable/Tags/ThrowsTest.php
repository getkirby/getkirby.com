<?php

namespace Kirby\Reference\Reflectable\Tags;

use Kirby\Reference\Reflectable\ReflectableClassMethod;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Throws::class)]
class ThrowsTest extends TestCase
{
	public function setUp(): void
	{
		require_once __DIR__ . '/fixtures/throws.php';
	}

	public function testFactory(): void
	{
		$reflectable = new ReflectableClassMethod('Throws', 'throws');
		$throws      = Throws::factory($reflectable);
		$this->assertInstanceOf(Throws::class, $throws);
		$this->assertCount(1, $throws);
		$this->assertInstanceOf(Exception::class, $throws->data[0]);

		// short class names are resolved in the context of the method
		$reflectable = new ReflectableClassMethod('Throws', 'throwsImported');
		$throws      = Throws::factory($reflectable);
		$this->assertSame('Kirby\Exception\NotFoundException', $throws->data[0]->types()->toString());

		$reflectable = new ReflectableClassMethod('Throws', 'throwsNot');
		$throws      = Throws::factory($reflectable);
		$this->assertNull($throws);
	}
}
