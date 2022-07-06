<?php if ($section = $page->find('changes/core')) : ?>
  <section id="changes-core" class="mb-42">

	<?php snippet('templates/features/intro', [
	  'title' => $section->title(),
	]) ?>

	<div class="columns" style="--columns: 2; --gap: var(--spacing-1)">
	  <div class="highlight bg-light">
		<h3 class="h3 mb-6">Features</h3>
		<div class="prose text-sm">
		  <?= $section->features()->kt() ?>
		</div>
	  </div>

	  <div class="highlight bg-light">
		<h3 class="h3 mb-6">Enhancements</h3>
		<div class="prose text-sm">
		  <?= $section->enhancements()->kt() ?>
		</div>
	  </div>

	  <div class="highlight bg-light">
		<h3 class="h3 mb-6">Bug fixes</h3>
		<div class="prose text-sm">
		  <?= $section->fixes()->kt() ?>
		</div>
	  </div>

	  <div class="highlight bg-light">
		<h3 class="h3 mb-6">Breaking changes</h3>
		<div class="prose text-sm">
		  <?= $section->breaking()->kt() ?>
		</div>
	  </div>

	  <div class="highlight bg-light">
		<h3 class="h3 mb-6">Refactoring</h3>
		<div class="prose text-sm">
		  <?= $section->refactoring()->kt() ?>
		</div>
	  </div>

	  <div class="highlight bg-light">
		<h3 class="h3 mb-6">Deprecated</h3>
		<div class="prose text-sm">
		  <?= $section->deprecated()->kt() ?>
		</div>
	  </div>
	</div>

  </section>
<?php endif ?>
