<?php
$items        = $page->text()->toToc($tag ?? 'h2');
$hasResources = $page->resources()->isNotEmpty();
$limit        = $hasResources ? 1 : 2;
?>

<?php if($items->count() > $limit): ?>
<nav aria-labelledby="toc-heading" class="toc">
	<h2 id="toc-heading" class="badge"><?= $title ?? 'On this page' ?></h2>
	<ol class="pt-3">
		<?php foreach($items as $item): ?>
		<li><a href="<?= $item->id() ?>"><?= widont($item->text()) ?></a></li>
		<?php endforeach ?>

		<?php if($hasResources): ?>
			<li><a href="#resources">More information</a></li>
		<?php endif ?>
	</ol>
</nav>
<?php endif ?>
