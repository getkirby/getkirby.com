<div class="text">
  <aside class="warning">
    <?php icon('warning') ?>
    <strong>
      Deprecated in <?= version($deprecated[0], '<code>%s</code>') ?>
    </strong>
    <?php if (isset($deprecated[1]) === true) : ?>
    <?= parseObjectReference($deprecated[1], $page->className()) ?>
    <?php endif ?>
  </aside>
</div><br>
