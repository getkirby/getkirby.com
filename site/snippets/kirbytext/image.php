<?php

extract([
	'alt'     => $alt ?? null,
	'class'   => $class ?? null,
	'file'    => $file ?? null,
	'link'    => $link ?? null,
	'caption' => $caption ?? null
]);

echo Html::figure(
	[
		Html::a(
			$link ?? $file->url(),
			[
				img($file, [
					'src'   => [
						'width' => 924
					],
					'alt'   => $alt ?? $file->alt()->or($caption),
					'class' => 'rounded',
					'srcset' => [
						462,
						690,
						924,
						1380,
						1848,
					],
				])
			],
			[
				'data-lightbox' => !$link
			]
		)
	],
	$caption,
	[
		'class' => trim('image ' . $class)
	]
);
