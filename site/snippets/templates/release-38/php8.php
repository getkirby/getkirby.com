<style>
	.v38-php8-grid {
		display: grid;
		grid-gap: var(--spacing-6);
		grid-template-areas:
			"icon"
			"text"
	}

	.v38-php8-grid figure > div {
		width: clamp(10rem, 75%, 15rem);
	}

	@media screen and (min-width: 45rem) {
		.v38-php8-grid {
			grid-template-columns: 1fr 1fr;
			grid-template-areas:
				"icon text"
		}
	}

	@media screen and (min-width: 80rem) {
		.v38-php8-grid {
			grid-template-columns: 2fr 1fr;
		}
	}
</style>

<section id="php8" class="mb-42">

	<?php snippet('hgroup', [
		'title'    => '<del style="color: var(--color-red-600)">PHP 7.4+</del>&nbsp;&nbsp;PHP 8+',
		'subtitle' => 'Use the potential of a modern PHP environment',
		'mb'       => 12
	]) ?>

	<div class="v38-php8-grid">
		<figure class="release-box bg-dark p-24 color-white grid place-items-center" style="grid-area: icon">
			<div>
				<?= image('home/php.svg')->read() ?>
			</div>
		</figure>

		<div class="release-text-box" style="grid-area: text">
			<h3>There’s no time to dwell in the past</h3>
			<div class="prose">
				<p>Kirby has already supported PHP 8.0 and 8.1 right after their release. PHP&nbsp;8 not only brings an incredible performance boost but also language features that really move Kirby forward.</p>
				<p>Kirby 3.8 builds exclusively on PHP 8+. With the end-of-life of PHP 7.4 in November and wide-spread hosting support for PHP 8, we don't see any reason to stay with an outdated version if the future is so bright.</p>
			</div>
		</div>
	</div>

</section>
