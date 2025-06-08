<?php

namespace Kirby\Reference\Reflectable\Tags;

use Kirby\Reference\Reflectable\ReflectableFunction;
use Kirby\Reference\Types\Types;

/**
 * Represents the return type of a function or method
 */
class Returns
{
	public function __construct(
		public Types $types,
		public string|null $description = null
	) {
	}

	/**
	 * Returns the description of the returns tag
	 */
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

	/**
	 * Returns whether the return type
	 * implies that the function is mutable (`$this`)
	 */
	public function isMutable(): bool
	{
		return $this->types->has('$this');
	}

	/**
	 * Returns whether the return type
	 * implies that the function is immutable (`static` or `self`)
	 */
	public function isImmutable(): bool
	{
		return $this->types->has('static') ||
			   $this->types->has('self');
	}

	/**
	 * Returns whether the return type is `void`
	 */
	public function isVoid(): bool
	{
		return $this->types->has('void');
	}

	/**
	 * Returns the types of the returns tag
	 */
	public function types(): Types
	{
		return $this->types;
	}
}
