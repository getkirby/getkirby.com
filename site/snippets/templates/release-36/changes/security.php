<?php if ($section = $page->find('changes/security')) : ?>
	<section id="changes-security" class="mb-42">

		<?php snippet('templates/features/intro', [
			'title' => $section->title(),
		]) ?>

		<div class="columns" style="--columns: 2; --gap: var(--spacing-1)">
			<div class="highlight bg-light">
				<h3 class="h3 mb-6">Features</h3>
				<div class="prose color-gray-800 text-sm">
					<?= $section->features()->kt() ?>
				</div>
			</div>

			<div class="highlight bg-light">
				<h3 class="h3 mb-6">Breaking changes</h3>
				<div class="prose color-gray-800 text-sm">
					<?= $section->breaking()->kt() ?>
				</div>
			</div>
		</div>

	</section>
<?php endif ?>
