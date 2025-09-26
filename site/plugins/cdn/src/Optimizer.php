<?php

namespace Kirby\Cdn;

use Kirby\Cms\App;

/**
 * Helper class for dynamic asset URL optimization
 *
 * @package   Kirby Cdn
 * @author    Lukas Bestle <lukas@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier
 * @license   https://opensource.org/licenses/MIT
 */
class Optimizer
{
	public function __construct(
		public readonly bool $cdn
	) {
	}

	/**
	 * Replaces the file path with its dist equivalent
	 * if it exists and if in CDN mode
	 */
	public function distPath(string $path): string
	{
		if ($this->cdn === false) {
			return $path;
		}

		if (substr($path, 0, 7) === 'assets/') {
			$distPath = 'assets/dist/' . substr($path, 7);

			if (static::root($distPath) !== null) {
				return $distPath;
			}
		}

		return $path;
	}

	/**
	 * Adds or injects the file modification time into
	 * the path if the file exists
	 */
	public function cachebust(string $path): string
	{
		// convert absolute URL to a relative path
		if (strpos($path, url()) === 0) {
			$path = ltrim(substr($path, strlen(url())), '/');
		}

		if ($root = static::root($path)) {
			$version = filemtime($root);

			if ($this->cdn === false) {
				return $path . '?v=' . $version;
			}

			// inject the version into the filename
			$parts = explode('.', $path);
			$ext   = array_pop($parts);
			return implode('.', $parts) . '.' . $version . '.' . $ext;
		}

		return $path;
	}

	/**
	 * Returns the absolute file root of a file inside
	 * the site index directory if it exists
	 */
	protected static function root(string $path): string|null
	{
		$kirby = App::instance();
		$root  = $kirby->root('index') . '/' . $path;

		if (is_file($root) === true) {
			return $root;
		}

		return null;
	}
}
