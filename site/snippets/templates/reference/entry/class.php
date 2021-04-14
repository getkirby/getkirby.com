<?php
extract([
  'parent'    => $page->class() ?? null,
  'inherited' => $page->inheritedFrom() ?? null
]);
?>
<?php if ($parent): ?>
<h2 id="class"><a href="#class">Parent class</a></h2>
<p>
  <?= Type::format($parent) ?>
  <?php if ($inherited): ?>
  inherited from <?= Type::format(is_a($inherited, Page::class) ? $inherited->class() : $inherited) ?>
  <?php endif ?>
</p>
<?php endif ?>

