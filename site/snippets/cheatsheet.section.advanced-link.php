<div class="cheatsheet-section-toolbar">
  <span>
  <?php
  $advanced = $kirby->session()->get('advanced', 'no') === 'yes'
  ?>
  <?= Html::a($page->url(['query' => 'advanced=no']),  'basic', ['aria-current' => !$advanced]) ?>
  <?= Html::a($page->url(['query' => 'advanced=yes']),  'advanced', ['aria-current' => $advanced]) ?>
  </span>
</div>
