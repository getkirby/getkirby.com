<?php layout() ?>
<?= css('assets/css/layouts/features.css') ?>
<?= css('assets/css/layouts/releases.css') ?>

<header class="mb-36 flex items-end justify-between release-header">
  <div>
    <h1 class="h1"><?= $page->title() ?></h1>
    <p class="h1 color-gray-600"><?= $page->subtitle() ?></p>
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

  <?php snippet('templates/release-37/stats') ?>
  <?php snippet('templates/release-37/table') ?>
  <?php snippet('templates/release-37/system') ?>
  <?php snippet('templates/release-37/toggles') ?>
  <?php snippet('templates/release-37/ui') ?>

  <?php snippet('templates/release-37/changes') ?>
  <?php snippet('templates/release-37/contributors') ?>
  <?php snippet('templates/release-37/release-menu') ?>
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
