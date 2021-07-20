<div class="text-sm">
  H&C
</div>
<div class="text-sm color-gray-500 mb-3">
  Digital Agency
</div>

<div class="mb-6" style="--aspect-ratio: 2/1">
<?= img($story->image('agency.jpg'), [
  'src' => [
    'crop'   => true,
    'width'  => 500,
    'height' => 250,
  ],
  'srcset' => [
    '1x' => [
      'crop'   => true,
      'width'  => 500,
      'height' => 250,
    ],
    '2x' => [
      'crop'   => true,
      'width'  => 750,
      'height' => 375,
    ],
  ]
]) ?>
</div>

<div class="text-2xs mb-3">Featured work</div>

<div class="columns" style="--columns: 3">
  <?php foreach ($story->images()->filterBy('name', '^=', 'project') as $image): ?>
  <div>
    <div style="--aspect-ratio: 3/2">
      <?= img($image, [
        'src' => [
          'crop'   => true,
          'width'  => 150,
          'height' => 100,
        ],
        'srcset' => [
          '1x' => [
            'crop'   => true,
            'width'  => 150,
            'height' => 100,
          ],
          '2x' => [
            'crop'   => true,
            'width'  => 300,
            'height' => 200,
          ],
        ]
      ]) ?>
    </div>
  </div>
  <?php endforeach ?>
</div>
