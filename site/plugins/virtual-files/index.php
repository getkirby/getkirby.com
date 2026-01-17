<?php

use Kirby\Cms\File;
use Kirby\Image\Dimensions;

class VirtualFile extends File
{
	public function dimensions(): Dimensions
	{
		return new Dimensions(
			$this->propertyData['width']  ?? 0,
			$this->propertyData['height'] ?? 0
		);
	}

	public function height(): int
	{
		return $this->dimensions()->height();
	}

	public function isResizable(): bool
	{
		return false;
	}

	public function width(): int
	{
		return $this->dimensions()->width();
	}
}
