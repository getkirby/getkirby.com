<?php

namespace Kirby\Reference\Types;

use Closure;
use PHPStan\PhpDocParser\Ast\AbstractNodeVisitor;
use PHPStan\PhpDocParser\Ast\Node;
use PHPStan\PhpDocParser\Ast\NodeTraverser;
use PHPStan\PhpDocParser\Ast\NodeVisitor\CloningVisitor;
use PHPStan\PhpDocParser\Ast\Type\TypeNode;

/**
 * Calls a closure for each node of a type,
 * which can change or replace the node
 */
class ClosureVisitor extends AbstractNodeVisitor
{
	public function __construct(
		protected Closure $enter
	) {
	}

	public function enterNode(Node $node): Node|int|null
	{
		return ($this->enter)($node);
	}

	/**
	 * Returns a copy of the type with the closure
	 * applied to all its nodes; the original type stays
	 * untouched, as parsed doc blocks are cached
	 */
	public static function map(TypeNode $node, Closure $enter): TypeNode
	{
		$traverser = new NodeTraverser([
			new CloningVisitor(),
			new static($enter)
		]);

		return $traverser->traverse([$node])[0];
	}
}
