<div class="pt-12">
  <div class="box p-3 text-sm" style="color: black">
    <span class="font-mono text-xs">Author</span>
    <div class="h3 font-bold"><?= $name ?></div>
    <?php if ($link ?? null): ?>
      <a href="<?= $link ?>"><?= Url::short(Url::base($link)) ?></a>
    <?php endif ?>
  </div>
</div>