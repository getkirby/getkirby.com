<div class="mb-6">
  <div class="container">
    <?php snippet('layouts/topbar', [
      'icon'   => '👩‍💻👨‍💻',
      'title'  => 'We are a new team company!',
      'button' => 'Learn more',
      'link'   => '/new-company',
      'active' => $page->is('new-company')
    ]) ?>
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
