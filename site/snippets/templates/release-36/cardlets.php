<section id="cardlets" class="mb-42">
	<?php snippet('templates/features/intro', [
		'title' => 'Cardlets',
		'intro' => 'A new way to present your content',
		'text'  => 'While lists are great for dense information and cards are fantastic to highlight visual content, there’s often a gray zone in between. The new cardlets layout option gives you nice visual previews while your text content is still represented decently. Use them in pages and files sections as well as pages, files and users fields.'
	]) ?>

	<div class="columns mb-6" style="--columns: 3; --gap: var(--spacing-1)">
		<?php foreach (['cards', 'cardlets', 'list'] as $layout): ?>
		<figure class="bg-light p-6 flex flex-column">
			<div class="prose mb-3">
			<figcaption class="text-base">
				<code>layout: <?= $layout ?></code>
			</figcaption>
			</div>
			<div class="flex-grow">
				<?= img($layout . '.png', [
					'alt' => 'A screenshot of the ' . $layout . ' layout',
					'lightbox' => true,
					'src' => [
						'width' => 1000,
					],
					'srcset' => [
						1000,
						2000,
					]
				]) ?>
			</div>
			<div class="p-1 pt-6">
				<?= $page->{$layout}()->kt() ?>
			</div>
		</figure>
		<?php endforeach ?>
	</div>

</section>
