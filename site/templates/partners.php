<?php layout() ?>

<style>
	.partners-header {
		display: flex;
		flex-direction: column;
		gap: var(--spacing-8);
	}

	.partners, .partners-plus {
		--columns: 2;
	}

	@media screen and (max-width: 35rem) {
		.partners {
			--columns: 1;
		}
	}

	@media screen and (min-width: 50rem) {
		.partners-header {
			align-items: flex-end;
			flex-direction: row;
			justify-content: space-between;
		}

		.partners-plus {
			--columns: 3;
		}
	}

	@media screen and (min-width: 60rem) {
		.partners {
			--columns: 3;
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
		<?php snippet('cta', [
			'buttons' => [
				[
					'text'  => 'Become a partner',
					'link'  => '/partners/join',
					'icon'  => 'verified',
					'style' => 'filled',
				],
			],
			'center'  => false,
			'mb'      => 0,
		]) ?>
	</header>
	<section class="partners-plus columns mb-42" style="--gap: var(--spacing-24)">
		<?php foreach ($plus as $partner) : ?>
			<?php snippet('templates/partners/partner.plus', ['partner' => $partner]) ?>
		<?php endforeach ?>
	</section>

	<section class="partners columns mb-42"
					 style="--column-gap: var(--spacing-24); --row-gap: var(--spacing-12)">
		<?php foreach ($standard as $partner) : ?>
			<?php snippet('templates/partners/partner', ['partner' => $partner]) ?>
		<?php endforeach ?>
	</section>

</article>
