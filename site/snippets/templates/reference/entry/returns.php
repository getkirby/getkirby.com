<?php
extract([
  'returns'  => $returns ?? $page->returnType()
]);
?>

<?php if ($returns !== null && $returns !== 'void'): ?>
<h2 id="returns"><a href="#returns">Return type</a></h2>
<p><?= Types::format($returns) ?></p>

<?php if ($page->isStatic() === false): ?>
  <?php if ($page->isImmutable()): ?>
  <p>This method does not modify the existing <code>$<?= strtolower($page->class(true)) ?></code> object but returns a new object with the changes applied. <a href="/docs/guide/templates/php-api#immutable-objects">Learn more &rarr;</a></p>
  <?php elseif ($page->isMutable()): ?>
  <p>This method modifies the existing <code>$<?= strtolower($page->class(true)) ?></code> object it is applied to and returns it again.</p>
  <?php endif ?>
<?php endif ?>

<?php endif ?>
