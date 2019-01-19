<?php if ($type !== null): ?>
<h2 id="returns"><a href="#returns">Return Type</a></h2>
<code>
  <?php if ($reference = page('docs/reference')->children()->filterBy('template', 'class')->filterBy('class', $type)->first()) : ?>
    <?= Html::a($reference->url(), $type) ?>
  <?php else : ?>
    <?= $type ?>
  <?php endif ?>
</code>
<?php endif ?>
