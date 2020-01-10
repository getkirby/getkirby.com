<div class="features-image <?= $class ?? null ?>" style="--rows: <?= $rows ?? 2 ?>; --cols: <?= $cols ?? 2 ?>">
  <figure>
    <?php if ($link ?? false): ?>
    <a href="<?= url($link) ?>"><?= $image->html(['alt' => $alt ?? null]) ?></a>
    <?php else: ?>
    <?= $image->html(['alt' => $alt ?? null]) ?>
    <?php endif ?>
  </figure>
</div>
