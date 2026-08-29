<?php

namespace Kirby\Reference\Reflectable\Tags;

use Kirby\Reference\Reflectable\Reflectable;
use Kirby\Reference\Reflectable\ReflectableClassMethod;
use ReflectionMethod;
use Stringable;

/**
 * Represents a `@see` tag
 */
class See implements Stringable
{
	public function __construct(
		public string $reference,
		public string|null $method = null
	) {
	}

	public function __toString(): string
	{
		return $this->reference;
	}

	public static function factory(Reflectable $reflection): static|null
	{
		$tag = $reflection->doc()->getTagByName('@see');

		if ($tag === null) {
			return null;
		}

		$reference = (string)$tag->value;

		if ($reflection instanceof ReflectableClassMethod === false) {
			return new static(reference: $reference);
		}

		// remove self:: or static:: prefix
		$reference = preg_replace('/^(self|static)::/', '::', $reference);

		// add class name if missing
		if (str_starts_with($reference, '::') === true) {
			$reference = $reflection->class(short: false) . $reference;
		}

		return new static(
			reference: $reference,
			method:    static::method($reflection, $reference)
		);
	}

	/**
	 * Returns the name of the method the tag points to,
	 * if it references another method of the same class
	 */
	public function for(): string|null
	{
		return $this->method;
	}

	/**
	 * Resolves the reference to a method of the same class
	 */
	protected static function method(
		ReflectableClassMethod $reflection,
		string $reference
	): string|null {
		$prefix = $reflection->class(short: false) . '::';

		if (str_starts_with($reference, $prefix) === false) {
			return null;
		}

		$method = rtrim(substr($reference, strlen($prefix)), '()');

		if (method_exists($reflection->class, $method) === false) {
			return null;
		}

		// the `@see` tag isn't necessarily spelled like the method
		$method = new ReflectionMethod($reflection->class, $method);

		// a tag that points at its own method is not an alias
		if (strtolower($method->getName()) === strtolower($reflection->method)) {
			return null;
		}

		return $method->getName();
	}

	/**
	 * Returns the referenced entity
	 */
	public function reference(): string
	{
		return $this->reference;
	}
}
