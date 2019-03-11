<ul class="cheatsheet-article-meta">
  <?php if ($page->since()->isNotEmpty()): ?>
  <li>
    <?= version($page->since(), 'Since <code>%s</code>') ?>
  </li>
  <?php endif ?>
  <?php if ($page->auth()->isNotEmpty()): ?>
  <li>
    <?php icon('lock') ?> <code data-tooltip="<strong>Authentication</strong><br>The permission <code><?= $page->auth() ?></code> is required to run this method. <strong><a href='<?= url('docs/guide/templates/php-api#permissions') ?>'>Learn more ›</a></strong>">
      <?= $page->auth() ?>
    </code>
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
