<?php if (empty($banner) === false && empty($banner['text']) === false): ?>
<aside class="banner bg-white shadow-2xl rounded text-sm">
  <?php if (isset($banner['url'])): ?>
  <a href="<?= $banner['url'] ?>"><?= $banner['text'] ?></a>
  <?php else: ?>
  <span><?= $banner['text'] ?></span>
  <?php endif ?>
</aside>
<?php endif ?>
