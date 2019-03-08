<?php $entries  = $page->children()->listed() ?>
<?php $filtered = $page->children()->listed()->filter(function ($p) {
  return method_exists($p, 'isInternal') ? !$p->isInternal() && !$p->isDeprecated() : true;
}) ?>
<?php if ($entries->count() !== $filtered->count()): ?> 
<ul class="cheatsheet-article-meta">
  <li>
    <?php if (param('advanced') !== 'true'): ?>
    <?= Html::a($page->url() . '/advanced:true',  'Advanced view ›') ?>
    <?php else: ?>
    <?= Html::a($page->url(),  'Simple view ›') ?>
    <?php endif ?>
  </li>
</ul>
<?php endif ?>
