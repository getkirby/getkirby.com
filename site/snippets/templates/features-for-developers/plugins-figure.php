<?php if ($image = image('matomo.jpg')): ?>
<figure>
  <a class="block bg-light mb-3" href="/plugins" style="--aspect-ratio: <?= $image->width() . '/' . $image->height() ?>">
    <?= img($image, [
      'src' => [
        'width' => 1000,
      ],
      'srcset' => [
        '1x' => [
          'width' => 1000
        ],
        '2x' => [
          'width' => 2000
        ],
      ]
    ]) ?>
  </a>
  <figcaption class="font-mono text-xs color-gray-700">
    <a href="/plugins/sylvainjule/matomo"><strong class="font-normal color-black link">Matomo Plugin</strong> by Sylvain Julé</a>
  </figcaption>
</figure>
<?php endif ?>
