<section id="<?= $id ?>" class="mb-24">
  <?php snippet('templates/plugins/headline', [
    'icon' => $icon,
    'text' => $title
  ]) ?>
  <?php snippet('templates/plugins/' . $layout, [
    'plugins' => pages($plugins),
    'columns' => $columns ?? null,
  ]) ?>
</section>
