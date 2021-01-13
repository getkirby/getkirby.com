<?php
use Kirby\Site\Models\ClassPage;
use Kirby\Site\Models\MethodPage;
?>

<ul class="cheatsheet-article-meta">

  <?php if ($page->since()->isNotEmpty()): ?>
  <li>
    Since <code><?= version($page->since(), '%s') ?></code>
  </li>
  <?php endif ?>

  <?php if (is_a($page, ClassPage::class) === true): ?>
  <li>
    Full class name: <code><?= $page->className() ?></code>
  </li>
  <?php endif ?>
  <?php if (
    is_a($page, MethodPage::class) === true &&
    $page->methodName() === '__construct'
  ): ?>
  <li>
    Full class name: <code><?= $page->parent()->className() ?></code>
  </li>
  <?php endif ?>
  <?php if ($page->alias()->isNotEmpty()): ?>
  <li>
    Alias: <code><?= ucfirst($page->alias()) ?></code>
  </li>
  <?php endif ?>

  <?php if ($page->auth()->isNotEmpty()): ?>
  <li>
    <a href="<?= url('docs/guide/users/permissions') ?>">
      <?php icon('lock') ?> <code>
        <?= $page->auth() ?>
      </code>
    </a>
  </li>
  <?php endif ?>

  <?php if ($page->guide()->isNotEmpty()): ?>
  <li>
    <a href="<?= url('docs/guide/' . $page->guide()) ?>">
      <?php icon('guide') ?> Read the guide
    </a>
  </li>
  <?php endif ?>

</ul>
