<style>
.kql-playground {
	background: var(--color-black);
	border-radius: .5rem;
	overflow: hidden;
}
.kql-playground figcaption {
	display: flex;
	color: var(--color-gray-400);
	justify-content: center;
	border-bottom: 1px solid rgba(255,255,255, .15);
	padding: .5rem;
}
.kql-playground figcaption a {
	display: block;
	background: var(--color-gray-900);
	padding: .25rem 6rem;
	font-size: var(--text-xs);
	font-family: var(--font-mono);
	border-radius: var(--rounded);
}
</style>

<section id="releases" class="mb-42">

	<?php snippet('hgroup', [
		'title'    => 'Satellite Releases',
		'subtitle' => 'Ecosystem improvements',
		'mb'       => 24
	]) ?>

	<article id="cli" class="mb-24">
		<h3 class="h6 mb-6">Kirby CLI 1.1.0</h3>

		<div class="columns" style="--columns: 3">
			<div class="release-text-box">
				<div class="prose">
					The Kirby Command Line Interface is <a class="link" href="<?= option('github.url') ?>/cli/releases/tag/1.1.0">getting a big update</a>. Kirby plugins can now define their own commands for the CLI, you can register your installation without going to the Panel and more …
				</div>
			</div>
			<div style="--span: 2">
				<div class="release-code-box mb-6">
					<?= $page->cli()->kt() ?>
				</div>
				<div class="release-code-box">
					<?= $page->cliCommand()->kt() ?>
				</div>
			</div>
		</div>
	</article>

	<article id="kql" class="mb-24">
		<h3 class="h6 mb-6">Kirby KQL 2.0.0</h3>

		<figure class="kql-playground mb-6">
			<figcaption>
				<a href="https://kql.getkirby.com">https://kql.getkirby.com</a>
			</figcaption>
			<a href="https://kql.getkirby.com"><img alt="Screenshot of the KQL playground" src="<?= image('kql.png')->url() ?>"></a>
		</figure>

		<div class="columns" style="--columns: 3">
			<div class="release-text-box">
				<div class="prose">
					Kirby's Query Language API combines the flexibility of Kirby's data structures, the power of GraphQL and the simplicity of REST.
				</div>
			</div>
			<div class="release-text-box">
				<div class="prose">
					<a class="link" href="<?= option('github.url') ?>/kql/releases/tag/2.0.0">KQL 2.0.0</a> comes with all the new query syntax improvements from Kirby 3.8.3 and a fully refactored code base.
				</div>
			</div>
			<div class="release-text-box">
				<div class="prose">
					The new KQL Playground gets you started with a set of example queries. Connected to our Starterkit, you can play around with your own queries.
				</div>
			</div>
		</div>
	</article>

	<article id="staticache" class="mb-24">
		<h3 class="h6 mb-6">Staticache 1.0.0</h3>

		<div class="columns" style="--columns: 2">
			<div class="release-text-box">
				<div class="prose">
					<p>Staticache is our alternative page cache plugin for Kirby that stores responses as fully static files. This helps you to increase your site performance even more.</p>
					<p>With <a class="link" href="<?= option('github.url') ?>/staticache/releases/tag/1.0.0">version 1.0.0</a> it is finally ready for prime time for a lot of common site setups. It now comes with support for multi-language sites and content representations as well as with a new mode that caches custom HTTP response headers as well.</p>
				</div>
			</div>
			<div>
				<div class="release-code-box">
					<?= $page->staticacheConfig()->kt() ?>
				</div>
			</div>
		</div>
	</article>

	<article id="kql">
		<h3 class="h6 mb-6">Eleventykit 🎈</h3>

		<div class="columns" style="--columns: 3">
			<div class="release-text-box">
				<div class="prose">
					<?= $page->eleventy()->kt() ?>
				</div>
			</div>
			<div class="release-code-box" style="--span: 2">
				<?= $page->eleventyExample()->kt() ?>
			</div>
		</div>
	</article>

</section>
