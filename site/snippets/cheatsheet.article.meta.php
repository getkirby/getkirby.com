<ul class="cheatsheet-article-meta">
  <?php if ($page->since()->isNotEmpty()): ?>
  <li>
    Since <code><?= version($page->since(), '%s') ?></code>
  </li>
  <?php endif ?>
  <?php if ($page->auth()->isNotEmpty()): ?>
  <li>
    <?php icon('lock') ?> <code data-tooltip="<a href='<?= url('docs/guide/users/permissions') ?>'><strong>Permission <code><?= $page->auth() ?></code></strong><br>is required. Learn more ›</a>">
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
