<?php if ($banner = banner()): ?>
<aside class="banner text-sm">
  <?php if ($url = $banner->url()): ?>
  <a href="<?= $url ?>"><?= $banner->text() ?></a>
  <?php else: ?>
  <span><?= $banner->text() ?></span>
  <?php endif ?>
</aside>
<?php endif ?>
