<?php
extract([
  'inherited' => $page->inheritedFrom() ?? null
]);
?>
<?php if ($inherited && is_a($inherited, Page::class)): ?>
<h2 id="inherits"><a href="#inherits">Inherited from</a></h2>
<?= formatType($inherited->class()) ?>
<?php endif ?>
