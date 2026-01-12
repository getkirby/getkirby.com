<?php

use Kirby\Cms\File;

class VirtualFile extends File
{
	public function isResizable(): bool
	{
		return false;
	}
}
