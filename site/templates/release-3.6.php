<?php layout() ?>
<?= css('assets/css/layouts/features.css') ?>
<?= css('assets/css/layouts/releases.css') ?>

<header class="mb-36 flex items-end justify-between release-header">
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
        'text' => 'Docs',
        'link' => '/docs',
        'icon' => 'book',
        'style' => 'outlined'
      ]
    ],
    'center' => false,
    'mb' => 0
  ]) ?>
</header>

<article class="release-wrapper">
  <div class="release-notes">
    <?php snippet('templates/release-36/blocks') ?>
    <?php snippet('templates/release-36/cardlets') ?>
    <?php snippet('templates/release-36/image-formats') ?>
    <?php snippet('templates/release-36/image-options') ?>
    <?php snippet('templates/release-36/views') ?>
    <?php snippet('templates/release-36/fiber') ?>
    <?php snippet('templates/release-36/plugins') ?>
    <?php snippet('templates/release-36/icons') ?>

    <section id="changes" class="h2 mb-42 max-w-xl">
      <h2 class="mb-12">This release is big</h2>
      <ul class="mb-12 color-gray-600">
        <li>&rarr; 7 months of work</li>
        <li>&rarr; 1288 commits</li>
        <li>&rarr; 471 closed issues and pull requests</li>
        <li>&rarr; And the update from Kirby 3.5 is free!</li>
      </ul>
      <p class="mb-12">
        Ready to read the full changelog?
        <br>
        Here we go …
      </p>
    </section>

    <?php snippet('templates/release-36/changes/panel') ?>
    <?php snippet('templates/release-36/changes/templating') ?>
    <?php snippet('templates/release-36/changes/plugins') ?>
    <?php snippet('templates/release-36/changes/security') ?>
    <?php snippet('templates/release-36/changes/core') ?>
    <?php snippet('templates/release-36/stats') ?>
  </div>
  <?php snippet('templates/release-36/release-menu') ?>
</article>

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
        'text' => 'Docs',
        'link' => '/docs',
        'icon' => 'book',
        'style' => 'outlined'
      ]
    ]
  ]) ?>
</section>

<script>
  window.addEventListener('DOMContentLoaded', () => {
    const observer = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        const id = entry.target.getAttribute('id');
        if (entry.intersectionRatio > 0) {
          document.querySelector(`nav.release-menu li a[href="#${id}"]`)?.setAttribute('aria-current', 'true');
        } else {
          document.querySelector(`nav.release-menu li a[href="#${id}"]`)?.removeAttribute('aria-current');
        }
      });
    });

    // Track all sections that have an `id` applied
    document.querySelectorAll('section[id]').forEach((section) => {
      observer.observe(section);
    });
  });
</script>
