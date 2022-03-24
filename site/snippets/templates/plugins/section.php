<?php $plugins = pages($plugins) ?>

<section id="<?= $id ?>" class="mb-24">
  <?php snippet('templates/plugins/headline', [
    'icon' => $icon,
    'text' => $title
  ]) ?>

  <?php if (($hero ?? false) === true): ?>
    <?php snippet('templates/plugins/hero', [
      'plugins' => $plugins->limit(1)
    ]) ?>
    <?php $plugins = $plugins->offset(1) ?>
  <?php endif ?>

  <?php snippet('templates/plugins/' . $layout, [
    'plugins' => $plugins,
    'columns' => $columns ?? null,
  ]) ?>
</section>
