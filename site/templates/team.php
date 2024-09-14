<?php layout() ?>

<style>
.team figure img {
	border-radius: var(--rounded);
	box-shadow: var(--shadow-lg);
	margin-bottom: var(--spacing-3);
}
.team figcaption {
	font-weight: 600;
}
.team figcaption span {
	font-weight: 300;
}
</style>

<article>
	<header class="mb-12 max-w-xl">
		<h1 class="h1 mb-6">Behind Kirby</h1>
		<div class="h3 color-gray-700">
			<p class="mb-3">Kirby started in <a href="/10" class="link">2012</a> as a side project by Bastian. Over the years, the team has grown from within our <a href="/meet" class="link">community</a>.</p>
			<p>Together, we move Kirby forward.</p>
		</div>
	</header>

	<ul class="team columns mb-24" style="--columns-md: 2; --columns: 5; --gap: var(--spacing-12);">
		<li>
			<figure>
				<?= image('bastian.jpg')->crop(250, 350) ?>
				<figcaption>Bastian <span>Allgeier</span></figcaption>
			</figure>
		</li>
		<li>
			<figure>
				<?= image('sonja.jpg')->crop(250, 350) ?>
				<figcaption>Sonja <span>Broda</span></figcaption>
			</figure>
		</li>
		<li>
			<figure>
				<?= image('lukas.jpg')->crop(250, 350) ?>
				<figcaption>Lukas <span>Bestle</span></figcaption>
			</figure>
		</li>
		<li>
			<figure>
				<?= image('nico.png')->crop(250, 350) ?>
				<figcaption>Nico <span>Hoffmann</span></figcaption>
			</figure>
		</li>
		<li>
			<figure>
				<?= image('ahmet.png')->crop(250, 350) ?>
				<figcaption>Ahmet <span>Bora</span></figcaption>
			</figure>
		</li>
	</ul>

	<span class="h2">Get <a href="/contact" class="link">in touch</a>.</span>

</article>
