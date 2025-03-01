<?php

use Kirby\Reference\Reflectable\ReflectableFunction;

$reflection = $page->reflection();
$returns    = $reflection->returns();
?>

<?php if (
	$reflection instanceof ReflectableFunction &&
	$returns?->isVoid() === false
): ?>
	<h2 id="returns"><a href="#returns">Return type</a></h2>
	<p><?= $returns->toHtml() ?></p>

	<?php if ($reflection->isStatic() === false): ?>
		<?php if ($returns->isImmutable()): ?>
		<p>This method does not modify the existing <code>$<?= strtolower($page->class(true)) ?></code> object but returns a new object with the changes applied. <a href="/docs/guide/templates/php-api#immutable-objects">Learn more &rarr;</a></p>

		<?php elseif ($returns->isMutable()): ?>
		<p>This method modifies the existing <code>$<?= strtolower($page->class(true)) ?></code> object it is applied to and returns it again.</p>
		<?php endif ?>
	<?php endif ?>
<?php endif ?>
