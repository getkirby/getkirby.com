<div class="cheatsheet-section-toolbar">
  <span>
  <?= Html::a($page->url(),  'basic', ['aria-current' => param('advanced') ? false : true]) ?>
  <?= Html::a($page->url() . '/advanced:true',  'advanced', ['aria-current' => param('advanced') ? true : false]) ?>
  </span>
</div>
