<?php

use Kirby\Reference\Reflectable\ReflectableFunction;

$reflection = $page->reflection();
$returns    = $reflection->returns();
?>

<?php if (
	$reflection instanceof ReflectableFunction &&
	$returns?->isVoid() === false
): ?>
	<h2 id="returns">
		<a href="#returns">
			<?= $returns->headline() ?>
		</a>
	</h2>

	<p><?= $returns->types()->toHtml() ?></p>

	<?php if ($description = $returns->description()): ?>
	<p><?= $description ?></p>
	<?php endif ?>

	<?php if ($mutationDescription = $reflection->mutationDescription()): ?>
		<?= kirbytext($mutationDescription) ?>
	<?php endif ?>
<?php endif ?>
