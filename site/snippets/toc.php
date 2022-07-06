<?php $items = $page->text()->toToc($tag ?? 'h2') ?>

<?php if($items->count() > 2): ?>
<nav aria-labelledby="toc-heading" class="toc mb-24">
  <h2 id="toc-heading" class="badge"><?= $title ?? 'On this page' ?></h2>
  <ol class="pt-3">
	<?php foreach($items as $item): ?>
	<li><a href="<?= $item->id() ?>"><?= widont($item->text()) ?></a></li>
	<?php endforeach ?>
  </ol>
</nav>
<?php endif ?>
