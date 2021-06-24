<?php layout() ?>
<?= css('assets/css/layouts/features.css') ?>

<header class="mb-12 flex items-end justify-between">
  <div>
    <h1 class="h1">3.6-alpha ⚡</h1>
    <p class="h1 color-gray-600">Developer preview</p>
  </div>

  <?php snippet('cta', [
    'buttons' => [
      [
        'text' => 'Try now',
        'link' => '/try',
        'icon' => 'download',
        'style' => 'filled'
      ],
    ],
    'center' => false,
    'mb' => 0
  ]) ?>
</header>

<?php snippet('templates/release-36/roadmap') ?>
<?php snippet('templates/release-36/fiber') ?>
<?php snippet('templates/release-36/plugins') ?>
<?php snippet('templates/release-36/cardlets') ?>

