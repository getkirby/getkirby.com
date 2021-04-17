<aside class="banner bg-white shadow-2xl rounded text-sm">
<?php if ($banner = banner()): ?>
  <?php if ($url = $banner->url()): ?>
  <a href="<?= $url ?>"><?= $banner->text() ?></a>
  <?php else: ?>
  <span><?= $banner->text() ?></span>
  <?php endif ?>
</aside>
<?php endif ?>
