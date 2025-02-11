<?php layout('reference') ?>

<?php foreach ($page->children()->unlisted()  as $namespace): ?>
<div class="mb-24">
	<h2 class="h2 mb-3" id="<?= $namespace->slug() ?>"><?= $namespace->title() ?></h2>
	<?php snippet('templates/reference/section', $namespace->children()->listed()) ?>
</div>
<?php endforeach ?>
