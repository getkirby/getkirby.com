<?php

return [
	[
		'pattern' => 'releases/(:num)',
		'action'  => fn ($major) =>
			page('releases/' . $major) ??
			(($p = page('releases/' . $major . '-0')) ? go($p) : null)
	],
	[
		'pattern' => 'releases/(:num)\.(:num)\.(:num)',
		'action'  => fn ($major, $minor, $patch) =>
			(($minor === '0' && $patch === '0' && $p = page('releases/' . $major)) ? go($p) : null) ??
			(($patch === '0' && $p = page('releases/' . $major . '-' . $minor)) ? go($p) : null) ??
			go('https://github.com/getkirby/kirby/releases/tag/' . $major . '.' . $minor . '.' . $patch)
	],
	[
		'pattern' => 'releases/(:num)/(:all?)',
		'action'  => fn ($major, $path) =>
			page('releases/' . $major . '/' . $path) ??
			(($p = page('releases/' . $major . '-0/' . $path)) ? go($p) : null)
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
			(($major === '0' && $p = page('releases/' . $generation)) ? go($p) : null)
	],
	[
		'pattern' => 'releases/(:num)\.(:any)/(:all?)',
		'action'  => fn ($generation, $major, $path) =>
			page('releases/' . $generation . '-' . $major . '/' . $path) ??
			(($major === '0' && $p = page('releases/' . $generation . '/' . $path)) ? go($p) : null)
	],
	[
		'pattern' => 'releases.rss',
		'action'  => fn () => go('https://github.com/getkirby/kirby/releases.atom')
	]
];
