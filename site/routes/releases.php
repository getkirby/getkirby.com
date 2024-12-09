<?php

return [
	[
		'pattern' => 'releases/(:num)',
		'action'  => fn ($major) =>
			page('releases/' . $major) ??
			go('releases/' . $major . '.0')
	],
	[
		'pattern' => 'releases/(:num)\-(:any)',
		'action'  => fn ($generation, $major) =>
			go('releases/' . $generation . '.' . $major)
	],
	[
		'pattern' => 'releases/(:num)\.(:any)',
		'action'  => fn ($generation, $major) =>
			page('releases/' . $generation . '-' . $major) ??
			($major === '0' ? go('releases/' . $generation) : null)
	],
	[
		'pattern' => 'releases/(:num)\.(:any)/(:all?)',
		'action'  => fn ($generation, $major, $path) =>
			page('releases/' . $generation . '-' . $major . '/' . $path)
	],
	[
		'pattern' => 'releases.rss',
		'action'  => fn () => go('https://github.com/getkirby/kirby/releases.atom')
	]
];
