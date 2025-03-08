<?php

namespace Kirby\Reference\Reflectable\Tags;

use Kirby\Reference\Reflectable\ReflectableFunction;
use Kirby\Reference\Types\Types;

class Returns
{
	public function __construct(
		public Types $types,
		public string|null $description = null
	) {
	}

	public function description(): string|null
	{
		return $this->description;
	}

	public static function factory(
		ReflectableFunction $reflectable
	): static|null {
		$tag     = $reflectable->doc()->getReturnNode();
		$types   = $tag?->type;
		$types ??= $reflectable->reflection->getReturnType();

		if ($types === null) {
			return null;
		}

		$types       = Types::factory($types, $reflectable);
		$description = $tag?->description;

		return new static($types, $description);
	}

	public function isMutable(): bool
	{
		return $this->types->has('$this');
	}

	public function isImmutable(): bool
	{
		return $this->types->has('static') ||
			   $this->types->has('self');
	}

	public function isVoid(): bool
	{
		return $this->types->has('void');
	}

	public function types(): Types
	{
		return $this->types;
	}
}
