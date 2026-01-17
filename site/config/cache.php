<?php

return [
	'diffs' => [
		'active' => true,
		'type'   => 'file'
	],
	'github' => [
		'active' => true,
		'type'   => 'file'
	],
	'pages' => [
		'active' => true,
		'type'   => 'file',
		'ignore' => function ($page) {
			$ignore = [
				'buy',
				'features-for-clients',
				'home',
				'love',
				'partners',
				'scenario-education',
				'themes',
			];

			if (in_array($page->id(), $ignore, true)) {
				return true;
			}

			if ($page instanceof PartnerPage) {
				return true;
			}
		}
	],
	'reference' => [
		'active' => true,
		'type'   => 'file'
	]
];
