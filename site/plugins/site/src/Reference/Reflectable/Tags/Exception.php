<?php

namespace Kirby\Reference\Reflectable\Tags;

use Kirby\Reference\Reflectable\Reflectable;
use Kirby\Reference\Types\Types;
use PHPStan\PhpDocParser\Ast\PhpDoc\ThrowsTagValueNode;

/**
 * Represents a single `@throws` tag
 */
class Exception
{
	public function __construct(
		public Types $types,
		public string|null $description = null
	) {
	}

	/**
	 * Returns the description of the throws tag
	 */
	public function description(): string
	{
		return $this->description;
	}

	public static function factory(
		ThrowsTagValueNode $tag,
		Reflectable|null $reflectable = null
	): static {
		return new static(
			types:       Types::fromNode($tag->type, $reflectable),
			description: $tag->description
		);
	}

	/**
	 * Returns the types of the throws tag
	 */
	public function types(): Types
	{
		return $this->types;
	}
}
