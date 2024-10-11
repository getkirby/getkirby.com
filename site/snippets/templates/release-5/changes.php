<section id="changes" class="mb-42">

	<?php snippet('hgroup', [
		'title' => 'Changelog',
		'subtitle' => 'Ch-ch-ch-changes',
		'mb'    => 12
	]) ?>

	<div class="columns mb-6" style="--columns: 2; --gap: var(--spacing-6); grid-template-rows: masonry">
		<?php foreach(['improvements-core', 'improvements-panel', 'bug-fixes', 'refactoring', 'deprecated', 'breaking-changes'] as $section): ?>
			<?php if ($section = $page->find($section)): ?>
			<div class="release-padded-box bg-light">
				<h3 id="<?= $section->slug() ?>" class="h3 mb-6"><?= $section->title() ?></h3>
				<div class="prose text-sm">
					<?= $section->text()->kt() ?>
				</div>
			</div>
			<?php endif ?>
		<?php endforeach ?>
	</div>

</section>
