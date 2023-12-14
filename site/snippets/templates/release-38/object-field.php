<style>
	.v38-object-field-intro,
	.v38-object-field-examples {
		display: grid;
		grid-gap: var(--spacing-6);
	}

	@media screen and (min-width: 45rem) {
		.v38-object-field-intro,
		.v38-object-field-examples {
			grid-template-columns: 1fr 1fr;
		}
	}

	@media screen and (min-width: 60rem) {
		.v38-object-field-intro {
			grid-template-columns: 1fr 2fr;
		}
	}
</style>

<section id="object-field" class="mb-42">

	<?php snippet('hgroup', [
		'title'    => 'New object field',
		'subtitle' => 'More power for your data',
		'mb'       => 12
	]) ?>

	<figure class="release-box bg-light mb-6" style="--aspect-ratio: 2751/1402">
		<img src="<?= $page->image('object-field-1.png')?->url() ?>" loading="lazy" alt="The new object field opens in a new drawer to edit fields comfortably">
	</figure>

	<div class="v38-object-field-intro mb-6">
		<div class="release-text-box" style="background: var(--color-white); --span: 2">
			<h3>Objectively awesome</h3>
			<div class="prose">
				<?= $page->objectFieldInfo()->kt() ?>
			</div>
		</div>

		<figure class="release-box bg-light grid place-items-center">
			<img src="<?= $page->image('object-field-2.png')?->url() ?>" loading="lazy" alt="The new object field shows data in a very compact way" style="--aspect-ratio: 1794/497">
		</figure>
	</div>

	<div class="v38-object-field-examples">

		<div class="release-text-box">
			<h3>In your blueprints</h3>
			<div class="prose">
				<p>The object field definition is very similar to a structure field. You can define any set of fields for the object with the <code>fields</code> option.</p>
			</div>
		</div>

		<div class="release-code-box">
			<?= $page->objectFieldConfig()->kt() ?>
		</div>

		<div class="release-text-box">
			<h3>In your templates</h3>
			<div class="prose">
				<p>The result is stored as YAML in the content file and can be used in your templates with the new <a class="type-link" href="/docs/reference/templates/field-methods/to-object"><code class="type type-method">$field->toObject()</code></a> method.</p>
			</div>
		</div>

		<div class="release-code-box">
			<?= $page->objectFieldTemplate()->kt() ?>
		</div>

	</div>
</section>
