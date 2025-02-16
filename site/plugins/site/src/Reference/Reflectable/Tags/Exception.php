<?php

namespace Kirby\Reference\Reflectable\Tags;

use Kirby\Reference\Types\Types;
use phpDocumentor\Reflection\DocBlock\Tags\Throws;

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

	public static function factory(Throws $tag): static|null
	{
		return new static(
			types:       Types::factory($tag->getType()),
			description: $tag->getDescription()
		);
	}

	public function types(): Types
	{
		return $this->types;
	}
}
