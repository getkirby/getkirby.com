<?php
extract([
  'type' => $type ?? $page->returnType()
]);
?>
<?php if ($type !== null && $type !== 'void'): ?>
<h2 id="returns"><a href="#returns">Return type</a></h2>
<p><?= formatType($type) ?></p>
<?php endif ?>
