<div class="text">
  <aside class="warning">
    <?php icon('warning') ?>
    <strong>
      Deprecated
      <?php if (count($deprecated) > 1) : ?>
      in <code><?= version($deprecated[0], '%s') ?></code>
      <?php endif ?>
    </strong>
    <?php if (count($deprecated) === 1) : ?>
    <?= parseObjectReference($deprecated[0], $page->className()) ?>
    <?php elseif (isset($deprecated[1]) === true) : ?>
    <?= parseObjectReference($deprecated[1], $page->className()) ?>
    <?php endif ?>
  </aside>
</div><br>
