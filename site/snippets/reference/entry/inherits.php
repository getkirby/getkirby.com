<?php
extract([
  'inherited' => $page->inheritedFrom() ?? null
]);
?>
<?php if ($inherited): ?>
<h2 id="inherits"><a href="#inherits">Inherited from</a></h2>
<?= formatType(is_a($inherited, Page::class) ? $inherited->class() : $inherited) ?>
<?php endif ?>
