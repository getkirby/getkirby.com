<?php

load([
	'kirby\\cdn\\fileversion' => __DIR__ . '/src/FileVersion.php',
	'kirby\\cdn\\image'       => __DIR__ . '/src/Image.php',
	'kirby\\cdn\\optimizer'   => __DIR__ . '/src/Optimizer.php'
]);

use Kirby\Cdn\FileVersion;
use Kirby\Cdn\Image;
use Kirby\Cdn\Optimizer;
use Kirby\Cms\App;
use Kirby\Cms\Url;

App::plugin('getkirby/cdn', [
	'components' => [
		'css' => function (App $kirby, string $url, $options = null): string {
			$header = $kirby->response()->header('Link') ?? '';

			if (empty($header) === false) {
				$header .= ', ';
			}

			$header .= '<' . Url::to($url) . '>; rel="preload"; as="style"';

			$kirby->response()->header('Link', $header);
			return $url;
		},
		'file::url' => function (App $kirby, $file): string {
			static $original;

			if ($file->type() === 'image') {
				return (new Image($file))->url();
			}

			$original ??= $kirby->nativeComponent('file::url');

			return $original($kirby, $file);
		},
		'file::version' => function (App $kirby, $file, $options) {
			static $original;

			if ($kirby->option('cdn', false) !== false) {
				return new FileVersion([
					'modifications' => $options,
					'original'      => $file,
					'root'          => $file->root(),
				]);
			}

			$original ??= $kirby->nativeComponent('file::version');

			return $original($kirby, $file, $options);
		},
		'url' => function (App $kirby, $path, $options): string {
			static $original;

			if (str_starts_with($path ?? '', 'assets')) {
				$cdn       = $kirby->option('cdn', false) !== false;
				$optimizer = new Optimizer($cdn);

				$path = ltrim($path, '/');
				$path = $optimizer->distPath($path);
				$path = $optimizer->cachebust($path);

				if ($cdn === true) {
					return $kirby->option('cdn.domain') . '/' . $path;
				}
			}

			$original ??= $kirby->nativeComponent('url');

			return $original($kirby, $path, $options);
		},
	]
]);
