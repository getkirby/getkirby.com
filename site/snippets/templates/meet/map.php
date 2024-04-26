<style>
.map {
	width: 100%;
	border: 1px solid var(--color-border);
	overflow: clip;
}
.map iframe {
	width: 100%;
	height: 100%;
}

@media screen and (max-width: 40rem) {
	.map {
		height: 60dvh;
	}
}
@media screen and (min-width: 40rem) {
	.map {
		aspect-ratio: 16/9;
	}
}
</style>

<section class="mb-24">

	<header class="flex justify-between items-center mb-6">
		<h2 class="h2">Community map</h2>

		<a
			class="btn btn--filled"
			href="https://community.getkirby.com/#add"
			target="_blank"
		>
			<?= icon('account') ?>
			Add me
		</a>
	</header>

	<div class="map rounded mb-1">
		<iframe src="https://community.getkirby.com/map"></iframe>
	</div>
	<p><a class="text-sm underline flex items-center" style="gap: var(--spacing-2)" href="https://community.getkirby.com" target="_blank"><?= icon('window') ?> community.getkirby.com</a></p>
</section>


