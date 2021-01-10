<?php

extract([
  'image'   => $image   ?? null,
  'alt'     => $alt     ?? null,
  'caption' => $caption ?? null,
  'link'    => $link    ?? null
]);

if (!$image) {
  return false;
}

$html = [
  $image->resize(800)->html([
    'alt' => $alt,
  ])
];

if ($link) {
  $html = [
    Html::a($link, $html)
  ];
}

if ($caption) {
  $html[] = Html::figcaption($caption, [
    'class' => 'pt-4 text-sm text-gray-darkest'
  ]);
}

echo Html::tag('figure', $html, [
  'class' => 'my-12'
]);
