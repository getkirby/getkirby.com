<div class="cheatsheet-section-toolbar">
  <span>
  <?= Html::a($page->url(),  'basic', ['aria-current' => get('advanced') ? false : true]) ?>
  <?= Html::a($page->url(['query' => 'advanced=true']),  'advanced', ['aria-current' => get('advanced') ? true : false]) ?>
  </span>
</div>
