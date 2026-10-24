<?php

namespace Kirby\Reference\Reflectable;

use PHPStan\PhpDocParser\Ast\Type\GenericTypeNode;
use PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use ReflectionFunction;

#[CoversClass(Doc::class)]
class DocTest extends TestCase
{
	public function testFactory(): void
	{
		/**
		 * Some summary
		 * @since 6.0.0
		 */
		$a = function () {
		};

		$doc = Doc::factory(new ReflectionFunction($a));
		$this->assertSame('6.0.0', (string)$doc->getTagByName('@since')->value);

		// doc blocks are parsed once
		$this->assertSame($doc, Doc::factory(new ReflectionFunction($a)));
	}

	public function testFactoryWithoutDocBlock(): void
	{
		$doc = Doc::factory(new ReflectionFunction(fn () => null));
		$this->assertSame([], $doc->children);
	}

	public function testParseType(): void
	{
		$type = Doc::parseType('array<string, int>');
		$this->assertInstanceOf(GenericTypeNode::class, $type);
		$this->assertSame('array<string, int>', (string)$type);

		// invalid types are kept as identifier
		$type = Doc::parseType('foo bar');
		$this->assertInstanceOf(IdentifierTypeNode::class, $type);
		$this->assertSame('foo bar', $type->name);
	}
}
