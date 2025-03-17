<style>
.v38-cli-grid {
	display: grid;
	grid-gap: var(--spacing-6);
}

@media screen and (min-width: 60rem) {
	.v38-cli-grid {
		grid-template-columns: 2fr 1fr;
	}
}

@media screen and (min-width: 80rem) {
	.v38-cli-grid {
		grid-template-columns: 1fr 1fr;
	}
}
</style>

<section id="cli" class="mb-42">

	<?php snippet('hgroup', [
		'title'    => 'Kirby CLI',
		'subtitle' => 'Supercharge your workflow',
		'mb'       => 12
	]) ?>

	<div class="v38-cli-grid">
		<figure class="release-box bg-black p-12 grid place-items-center">
			<img src="<?= image('cli.png')?->url() ?>" loading="lazy" alt="A screenshot of Kirby’s new command line interface installing the starterkit" style="--aspect: 1242/379">
		</figure>

		<div class="release-text-box">
			<h3>Coming to a terminal near you</h3>
			<div class="prose">
				<p>The revival of our command line interface is here and it’s better than ever before.
					Install Kirby and its kits in seconds, make blueprints, templates, controllers and more or extend the CLI with your own commands. Managing your Kirby installations has never been easier. </p>
				<p><a class="link" href="<?= option('github.url') ?>/cli">Give it a try &rarr;</a></p>
			</div>
		</div>
	</div>

</section>
