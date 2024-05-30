<?php

include_once __DIR__ . '/helpers.php';

load([
	'kirby\\cdn\\optimizer' => __DIR__ . '/src/Optimizer.php'
]);

use Kirby\Cdn\Optimizer;
use Kirby\Cms\App;
use Kirby\Cms\FileVersion;

App::plugin('getkirby/cdn', [
	'components'   => [
		'file::url' => function (App $kirby, $file): string {
			static $original;

			if ($file->type() === 'image') {
				return cdn($file);
			}

			$original ??= $kirby->nativeComponent('file::url');

			return $original($kirby, $file);
		},
		'file::version' => function (App $kirby, $file, $options) {
			static $original;

			if ($kirby->option('cdn', false) !== false) {
				$url = cdn($file, $options);

				return new FileVersion([
					'modifications' => $options,
					'original'      => $file,
					'root'          => $file->root(),
					'url'           => $url,
				]);
			}

			$original ??= $kirby->nativeComponent('file::version');

			return $original($kirby, $file, $options);
		},
		'url' => function (App $kirby, $path, $options): string {
			static $original;

			if (preg_match('!assets\/!', $path ?? '')) {
				$cdn       = $kirby->option('cdn', false) !== false;
				$optimizer = new Optimizer($cdn);

				$path = ltrim($path, '/');
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
