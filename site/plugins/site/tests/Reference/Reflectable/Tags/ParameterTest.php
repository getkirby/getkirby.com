<?php

namespace Kirby\Reference\Reflectable\Tags;

use Kirby\Reference\Reflectable\ReflectableFunction;
use Kirby\Reference\Types\Types;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Parameter::class)]
class ParameterTest extends TestCase
{
	public function setUp(): void
	{
		require_once __DIR__ . '/fixtures/parameters.php';
	}

	public function testDefault(): void
	{
		$parameter = new Parameter('a', Types::factory('string'), default: '"foo"');
		$this->assertSame('"foo"', $parameter->default());
	}

	public function testDescription(): void
	{
		$parameter = new Parameter('a', Types::factory('string'), description: 'Something');
		$this->assertSame('Something', $parameter->description());
	}

	public function testFactory(): void
	{
		$reflectable = new ReflectableFunction('parameters');

		$parameter = $reflectable->reflection->getParameters()[0];
		$parameter = Parameter::factory(parameter: $parameter);
		$this->assertSame('string $a', $parameter->toString());
		$this->assertTrue($parameter->isRequired());

		$parameter = $reflectable->reflection->getParameters()[1];
		$parameter = Parameter::factory(parameter: $parameter);
		$this->assertSame('string $b = \'bar\'', $parameter->toString());
		$this->assertFalse($parameter->isRequired());

		$parameter = $reflectable->reflection->getParameters()[2];
		$parameter = Parameter::factory(parameter: $parameter);
		$this->assertSame('string|null $c = null', $parameter->toString());
		$this->assertFalse($parameter->isRequired());

		$doc       = $reflectable->doc()->getParamTagValues()[0];
		$parameter = Parameter::factory(doc: $doc);
		$this->assertSame('mixed $e', $parameter->toString());

		$reflectable = new ReflectableFunction('parametersVariadic');
		$parameter   = $reflectable->reflection->getParameters()[0];
		$parameter   = Parameter::factory(parameter: $parameter);
		$this->assertTrue($parameter->isVariadic());
		$this->assertSame('...$args', $parameter->toString());

		$reflectable = new ReflectableFunction('parametersWithDescriptions');
		$doc         = $reflectable->doc()->getParamTagValues()[0];
		$parameter   = Parameter::factory(doc: $doc);
		$this->assertTrue($parameter->hasDescription());
		$this->assertSame('Something', $parameter->description());

		$reflectable = new ReflectableFunction('parametersDefaults');

		$parameter   = $reflectable->reflection->getParameters()[0];
		$parameter   = Parameter::factory(parameter: $parameter);
		$this->assertNull($parameter->default());

		$parameter   = $reflectable->reflection->getParameters()[1];
		$parameter   = Parameter::factory(parameter: $parameter);
		$this->assertSame('\'foo\'', $parameter->default());

		$parameter   = $reflectable->reflection->getParameters()[2];
		$parameter   = Parameter::factory(parameter: $parameter);
		$this->assertSame('[ ]', $parameter->default());

		$parameter   = $reflectable->reflection->getParameters()[3];
		$parameter   = Parameter::factory(parameter: $parameter);
		$this->assertSame('null', $parameter->default());
	}

	public function testHasDescription(): void
	{
		$parameter = new Parameter('a', Types::factory('string'), description: 'Something');
		$this->assertTrue($parameter->hasDescription());

		$parameter = new Parameter('a', Types::factory('string'));
		$this->assertFalse($parameter->hasDescription());
	}

	public function testIsRequired(): void
	{
		$parameter = new Parameter('a', Types::factory('string'), isRequired: true);
		$this->assertTrue($parameter->isRequired());

		$parameter = new Parameter('a', Types::factory('string'), isRequired: false);
		$this->assertFalse($parameter->isRequired());
	}

	public function testIsVariadic(): void
	{
		$parameter = new Parameter('a', Types::factory('string'), isVariadic: true);
		$this->assertTrue($parameter->isVariadic());

		$parameter = new Parameter('a', Types::factory('string'), isVariadic: false);
		$this->assertFalse($parameter->isVariadic());
	}

	public function testName(): void
	{
		$parameter = new Parameter('a', Types::factory('string'));
		$this->assertSame('$a', $parameter->name());

		$parameter = new Parameter('a', Types::factory('string'), isVariadic: true);
		$this->assertSame('...$a', $parameter->name());
	}

	public function testToString(): void
	{
		$parameter = new Parameter('a', Types::factory('string'), default: '"foo"');
		$this->assertSame('string $a = "foo"', $parameter->toString());

		$parameter = new Parameter('a', Types::factory('string'));
		$this->assertSame('string $a', $parameter->toString());

		$parameter = new Parameter('a', Types::factory('string'), isVariadic: true);
		$this->assertSame('string ...$a', $parameter->toString());
	}

	public function testTypes(): void
	{
		$parameter = new Parameter('a', Types::factory('string'));
		$this->assertInstanceOf(Types::class, $parameter->types());
		$this->assertSame('string', $parameter->types()->toString());
	}
}