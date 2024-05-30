<?php layout() ?>

<style>
.image img {
	width: auto !important;
}

.avatar {
	background: var(--color-light);
	display: flex;
	padding: .5rem;
	max-width: 42rem;
}

.avatar figcaption {
	font-size: var(--text-md) !important;
}

.avatar img {
	width: 9rem !important;
	height: 9rem !important;
	object-fit: cover;
	margin-right: 1rem;
}

.screenshot img {
	box-shadow: none !important;
}
</style>

<article>
	<header class="h1 mb-24 text-center">
		<h1 class="mb-12">10 years and counting …<h1>
		<div class="w-full px-12">
			<img class="mx-auto bg-black rounded shadow-xl" style="width: auto; --aspect-ratio: 2400/588" src="<?= image('versions.png')->url() ?>" alt="Screenshots of the Panel of Kirby 1, 2 and 3 compared to each other">
		</div>
	</header>

	<?php foreach ($page->children() as $year) : ?>
		<section id="<?= $year->slug() ?>" class="py-12 columns mb-12" style="--columns: 12">
			<div style="--span: 2">
				<datetime class="sticky link font-mono text-sm" style="--top: var(--spacing-12)">
					<a href="#<?= $year->slug() ?>"><?= $year->title() ?></a>
				</datetime>
			</div>
			<div style="--span: 10">
				<div class="prose text-lg">
					<?= $year->text()->kt() ?>
				</div>
			</div>
		</section>
	<?php endforeach ?>

</article>
