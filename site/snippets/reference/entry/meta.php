<?php

extract([
  'since' => $page->since(),
  'alias' => $page->alias(),
  'auth'  => $page->auth(),
  'guide' => $page->guide()
]);

extract([
  'hasSince' => $since->isNotEmpty(),
  'hasClassname' => is_a($page, ReferenceClassPage::class) === true ||
                   (
                     is_a($page, ReferenceClassmethodPage::class) === true &&
                     $page->name() === '__construct'
                    ),
  'hasAlias' => $alias->isNotEmpty(),
  'hasAuth'  => $auth->isNotEmpty(),
  'hasGuide' => $guide->isNotEmpty()
]);
?>
<?php if ($hasSince || $hasClassname || $hasAlias || $hasAuth || $hasGuide): ?>
<ul class="cheatsheet-article-meta">
  <?php if ($hasSince): ?>
  <li>
    Since <code><?= version($since) ?></code>
  </li>
  <?php endif ?>

  <?php if ($hasClassname): ?>
  <li>
    Full class name: <code><?= $page->class() ?></code>
  </li>
  <?php endif ?>

  <?php if ($hasAlias): ?>
  <li>
    Alias: <code><?= ucfirst($page->alias()) ?></code>
  </li>
  <?php endif ?>

  <?php if ($hasAuth): ?>
  <li>
    <?= icon('lock') ?>
    <a href='<?= url('docs/guide/users/permissions') ?>'>
     <code><?= $auth ?></code>
    </a>
  </li>
  <?php endif ?>

  <?php if ($hasGuide): ?>
  <li>
    <?= icon('guide') ?>
    <a href="<?= url('docs/guide/' . $guide) ?>" class="follow">
      Read the guide
    </a>
  </li>
  <?php endif ?>
</ul>
<?php endif ?>

<div class="text">
<!-- Info box -->
<?php if ($page->info()->isNotEmpty()): ?>
<p>
  <?= kirbytext('<info>' . $page->info() .'</info>') ?>
</p>
<?php endif ?>

<!-- Deprecated box -->
<?php if ($page->deprecated()->isNotEmpty()): ?>
<?php $status = $page->deprecated()->split('|') ?>
<p>
  <?= kirbytext('<warning><b>Deprecated in <code>' . version($status[0]) . '</code></b><br>' . parseForReferences($status[1], $page->class()) .'</warning>') ?>
</p>
<?php endif ?>
</div>
