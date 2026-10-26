<?php

namespace Kirby\Reference\Types;

use Kirby\Reference\Reflectable\Doc;
use PHPStan\PhpDocParser\Ast\Node;
use PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(ClosureVisitor::class)]
class ClosureVisitorTest extends TestCase
{
	public function testMap(): void
	{
		$original = Doc::parseType('array<string, Foo>');
		$mapped   = ClosureVisitor::map($original, function (Node $node) {
			if ($node instanceof IdentifierTypeNode && $node->name === 'Foo') {
				$node->name = 'Bar';
			}

			return null;
		});

		$this->assertSame('array<string, Bar>', (string)$mapped);

		// the original type stays untouched
		$this->assertSame('array<string, Foo>', (string)$original);
	}

	public function testMapWithReplacement(): void
	{
		$mapped = ClosureVisitor::map(
			Doc::parseType('list<T>'),
			fn (Node $node) => match (true) {
				$node instanceof IdentifierTypeNode && $node->name === 'T' => new IdentifierTypeNode('int'),
				default => null
			}
		);

		$this->assertSame('list<int>', (string)$mapped);
	}
}
