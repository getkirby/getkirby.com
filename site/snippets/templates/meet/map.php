<style>
.map {
	width: 100%;
	min-height: 40rem;
	height: 85vh;
	height: 85dvh;
	border: 1px solid var(--color-border);
	overflow: clip;
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

	<iframe class="map rounded" src="https://community.getkirby.com/map"></iframe>
</section>


