<style>
.v4-intro-columns {
	--columns: 1;
}

@media screen and (min-width: 60rem) {
	.v4-intro-columns {
		--columns: 3;
	}
	.v4-intro-header {
		--span: 3;
	}
}
</style>

<section id="intro" class="mb-42">
	<h2 class="sr-only">The gist of it</h2>
	<div class="v4-intro-columns columns">
		<figure class="v4-intro-header release-box p-12 bg-black">
			<?php snippet('templates/release-40/image', [
				'alt'   => 'Kirby 4 Chameleon',
				'img'   => $page->image('chameleon.png'),
			]) ?>
		</figure>

		<div class="p-6 bg-white shadow-xl rounded">
			<h2 class="font-bold mb-3">Kirby 4 will launch in 2023</h2>
			<p>We are very excited to announce the <mark>first test version</mark> for Kirby&nbsp;4 with many great user-facing features and improvements. We want share our progress with you out in the open in the coming weeks. Final release of <mark>v4 is scheduled for later this year.</mark> 🚀</p>
		</div>
		<div class="p-6 bg-white shadow-xl rounded">
			<h2 class="font-bold mb-3">All licenses purchased in 2023 qualify as Kirby&nbsp;4 licenses</h2>
			<p><mark>We&nbsp;will treat any license bought on or after 1 Jan 2023 as if you bought it on the day of the v4 release.</mark> Older licenses that have not been activated yet will qualify as well. For older active licenses we will offer very fair upgrade prices as always. </p>
		</div>
		<div class="p-6 bg-white shadow-xl rounded">
			<h2 class="font-bold mb-3">Upgrades</h2>
			<p>Kirby 4 will be built upon the healthy code base we established for Kirby 3. <mark>Upgrades will be comparable to a 3.x release.</mark> While we stay on the same architecture, this new version will bring many long-awaited features and is going to move your projects forward.</p>
		</div>
	</div>
</section>
