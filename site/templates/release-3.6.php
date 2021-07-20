<?php layout() ?>
<?= css('assets/css/layouts/features.css') ?>

<header class="mb-12 flex items-end justify-between release-header">
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
    <p class="h1 color-gray-600">Release preview</p>
  </div>

  <?php snippet('cta', [
    'buttons' => [
      [
        'text' => 'Try now',
        'link' => 'https://github.com/getkirby/kirby/releases/tag/3.6.0-alpha.2',
        'icon' => 'download',
        'style' => 'filled'
      ],
      [
        'text' => '3.6 docs',
        'link' => $page->children()->first()->url(),
        'icon' => 'book',
        'style' => 'outlined'
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

<section id="assets" class="mb-42">
  <div class="columns" style="--columns: 2; --gap: var(--spacing-24)">
    <div>
      <?php snippet('templates/features/intro', [
        'title' => 'WebP & AVIF Support',
        'intro' => 'Serve smaller and better images',
        'text'  => 'Our image processing API finally supports WebP and AVIF as better alternatives for your JPEGs or PNGs. <a href="/releases/3.6/features/image-formats">Learn more &rsaquo;</a>',
      ]) ?>

      <figure class="bg-black rounded">
        <?= $page->webp()->kt() ?>
      </figure>

    </div>
    <div>
      <?php snippet('templates/features/intro', [
        'title' => 'Better Panel image settings',
        'intro' => 'Improve your previews with custom queries',
        'text'  => 'You can now set custom backgrounds, icons, images and more for your pages via blueprint settings. <a href="/releases/3.6/features/image-options">Learn more &rsaquo;</a>',
      ]) ?>

      <figure class="bg-black rounded">
        <?= $page->imageSettings()->kt() ?>
      </figure>

    </div>
  </div>
</section>

<section id="features" class="mb-42">
  <?php snippet('templates/features/intro', [
    'title' => 'We are not done yet',
    'intro' => 'Help us shape the rest of this release',
    'text'  => 'We are looking for your feedback, your ideas and your magic testing skills :)',
  ]) ?>

  <div class="columns" style="--columns: 2; --gap: var(--spacing-24)">
    <div>
      <h3 class="h3">Implemented</h3>
      <?php snippet('templates/release-36/features-implemented', [
        'page' => $page->find('features')
      ]) ?>
    </div>
    <div>
      <h3 class="h3">In progress / planned</h3>
      <?php snippet('templates/release-36/features-planned', [
        'page' => $page->find('features')
      ]) ?>

      <p class="prose text-base pt-6">You can still vote for or post new feature ideas on our <a href="https://feedback.getkirby.com">feedback platform</a> or <a href="https://github.com/getkirby/kirby/issues">submit an issue for the alpha</a> on Github.</p>
    </div>
  </div>
</section>

<section id="get-started" class="mb-42">
  <h2 class="h2 text-center mb-6">Get involved</h2>
  <?php snippet('cta', [
    'buttons' => [
      [
        'text' => 'Try now',
        'link' => 'https://github.com/getkirby/kirby/releases/tag/3.6.0-alpha.1',
        'icon' => 'download'
      ],
      [
        'text'  => '3.6 docs',
        'link'  => $page->children()->first()->url(),
        'icon'  => 'book',
        'style' => 'outlined'
      ]
    ]
  ]) ?>
</section>
