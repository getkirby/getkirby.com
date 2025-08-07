<section class="mb-24">
	<h2 class="h2 mb-12" id="<?= $group->slug() ?>"><?= $group->title() ?></h2>
	<?php snippet('templates/reference/sections', ['sections' => $group->children()->listed()]) ?>
</section>
