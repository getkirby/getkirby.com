<style>
	.ingrid {
		display: grid;
		grid-template-columns: repeat(12, 1fr);
		grid-template-rows: repeat(4, min-content);
		grid-gap: clamp(var(--spacing-2px), 1.5vw, var(--spacing-6));
	}
	.ingrid img {
		background: var(--color-light);
		border-radius: var(--rounded);
		overflow: hidden;
	}
</style>

<div class="ingrid">
	<div style="grid-column: span 6; align-self: flex-end">
		<?= img('author.png', [
			'alt' => 'A screenshot of the users and tags fields',
			'lightbox' => 'interface',
			'src' => [
				'width' => 276,
			],
			'srcset' => [
				276,
				400,
				552,
				800,
			]
		]) ?>
	</div>
	<div style="grid-column: span 6; align-self: flex-end">
		<?= img('list.png', [
			'alt' => 'A screenshot with a list of pages',
			'lightbox' => 'interface',
			'src' => [
				'width' => 276,
			],
			'srcset' => [
				276,
				400,
				552,
				800,
			]
		]) ?>
	</div>
	<div style="grid-column: span 12">
		<?= img('images.png', [
			'alt' => 'A screenshot of our layout field',
			'lightbox' => 'interface',
			'src' => [
				'width' => 576,
			],
			'srcset' => [
				576,
				800,
				1152,
				1600,
				2000,
			]
		]) ?>
	</div>
	<div style="grid-column: span 9">
		<?= img('structure.png', [
			'alt' => 'A screenshot of our structure field to edit tabular data',
			'lightbox' => 'interface',
			'src' => [
				'width' => 426,
			],
			'srcset' => [
				426,
				852,
			]
		]) ?>
	</div>
	<div style="grid-column: span 7">
		<?= img('albums.png', [
			'alt' => 'A screenshot of an gallery section in the Panel.',
			'lightbox' => 'interface',
			'src' => [
				'width' => 326,
			],
			'srcset' => [
				326,
				652,
			]
		]) ?>
	</div>
</div>
