<style>
	.v38-uuid-grid {
		display: grid;
		grid-gap: var(--spacing-6);
		grid-template-areas:
			"figure"
			"text"
			"code"
	}

	@media screen and (min-width: 45rem) {
		.v38-uuid-grid {
			grid-template-columns: 1fr 1fr;
			grid-template-areas:
				"figure figure"
				"text code"
		}
	}

	@media screen and (min-width: 90rem) {
		.v38-uuid-grid {
			grid-template-columns: 1fr 2fr;
			grid-template-areas:
				"text figure"
				"code figure"
		}
	}
</style>

<section id="uuids" class="mb-42">
	<?php snippet('hgroup', [
		'title'    => 'New Unique ID system',
		'subtitle' => 'For everlasting relationships',
		'mb'       => 12
	]) ?>

	<figure class="release-box mb-6" style="--aspect-ratio: 1558/688">
		<?= img($page->image('uuids.png'), [
			'alt' => 'An illustration showing the new UUID system',
			'src' => [
				'width' => 1248
			],
			'lazy' => false,
			'sizes' => '(min-width: 1440px) 1248px, (min-width: 1150px) 86vw, 92vw',
			'srcset' => [
				200,
				400,
				800,
				1248,
				2496,
			]
		]) ?>
	</figure>

	<div class="columns mb-6" style="--columns-md: 1; --columns: 2">
		<div class="release-text-box">
			<h3>Reliability built-in</h3>
			<div class="prose">
				<?= $page->uuidsInfo()->kt() ?>
			</div>
		</div>
		<div class="release-text-box">
			<h3>Permalinks</h3>
			<div class="prose">
				<?= $page->uuidsPermalinks()->kt() ?>
			</div>
		</div>
	</div>

	<div class="v38-uuid-grid">
		<figure class="release-box" style="--aspect-ratio: 1123/682; grid-area: figure">
			<img src="<?= $page->image('pickers.png')?->url() ?>" loading="lazy" alt="A screenshot of the updated picker fields">
		</figure>

		<div class="release-text-box" style="grid-area: text">
			<h3>Updated picker fields</h3>
			<div class="prose">
				<?= $page->uuidsPickerFields()->kt() ?>
			</div>
		</div>

		<div class="release-code-box" style="grid-area: code">
			<?= $page->uuidsContentFile()->kt() ?>
		</div>
	</div>
</section>
