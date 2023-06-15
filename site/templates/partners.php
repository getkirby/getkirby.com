<?php layout() ?>

<style>
	.partners-header {
		display: flex;
		flex-direction: column;
		gap: var(--spacing-8);
	}
	.partners-header nav {
		--min: 9rem;
		--gap: var(--spacing-3);
		max-width: 26rem;
	}

	.partners, .partners-plus {
		--columns: 2;
	}

	@media screen and (max-width: 35rem) {
		.partners-header nav {
			grid-template-columns: 1fr;
		}
		.partners {
			--columns: 1;
		}
	}

	@media screen and (min-width: 60rem) {
		.partners-plus {
			--columns: 3;
		}
		.partners {
			--columns: 3;
		}
	}

	@media screen and (min-width: 70rem) {
		.partners-header {
			align-items: flex-end;
			flex-direction: row;
			justify-content: space-between;
		}
	}
</style>

<article>

	<header class="mb-36 partners-header">
		<div class="max-w-xl">
			<h1 class="h1 mb-6">Find a Kirby partner to trust with your next
				project</h1>
			<p class="text-xl leading-snug color-gray-700">
				Our curated partners know Kirby inside out and have a wide range of
				experience in web development. Find trusted developers from all over the
				world and rest assured that there is always someone you can turn to.
			</p>
		</div>
		<nav class="auto-fit items-center">
			<a class="btn btn--filled" href="https://airtable.com/shrfCqUxq5L3GyhIb">
				<?= icon('mail') ?>
				Post your project
			</a>
			<a class="btn btn--outlined" href="/partners/join">
				<?= icon('verified') ?>
				Become a partner
			</a>
		</nav>
	</header>
	<section class="partners-plus columns mb-42" style="--gap: var(--spacing-24)">
		<?php foreach ($plus as $partner) : ?>
			<?php snippet('templates/partners/partner.plus', ['partner' => $partner]) ?>
		<?php endforeach ?>
	</section>

	<section class="partners columns"
					 style="--column-gap: var(--spacing-24); --row-gap: var(--spacing-12)">
		<?php foreach ($standard as $partner) : ?>
			<?php snippet('templates/partners/partner', ['partner' => $partner]) ?>
		<?php endforeach ?>
	</section>

</article>
