<?php

namespace Kirby\Reference\Reflectable\Tags;

use Kirby\Reference\Reflectable\Reflectable;
use Kirby\Toolkit\A;
use Kirby\Toolkit\Iterator;

/**
 * Represents a collection of `@throws` tag exceptions
 *
 * @extends \Kirby\Toolkit\Iterator<int, \Kirby\Reference\Reflectable\Tags\Exception>
 */
class Throws extends Iterator
{
	public static function factory(Reflectable $reflection): static|null
	{
		$throws = $reflection->doc()->getThrowsTagValues();

		if (count($throws) === 0) {
			return null;
		}

		$throws = A::map($throws, fn ($tag) => Exception::factory($tag));
		return new static($throws);
	}
}
