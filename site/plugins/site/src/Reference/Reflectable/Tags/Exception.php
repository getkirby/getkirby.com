<?php

namespace Kirby\Reference\Reflectable\Tags;

use Kirby\Reference\Types\Types;
use PHPStan\PhpDocParser\Ast\PhpDoc\ThrowsTagValueNode;

class Exception
{
	public function __construct(
		public Types $types,
		public string $description
	) {
	}

	public function description(): string
	{
		return $this->description;
	}

	public static function factory(ThrowsTagValueNode $tag): static|null
	{
		return new static(
			types:       Types::factory($tag->type),
			description: $tag->description
		);
	}

	public function types(): Types
	{
		return $this->types;
	}
}
