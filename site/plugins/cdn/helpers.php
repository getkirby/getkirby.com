<?php

use Kirby\Cdn\Image;
use Kirby\Cms\File;

/**
 * Generates a URL with KeyCDN image processing parameters
 * (https://www.keycdn.com/support/image-processing)
 * based on a file URL or object and Kirby thumb params
 */
function cdn(string|File $file, array $params = []): string
{
	return Image::url($file, $params);
}
