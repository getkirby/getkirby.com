<ul class="cheatsheet-article-meta">
  <?php if ($page->since()->isNotEmpty()): ?>
  <li>
    <?= version($page->since(), 'Since <code>%s</code>') ?>
  </li>
  <?php endif ?>
  <?php if ($page->auth()->isNotEmpty()): ?>
  <li>
    <a href="<?= url('docs/guide/templates/php-api#permissions') ?>"> 
      <?php icon('lock') ?> <code><?= $page->auth() ?></code>
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
