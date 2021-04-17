<header class="header mb-24" data-template="<?= $page->template() ?>">
  <?php snippet('layouts/skipper') ?>
  <div class="container">
    <div class="header-content relative flex items-center">
      <?php snippet('layouts/logo') ?>
      <?php snippet('layouts/menu') ?>
      <?php snippet('layouts/search', ['area' => $search ?? 'all']) ?>
      <?php snippet('layouts/banner') ?>
    </div>
  </div>
</header>
