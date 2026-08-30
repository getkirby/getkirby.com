<?php

namespace Kirby\Reference\Reflectable\Tags;

use Kirby\Reference\Reflectable\ReflectableClassMethod;
use Kirby\Reference\Reflectable\ReflectableFunction;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(See::class)]
class SeeTest extends TestCase
{
	protected function see(string $method): See|null
	{
		return See::factory(
			new ReflectableClassMethod('TestSee\Vixen', $method)
		);
	}

	public function setUp(): void
	{
		require_once __DIR__ . '/fixtures/see.php';
	}

	public function testFactoryForFunction(): void
	{
		// functions can't reference a method of the same class
		$reflectable = new ReflectableFunction('TestSee\seeFunction');
		$see         = See::factory($reflectable);
		$this->assertInstanceOf(See::class, $see);
		$this->assertSame('foo', $see->reference());
		$this->assertNull($see->for());

		$reflectable = new ReflectableFunction('TestSee\seeFunctionNoDocBlock');
		$this->assertNull(See::factory($reflectable));
	}

	public function testFactoryQualifiesReference(): void
	{
		// `self::`, `static::` and `::` are all expanded
		// to the full class name of the method
		foreach (['esc', 'escStatic', 'escShort', 'escFull'] as $method) {
			$see = $this->see($method);
			$this->assertSame('TestSee\Vixen::escape()', $see->reference());
			$this->assertSame('escape', $see->for());
		}
	}

	public function testFactoryWithoutTag(): void
	{
		$this->assertNull($this->see('escape'));
		$this->assertNull($this->see('noDocBlock'));
	}

	public function testForWithDifferentSpelling(): void
	{
		// the tag isn't necessarily spelled like the method,
		// but `for()` reports the real method name
		$see = $this->see('escCased');
		$this->assertSame('TestSee\Vixen::ESCAPE()', $see->reference());
		$this->assertSame('escape', $see->for());
	}

	public function testForWithoutMatch(): void
	{
		// method doesn't exist
		$see = $this->see('escUnknown');
		$this->assertSame('TestSee\Vixen::doesNotExist()', $see->reference());
		$this->assertNull($see->for());

		// method of another class
		$see = $this->see('escOtherClass');
		$this->assertSame('TestSee\Cub::escape()', $see->reference());
		$this->assertNull($see->for());

		// a tag that points at its own method is not an alias
		$see = $this->see('escSelf');
		$this->assertSame('TestSee\Vixen::escSelf()', $see->reference());
		$this->assertNull($see->for());

		// external link
		$see = $this->see('escExternal');
		$this->assertSame('https://getkirby.com', $see->reference());
		$this->assertNull($see->for());
	}

	public function testReference(): void
	{
		$see = new See('Kirby\Cms\App::user()');
		$this->assertSame('Kirby\Cms\App::user()', $see->reference());
		$this->assertNull($see->for());
	}

	public function testToString(): void
	{
		$see = new See('Kirby\Cms\App::user()', 'user');
		$this->assertSame('Kirby\Cms\App::user()', (string)$see);
		$this->assertSame('user', $see->for());
	}
}
