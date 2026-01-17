<?php

namespace Kirby\Cdn;

use Kirby\Cms\App;
use Kirby\Cms\File;
use Kirby\Filesystem\Asset;
use Kirby\Http\Url;
use Kirby\Image\Darkroom;
use Kirby\Image\Focus;

/**
 * Helper class for KeyCDN image processing
 *
 * @package   Kirby Cdn
 * @author    Lukas Bestle <lukas@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Image
{
	protected App $app;
	protected array $options;
	protected string $url;

	/**
	 * @param string|\Kirby\Filesystem\Asset|\Kirby\Cms\File $file File path or object
	 * @param array $options Kirby thumb options
	 */
	public function __construct(
		protected string|Asset|File $file,
		array $options = []
	) {
		if (is_object($file) === true) {
			$this->app = $file->kirby();
			$this->url = $file->mediaUrl();
			$root      = $file->root();
		} else {
			$this->app = App::instance();
			$this->url = $file;
			$root      = $this->app->root('index') . '/' . $file;
		}

		$darkroom = Darkroom::factory(
			'im',
			$this->app->option('thumbs', [])
		);
		$optionsProcessed = $darkroom->preprocess($root, $options);

		// cannot determine the size in `$darkroom->preprocess()`
		// if file is not present in the filesystem
		if ($file instanceof VirtualFile) {
			$optionsProcessed['sourceWidth']  = $file->width();
			$optionsProcessed['sourceHeight'] = $file->height();

			$dimensions      = $file->dimensions();
			$thumbDimensions = $dimensions->thumb($options);

			$optionsProcessed['width']  = $thumbDimensions->width();
			$optionsProcessed['height'] = $thumbDimensions->height();

			// scale ratio compared to the source dimensions
			$optionsProcessed['scaleWidth'] = Focus::ratio(
				$optionsProcessed['width'],
				$optionsProcessed['sourceWidth']
			);
			$optionsProcessed['scaleHeight'] = Focus::ratio(
				$optionsProcessed['height'],
				$optionsProcessed['sourceHeight']
			);
		}

		$this->options = $optionsProcessed;
	}

	/**
	 * Returns the relative path to the image
	 */
	public function path(): string
	{
		return Url::path($this->url);
	}

	/**
	 * Generates KeyCDN image processing parameters
	 * (https://www.keycdn.com/support/image-processing)
	 */
	public function query(): string
	{
		if (empty($this->options) === true) {
			return '';
		}

		return '?' . http_build_query([
			...static::resizeOrCrop(),
			...static::grayscale(),
			...static::progressive(),
			...static::blur(),
			...static::sharpen(),
		]);
	}

	/**
	 * Generates a URL with KeyCDN image processing parameters
	 * (https://www.keycdn.com/support/image-processing)
	 */
	public function url(): string
	{
		if ($this->file instanceof VirtualFile) {
			return $this->file->url() . $this->query();
		}

		return $this->app->option('cdn.domain') . '/' . $this->path() . $this->query();
	}

	protected function blur(): array
	{
		if ($this->options['blur'] !== false) {
			return [
				'blur' => max(0.3, min(100, $this->options['blur']))
			];
		}

		return [];
	}

	protected function grayscale(): array
	{
		if ($this->options['grayscale'] === true) {
			return ['grayscale' => 1];
		}

		return [];
	}

	protected function progressive(): array
	{
		if ($this->options['interlace'] === true) {
			return ['progressive' => 1];
		}

		return [];
	}

	protected function resizeOrCrop(): array
	{
		$query = [
			'width'  => $this->options['width'],
			'height' => $this->options['height'],
		];

		// simple resize
		if ($this->options['crop'] === false) {
			$query['enlarge'] = 0;

			return $query;
		}

		// crop based on focus point
		if (Focus::isFocalPoint($this->options['crop']) === true) {
			$focus = Focus::parse($this->options['crop']);
			$query['crop'] = 'fp,' . $focus[0] . ',' . $focus[1];

			return $query;
		}

		// translate the gravity option into something KeyCDN understands
		$query['crop'] = match ($this->options['crop'] ?? null) {
			'top left'     => 'fp,0,0',
			'top'          => 'fp,0.5,0',
			'top right'    => 'fp,1.0,0',
			'left'         => 'fp,0,0.5',
			'center'       => 'fp,0.5,0.5',
			'right'        => 'fp,1,0.5',
			'bottom left'  => 'fp,0,1.0',
			'bottom'       => 'fp,0.5,1.0',
			'bottom right' => 'fp,1.0,1.0',
			default        => 'smart'
		};

		return $query;
	}

	protected function sharpen(): array
	{
		if (is_int($this->options['sharpen']) === true) {
			return [
				'sharpen' => max(0, min(100, $this->options['sharpen']))
			];
		}

		return [];
	}
}
