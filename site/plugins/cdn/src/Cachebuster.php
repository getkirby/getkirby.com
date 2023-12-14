<?php

namespace Kirby\Cdn;

use Kirby\Cms\App;

class Cachebuster
{
	protected static function version(string $root, string $path): string
	{
		return dechex(filemtime($root));
	}

	public static function path(string $path): string
	{
		if (strpos($path, url()) === 0) {
			$path = ltrim(substr($path, strlen(url())), '/');
		}

		$kirby = App::instance();
		$root  = $kirby->root('index') . '/' . $path;

		if (file_exists($root)) {
			$version = static::version($root, $path);
			$path = $path . '?v=' . $version;
		}

		return $path;
	}

}
