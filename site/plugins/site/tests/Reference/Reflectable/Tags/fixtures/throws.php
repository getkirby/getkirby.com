<?php

use Kirby\Exception\NotFoundException;

class Throws
{
	/**
	 * @throws Kirby\Exception\Exception When something goes wrong
	 */
	public function throws()
	{
	}

	/**
	 * @throws NotFoundException When nothing was found
	 */
	public function throwsImported()
	{
	}

	public function throwsNot()
	{
	}
}
