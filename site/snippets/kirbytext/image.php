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
    Html::a($link ?? $file->url(),
      [
        img($file, [
          'alt'   => $alt ?? $file->alt()->or($caption),
					'class' => 'rounded',
          'src'   => [
            'width' => 960
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
