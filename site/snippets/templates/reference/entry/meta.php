<?php
extract([
  'since'  => $page->since(),
  'alias'  => $page->alias(),
  'auth'   => $page->auth(),
  'guide'  => $page->guide(),
  'source' => $source ?? $page->onGitHub()
]);
?>

<ul class="reference-meta">

  <?php if ($since->isNotEmpty()): ?>
  <li class="since">Since <?= version($since) ?></li>
  <?php endif ?>

  <?php if (
    is_a($page, ReferenceClassPage::class) === true || 
    (
      is_a($page, ReferenceClassmethodPage::class) === true && 
      $page->name() === '__construct'
    )
  ): ?>
  <li>Full class name: <code><?= $page->class() ?></code></li>
  <?php endif ?>

  <?php if ($alias->isNotEmpty()): ?>
  <li>Alias: <code><?= ucfirst($alias) ?></code></li>
  <?php endif ?>

  <?php if ($auth->isNotEmpty()): ?>
  <li>
    <a href='<?= url('docs/guide/users/permissions') ?>'>
      <?= icon('lock') ?>
     <?= $auth ?>
    </a>
  </li>
  <?php endif ?>

  <?php if ($guide->isNotEmpty()): ?>
  <li>
    <a href="<?= url('docs/guide/' . $guide) ?>">
      <?= icon('book') ?>
      Read the guide
    </a>
  </li>
  <?php endif ?>

  <?php if ($source->isNotEmpty()): ?>
  <li>
    <a href="<?= $source ?>">
      <?= icon('code') ?>
      kirby/<?= Str::after($source, 'tree/' . Kirby::version() .'/') ?>
    </a>
  </li>
  <?php endif ?>

</ul>

<?php if ($page->deprecated()->isNotEmpty()): ?>
  <?php $deprecated = $page->deprecated()->split('|') ?>
  <div class="prose box box--alert">
    <?= icon('ban') ?>
    <div>
      <div class="font-bold">
        Deprecated in <?= version($deprecated[0], '%s') ?>
      </div>
      <?php if (count($deprecated) > 1) : ?>
      <?= kti($deprecated[1]) ?>
      <?php endif ?>
    </div>
  </div>
<?php endif ?>
