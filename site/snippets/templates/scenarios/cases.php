<section id="cases" class="mb-42">
	<h2 class="h2 mb-12"><?= $title ?></h2>
	<?php snippet('templates/cases/cases', [
		'cases'   => $cases->shuffle()->limit($limit ?? 12),
		'columns' => 4
	]) ?>
</section>
<style>
#cases article {
	color: var(--color-black);
}
#cases h2 + p {
	color: var(--color-gray-600);
}
</style>
