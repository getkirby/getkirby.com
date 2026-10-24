<header class="header mb-24">
  <?php snippet('layouts/skipper') ?>
  <div class="container">
    <div class="header-content relative flex items-center">
      <?php snippet('layouts/logo') ?>
      <?php snippet('layouts/menu') ?>

      <?php if ($page->id() !== 'buy') : ?>
        <?php snippet('layouts/banner', ['banner' => banner()]) ?>
      <?php endif ?>
    </div>
  </div>
</header>
