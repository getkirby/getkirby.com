<?php

extract([
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
          'alt' => $file->alt()->or($caption),
          'src' => [
            'width' => 960
          ],
          'srcset' => [320, 640, 960, 1280],
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
