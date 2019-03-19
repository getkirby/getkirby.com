<header class="hero | -theme:<?= $theme ?? 'white' ?> -align:<?= $align ?? 'left' ?>">

  <h1><?= $page->title() ?></h1>

  <?php if ($page->intro()->isNotEmpty()): ?>
  <div class="intro | -theme:<?= $theme ?? 'white' ?>">
    <?= $page->intro()->kt()->widont() ?>
  </div>
  <?php endif ?>

</header>
