<?php

namespace Kirby\Reference\Reflectable\Tags;

use Kirby\Reference\Reflectable\ReflectableFunction;
use Kirby\Reference\Types\Types;

class Returns
{
	public function __construct(
		public Types $types
	) {
	}

	public static function factory(
		ReflectableFunction $reflectable
	): static|null {
		$types   = $reflectable->reflection->getReturnType();
		$tag     = $reflectable->doc->getTagsByName('return')[0] ?? null;
		$types ??= $tag?->getType();

		if ($types === null) {
			return null;
		}

		return new static(types: Types::factory($types));
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

	public function toHtml(): string
	{
		return $this->types->toHtml();
	}

	public function toString(): string
	{
		return $this->types->toString();
	}
}
