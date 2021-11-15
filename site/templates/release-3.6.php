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
    <h1 class="h1"><?= $page->title() ?> ⚡</h1>
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
        'text' => '3.6 notes',
        'link' => $page->children()->first()->url(),
        'icon' => 'book',
        'style' => 'outlined'
      ]
    ],
    'center' => false,
    'mb' => 0
  ]) ?>
</header>

<?php snippet('templates/release-36/fiber') ?>
<?php snippet('templates/release-36/plugins') ?>
<?php snippet('templates/release-36/cardlets') ?>

<section id="assets" class="mb-42">
  <div class="columns" style="--columns: 2; --gap: var(--spacing-24)">
    <div>
      <?php snippet('templates/features/intro', [
        'title' => 'WebP & AVIF Support',
        'intro' => 'Serve smaller and better images',
        'text'  => 'Our image processing API finally supports WebP and AVIF as better alternatives for your JPEGs or PNGs. <a href="/releases/3.6/features#core__image-formats">Learn more &rsaquo;</a>',
      ]) ?>

      <figure class="bg-black rounded">
        <?= $page->webp()->kt() ?>
      </figure>

    </div>
    <div>
      <?php snippet('templates/features/intro', [
        'title' => 'Better Panel image settings',
        'intro' => 'Improve your previews with custom queries',
        'text'  => 'You can now set custom backgrounds, icons, images and more for your pages via blueprint settings. <a href="/releases/3.6/features#panel__even-more-visual">Learn more &rsaquo;</a>',
      ]) ?>

      <figure class="bg-black rounded">
        <?= $page->imageSettings()->kt() ?>
      </figure>

    </div>
  </div>
</section>

<?php snippet('templates/release-36/icons') ?>


<?php snippet('templates/release-36/changes/panel') ?>
<?php snippet('templates/release-36/changes/templating') ?>
<?php snippet('templates/release-36/changes/plugins') ?>
<?php snippet('templates/release-36/changes/security') ?>
<?php snippet('templates/release-36/changes/core') ?>


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
        'text'  => '3.6 notes',
        'link'  => $page->children()->first()->url(),
        'icon'  => 'book',
        'style' => 'outlined'
      ]
    ]
  ]) ?>
</section>
