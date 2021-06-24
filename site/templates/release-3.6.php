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

<section id="get-started" class="mb-42">
  <h2 class="h2 text-center mb-6">What are you waiting for?</h2>
  <?php snippet('cta', [
    'buttons' => [
      [
        'text' => 'Try now',
        'link' => '/try',
        'icon' => 'download'
      ],
      [
        'text'  => 'Guide',
        'link'  => $page->children()->first()->url(),
        'icon'  => 'flash',
        'style' => 'outlined'
      ]
    ]
  ]) ?>
</section>
