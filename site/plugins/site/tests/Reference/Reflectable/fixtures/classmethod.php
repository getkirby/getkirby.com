<?php

namespace Bar;

class Fox {
	public function __construct()
	{
	}

	public function bar(string $a, int $b): self
	{
	}

	public static function barStatic()
	{
	}

	/**
	 * @see self::baz
	 */
	public function barWithDocBlock()
	{
	}
}

class ChildFox extends Fox
{
}
class Vixen
{
	public function escape()
	{
	}

	/**
	 * @see self::escape()
	 */
	public function esc()
	{
	}

	/**
	 * @see self::escape()
	 */
	public function escapeHtml()
	{
	}

	/**
	 * @see self::doesNotExist()
	 */
	public function escapeUnknown()
	{
	}
}
