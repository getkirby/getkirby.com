<figure>
  <?= img('cardlets.png', [
    'alt' => 'A screenshot of the new cardlets layout',
    'lightbox' => true,
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
</figure>
<br>
<?= $page->cardlets()->kt() ?>
