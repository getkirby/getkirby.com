<?php layout() ?>

<style>
.topbar {
	border-bottom-color: rgba(255,255,255, .1);
}
.header,
.footer h6 {
	color: var(--color-white);
}
html {
	background: var(--color-dark);
	color: var(--color-gray-400);
}

@media screen and (min-width: 60rem) {
	.header .banner {
		color: initial;
	}
}
</style>

<article>
	<header class="mb-24">
		<h1 class="h1 mb-6 color-white">Made with&nbsp;Kirby</h1>

		<div class="text-xl leading-snug max-w-xl">
			<p>
				You built something with Kirby? Share it with <span class="color-white">#madeWithKirby</span> on social media or in our <a class="link" href="https://forum.getkirby.com/t/made-with-kirby-and-3/83">forum</a>.
				Find more inspiring sites and Panel setups on <a class="link" href="https://kirbysites.com">kirbysites.com</a> and <a class="link" href="https://builtwithkirby.com/">builtwithkirby.com</a>.
			</p>
		</div>
	</header>

	<div class="mb-36">
		<?php snippet('templates/cases/cases', [
			'cases' => collection('cases')->shuffle()
		]) ?>
	</div>

	<?php snippet('templates/home/brands') ?>
</article>
