<div class="features-text<?= e($fade ?? false, ' fading') ?><?= e($center ?? false, ' center') ?>" style="--rows: <?= $rows ?? 2 ?>; --cols: <?= $cols ?? 2 ?>">
  <header>
    <h3 class="h6"><?= $heading ?? 'Feature' ?></h2>
    <p><?= $text ?? 'Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Maecenas faucibus mollis interdum. Maecenas sed diam eget risus varius blandit sit amet non magna. Maecenas faucibus mollis interdum.' ?></p>
  </header>

  <?php if ($image ?? false): ?>
  <figure>
    <?= $image ?>
  </figure>
  <?php endif ?>
</div>
