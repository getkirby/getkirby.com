<?php if (empty($banner) === false && $banner->text()): ?>
<aside class="banner text-sm">
  <a href="<?= url('buy') ?>"><?= $banner->text() ?></a>
</aside>
<?php endif ?>
