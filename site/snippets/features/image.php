<div class="features-image <?= $class ?? null ?>" style="--rows: <?= $rows ?? 2 ?>; --cols: <?= $cols ?? 2 ?>">
  <figure>
    <?php if ($link ?? false): ?>
    <a href="<?= url($link) ?>"><?= $image ?></a>
    <?php else: ?>
    <?= $image ?>
    <?php endif ?>
  </figure>
</div>
