<?php

namespace Kirby\Cdn;

use Kirby\Cms\App;

class Optimizer
{
	public function __construct(public readonly bool $cdn)
	{
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

		$root = static::root($path);
		if (file_exists($root) === true) {
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

		if (is_file($root)) {
			return $root;
		}

		return null;
	}
}
