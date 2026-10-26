<?php

namespace TestTypes\Generics;

use TestTypes\A as Base;

class Files
{
}

class Item
{
}

/**
 * @template TValue of Item
 */
class Items
{
	/**
	 * @return list<TValue>
	 */
	public function all(): array
	{
		return [];
	}

	/**
	 * @return Base|null
	 */
	public function base(): Base|null
	{
		return null;
	}

	/**
	 * @param callable(int|string $key): bool $test
	 */
	public function filter(callable $test): static
	{
		return $this;
	}

	/**
	 * @return ($list is true ? list<int|string> : string)
	 */
	public function pool(bool $list = true): array|string
	{
		return [];
	}

	/**
	 * @template T
	 * @param list<T> $list
	 * @return list<T>
	 */
	public function reverse(array $list): array
	{
		return $list;
	}

	/**
	 * @return array{files: Files, count: int}
	 */
	public function shape(): array
	{
		return [];
	}
}
