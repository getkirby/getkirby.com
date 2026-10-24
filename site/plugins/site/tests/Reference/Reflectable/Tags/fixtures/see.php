<?php

namespace TestSee;

/**
 * @see foo
 */
function seeFunction()
{
}

function seeFunctionNoDocBlock()
{
}

class Vixen
{
	public function escape()
	{
	}

	public function noDocBlock()
	{
	}

	/**
	 * @see self::escape()
	 */
	public function esc()
	{
	}

	/**
	 * @see static::escape()
	 */
	public function escStatic()
	{
	}

	/**
	 * @see ::escape()
	 */
	public function escShort()
	{
	}

	/**
	 * @see TestSee\Vixen::escape()
	 */
	public function escFull()
	{
	}

	/**
	 * The `@see` tag isn't necessarily spelled like the method
	 *
	 * @see self::ESCAPE()
	 */
	public function escCased()
	{
	}

	/**
	 * @see self::doesNotExist()
	 */
	public function escUnknown()
	{
	}

	/**
	 * @see TestSee\Cub::escape()
	 */
	public function escOtherClass()
	{
	}

	/**
	 * @see self::escSelf()
	 */
	public function escSelf()
	{
	}

	/**
	 * @see https://getkirby.com
	 */
	public function escExternal()
	{
	}
}

class Cub
{
	public function escape()
	{
	}
}
