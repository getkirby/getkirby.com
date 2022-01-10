<div class="mb-6">
  <div class="container">
    <a href="/releases/3.6" class="font-bold py-3 block flex justify-between" style="border-bottom: 2px solid var(--color-black)">
      <span><span class="mr-3">🎉</span> 10 years since 1.0!</span>

      <?php if ($page->is('10')) : ?>
        <span>Celebrate with us ↓</span>
      <?php else : ?>
        <span>Celebrate with us &rarr;</span>
      <?php endif ?>
    </a>
  </div>
</div>

<header class="header mb-24">
  <?php snippet('layouts/skipper') ?>
  <div class="container">
    <div class="header-content relative flex items-center">
      <?php snippet('layouts/logo') ?>
      <?php snippet('layouts/menu') ?>
      <?php snippet('layouts/search', ['area' => $search ?? 'all']) ?>

      <?php if ($page->id() !== 'buy') : ?>
        <?php snippet('layouts/banner', ['banner' => banner()]) ?>
      <?php endif ?>
    </div>
  </div>
</header>
