<section id="changes" class="mb-42">

	<?php snippet('hgroup', [
		'title' => 'Changelog',
		'subtitle' => 'Ch-ch-ch-changes',
		'mb'    => 12
	]) ?>

	<div class="columns mb-6" style="--columns: 2; --gap: var(--spacing-6); grid-template-rows: masonry">
		<div class="release-padded-box bg-light">
			<h3 class="h3 mb-6">Core improvements</h3>
			<div class="prose text-sm mb-12">
				<?= $page->find('core-improvements')->text()->kt() ?>
			</div>
		</div>

		<div class="release-padded-box bg-light">
			<h3 class="h3 mb-6">Panel improvements</h3>
			<div class="prose text-sm">
				<?= $page->find('panel-improvements')->text()->kt() ?>
			</div>
		</div>

		<div class="release-padded-box bg-light">
			<h3 class="h3 mb-6">Bug fixes</h3>
			<div class="prose text-sm mb-12">
				<?= $page->find('bug-fixes')->text()->kt() ?>
			</div>

		</div>
		<div class="release-padded-box bg-light">
			<h3 class="h3 mb-6">Refactoring</h3>
			<div class="prose text-sm">
				<?= $page->find('refactoring')->text()->kt() ?>
			</div>
		</div>

		<div id="changes-deprecated" class="release-padded-box bg-light">
			<h3 class="h3 mb-6">Deprecated</h3>
			<div class="prose text-sm">
				<?= $page->find('deprecated')->text()->kt() ?>
			</div>
		</div>

		<div class="release-padded-box bg-light">
			<a id="breaking-changes"></a>
			<h3 class="h3 mb-6">Breaking changes</h3>
			<div class="prose text-sm">
				<?= $page->find('breaking-changes')->text()->kt() ?>
			</div>
		</div>

	</div>

	<p><small>QR Code® is a registered trademark of DENSO WAVE INCORPORATED.</small></p>

</section>
