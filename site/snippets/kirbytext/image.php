<?php
/**
 * @var string|null $alt
 * @var string|null $caption
 * @var string|null $class
 * @var Kirby\Cms\File $file
 * @var string|null $link
 */

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
					// `sizes=auto` can't resolve the width of prose images
					// (`width: auto`) and falls back to 300px in browsers,
					// so render them at their natural width instead,
					// capped at the prose text width (42rem)
					'sizes' => 'min(' . $file->width() . 'px, 42rem, 100vw)',
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
