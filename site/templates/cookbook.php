<?php layout('cookbook') ?>

<?php slot('h1') ?>
	Recipes
	<?php if ($tag): ?>
		<span class="color-gray-400">#<?= $tag ?></span>
	<?php endif ?>
<?php endslot() ?>

<?php slot() ?>
<?php snippet('templates/cookbook/recipes', ['recipes' => $recipes]) ?>
<?php endslot() ?>
