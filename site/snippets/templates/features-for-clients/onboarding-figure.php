<?php if ($image = image('company.jpg')): ?>
<figure>
  <?= img($image, [
    'class' => 'shadow-2xl',
    'lightbox' => true,
    'src' => [
      'width'  => 1000,
    ],
    'srcset' => [
      '1x' => [
        'width'  => 1000
      ],
      '2x' => [
        'width'  => 1500
      ],
    ]
  ]) ?>
</figure>
<?php endif ?>
