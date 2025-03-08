<?php

use Kirby\Reference\Reflectable\ReflectableClassMethod;

$reflection = $page->reflection();
?>

<?php if ($reflection instanceof ReflectableClassMethod): ?>
<h2 id="class"><a href="#class">Parent class</a></h2>
<p>
	<?= $reflection->class(typed: true)->toHtml() ?>

	<?php if ($inherited = $reflection->inheritedFrom()): ?>
	inherited from <?= $inherited->toHtml() ?>
	<?php endif ?>
</p>
<?php endif ?>
