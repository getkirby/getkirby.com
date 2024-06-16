<?php

namespace Kirby\Cdn;

use Kirby\Cms\FileVersion as BaseFileVersion;
use Kirby\Image\Dimensions;

/**
 * Modified FileVersion class to provide the correct dimensions
 * for a thumb generated in the CDN context
 * where no actual thumb file can be measured
 *
 * @package   Kirby Cdn
 * @author    Nico Hoffmann <nico@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class FileVersion extends BaseFileVersion
{
	protected Dimensions|null $dimensions = null;

	public function __construct(array $props)
	{
		$image = new Image($props['original'], $props['modifications']);

		parent::__construct([
			...$props,
			'url' => $image->url()
		]);
	}

	public function dimensions(): Dimensions
	{
		if ($this->dimensions !== null) {
			return $this->dimensions;
		}

		$dimensions = new Dimensions(
			width: $this->original()->width(),
			height: $this->original()->height(),
		);

		if (empty($this->modifications()) === false) {
			$dimensions = $dimensions->thumb($this->modifications());
		}

		return $this->dimensions = $dimensions;
	}

	public function height(): int
	{
		return $this->dimensions()->height();
	}

	public function width(): int
	{
		return $this->dimensions()->width();
	}
}
