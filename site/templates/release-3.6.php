<?php layout() ?>
<?= css('assets/css/layouts/features.css') ?>

<header class="mb-36 flex items-end justify-between release-header">
  <style>
    @media (max-width: 50rem) {
      .release-header {
        flex-direction: column;
        align-items: initial;
      }

      .release-header nav {
        margin: 2rem 0 0;
      }
    }
  </style>

  <div>
    <h1 class="h1"><?= $page->title() ?></h1>
    <p class="h1 color-gray-600">Jungle Calumna</p>
  </div>

  <?php snippet('cta', [
    'buttons' => [
      [
        'text' => 'Try now',
        'link' => $page->link(),
        'icon' => 'download',
        'style' => 'filled'
      ],
      [
        'text'  => 'Docs',
        'link'  => '/docs',
        'icon'  => 'book',
        'style' => 'outlined'
      ]
    ],
    'center' => false,
    'mb' => 0
  ]) ?>
</header>

<?php snippet('templates/release-36/blocks') ?>
<?php snippet('templates/release-36/cardlets') ?>
<?php snippet('templates/release-36/image-formats') ?>
<?php snippet('templates/release-36/views') ?>

<?php snippet('templates/release-36/fiber') ?>
<?php snippet('templates/release-36/plugins') ?>

<!-- <section id="assets" class="mb-42">
  <div class="columns" style="--columns: 2; --gap: var(--spacing-24)">
    <div>
      <?php snippet('templates/features/intro', [
        'title' => 'Image options on steriods',
        'intro' => 'Improve your previews with custom queries',
        'text'  => $page->imageSettingsIntro()->kt(),
      ]) ?>

      <figure class="bg-black rounded">
        <?= $page->imageSettings()->kt() ?>
      </figure>

    </div>
  </div>
</section> -->

<?php snippet('templates/release-36/icons') ?>

<p class="h2 color-gray-600 mb-42 max-w-xl">
  <span class="color-black">This release is big</span>
  <br>
  More than 1200 commits 😱
  <br>
  Ready to read the full changelog?
  <br>
  Here we go …
</p>


<?php snippet('templates/release-36/changes/panel') ?>
<?php snippet('templates/release-36/changes/templating') ?>
<?php snippet('templates/release-36/changes/plugins') ?>
<?php snippet('templates/release-36/changes/security') ?>
<?php snippet('templates/release-36/changes/core') ?>
<?php snippet('templates/release-36/stats') ?>

<section id="get-started" class="mb-42">
  <h2 class="h2 text-center mb-6">Get started</h2>
  <?php snippet('cta', [
    'buttons' => [
      [
        'text' => 'Try now',
        'link' => $page->link(),
        'icon' => 'download'
      ],
      [
        'text'  => 'Docs',
        'link'  => '/docs',
        'icon'  => 'book',
        'style' => 'outlined'
      ]
    ]
  ]) ?>
</section>
