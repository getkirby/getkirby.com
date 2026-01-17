<?php

namespace Kirby\Cdn;

use Kirby\Cms\File;
use Kirby\Image\Dimensions;

/**
 * A file that comes from an external API and
 * is virtually mirrored through the CDN
 *
 * @package   Kirby Cdn
 * @author    Sonja Broda <sonja@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
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
		return $this->kirby()->option('cdn', false) !== false;
	}

	public function width(): int
	{
		return $this->dimensions()->width();
	}
}
