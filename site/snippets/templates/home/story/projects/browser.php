<div class="columns" style="--columns: 2; --gap: var(--spacing-6)">
  <div>
    <div class="text-base mb-3">
      <div>Creatious labs</div>
      <div class="color-gray-500">Product design</div>
    </div>
    <div class="text-3xs color-gray-400">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor.</div>
  </div>
  <div class="playground-medium-browser-gallery">
    <?php foreach ($story->images()->filterBy('name', '^=', 'project') as $image): ?>
    <figure>
      <div class="bg-light" style="--aspect-ratio: 1/1">
        <?php if ($image->name() === 'project-a'): ?>
          <?= img($image, [
            'src' => [
              'crop'   => 'top',
              'width'  => 240,
            ],
            'srcset' => [
              '1x' => [
                'crop'   => 'top',
                'width'  => 240,
              ],
              '2x' => [
                'crop'   => 'top',
                'width'  => 480
              ],
            ]
          ]) ?>
        <?php else: ?>
          <?= img($image, [
            'src' => [
              'crop'   => true,
              'width'  => 60,
            ],
            'srcset' => [
              '1x' => [
                'crop'   => true,
                'width'  => 60,
              ],
              '2x' => [
                'crop'   => true,
                'width'  => 120
              ],
            ]
          ]) ?>
        <?php endif ?>
      </div>
    </figure>
    <?php endforeach ?>
  </div>
</div>
