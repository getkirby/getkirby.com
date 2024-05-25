<?php

return [
	[
		'pattern' => 'releases/(:num)\-(:any)',
		'action'  => fn ($generation, $major) =>
			go('releases/' . $generation . '.' . $major)
	],
	[
		'pattern' => 'releases/(:num)\.(:any)',
		'action'  => fn ($generation, $major) =>
			page('releases/' . $generation . '-' . $major)
	],
	[
		'pattern' => 'releases/(:num)\.(:any)/(:all?)',
		'action'  => fn ($generation, $major, $path) =>
			page('releases/' . $generation . '-' . $major . '/' . $path)	]
];
