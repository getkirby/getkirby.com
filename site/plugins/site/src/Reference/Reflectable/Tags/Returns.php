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
		$types   = $reflectable->doc()->getReturnNode()?->type;
		$types ??= $reflectable->reflection->getReturnType();

		if ($types === null) {
			return null;
		}

		$types = Types::factory($types, $reflectable);
		return new static($types);
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
