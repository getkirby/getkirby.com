<?php

namespace Kirby\Cdn;

use Kirby\Cms\App;

class Cachebuster
{
	public static function path(string $path): string
	{
		if (strpos($path, url()) === 0) {
			$path = ltrim(substr($path, strlen(url())), '/');
		}

		$kirby = App::instance();
		$root  = $kirby->root('index') . '/' . $path;

		if (file_exists($root) === true) {
			$version = filemtime($root);
			$path = $path . '?v=' . $version;
		}

		return $path;
	}

}
