<?php

namespace Kirby\Reference\Reflectable\Tags;

use Kirby\Reference\Reflectable\ReflectableFunction;
use Kirby\Reference\Types\Types;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Parameters::class)]
class ParametersTest extends TestCase
{
	public function setUp(): void
	{
		require_once __DIR__ . '/fixtures/parameters.php';
	}

	public function testCount(): void
	{
		$parameters = new Parameters([]);
		$this->assertSame(0, $parameters->count());

		$parameters = new Parameters([
			new Parameter('a', Types::factory('mixed')),
			new Parameter('b', Types::factory('mixed')),
		]);
		$this->assertSame(2, $parameters->count());
	}

	public function testFactory(): void
	{
		$reflectable = new ReflectableFunction('parameters');
		$parameters  = Parameters::factory($reflectable);
		$this->assertInstanceOf(Parameters::class, $parameters);
		$this->assertSame(5, $parameters->count());
		$this->assertSame('string $a, string $b = \'bar\', string|null $c = null, $d = null, mixed $e', $parameters->toString());


		$reflectable = new ReflectableFunction('parametersWithDescriptions');
		$parameters  = Parameters::factory($reflectable);
		$this->assertInstanceOf(Parameters::class, $parameters);
		$this->assertSame(1, $parameters->count());
		$this->assertSame('mixed $a', $parameters->toString());
		$this->assertTrue($parameters->hasDescriptions());

		$reflectable = new ReflectableFunction('parametersVariadic');
		$parameters  = Parameters::factory($reflectable);
		$this->assertInstanceOf(Parameters::class, $parameters);
		$this->assertSame(1, $parameters->count());
		$this->assertSame('...$args', $parameters->toString());

		$reflectable = new ReflectableFunction('parametersVariadicWithDocBlock');
		$parameters  = Parameters::factory($reflectable);
		$this->assertInstanceOf(Parameters::class, $parameters);
		$this->assertSame(2, $parameters->count());
		$this->assertSame('mixed $a, mixed $b', $parameters->toString());
	}

	public function testHasDescriptions(): void
	{
		$parameters = new Parameters([]);
		$this->assertFalse($parameters->hasDescriptions());

		$parameters = new Parameters([
			new Parameter('a', Types::factory('mixed')),
			new Parameter('b', Types::factory('mixed')),
		]);
		$this->assertFalse($parameters->hasDescriptions());

		$parameters = new Parameters([
			new Parameter('a', Types::factory('mixed'), description: 'Something'),
			new Parameter('b', Types::factory('mixed')),
		]);
		$this->assertTrue($parameters->hasDescriptions());
	}

	public function testNot(): void
	{
		$parameters = new Parameters([
			new Parameter('a', Types::factory('mixed')),
			new Parameter('b', Types::factory('mixed')),
		]);

		$this->assertSame(2, $parameters->count());
		$parameters = $parameters->not('a');
		$this->assertSame(1, $parameters->count());
	}

	public function testToArray(): void
	{
		$parameters = new Parameters([]);
		$parameters = $parameters->toArray();
		$this->assertSame([], $parameters);

		$parameters = new Parameters([
			new Parameter('a', Types::factory('mixed')),
			new Parameter('b', Types::factory('mixed')),
		]);
		$parameters = $parameters->toArray();
		$this->assertCount(2, $parameters);
		$this->assertInstanceOf(Parameter::class, $parameters[0]);
		$this->assertSame('$a', $parameters[0]->name());
		$this->assertSame('$b', $parameters[1]->name());
	}

	public function testToString(): void
	{
		$parameters = new Parameters([
			new Parameter('a', Types::factory('string'), default: '"foo"'),
			new Parameter('b', Types::factory('mixed')),
		]);
		$this->assertSame('string $a = "foo", mixed $b', $parameters->toString());
	}
}