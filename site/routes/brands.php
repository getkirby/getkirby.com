<?php

return [
	[
		'pattern' => 'brands/(:all?)',
		'action' => function () {
			go('/');
		}
	]
];
