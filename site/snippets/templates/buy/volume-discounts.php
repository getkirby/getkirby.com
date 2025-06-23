<style>
.volume-toggles {
	display: flex;
	align-items: center;
	gap: 1.5rem;
}
.volume-toggles label {
	display: flex;
	align-items: center;
	gap: .5rem;
	cursor: pointer;
}

.volume-discounts[data-product="enterprise"] .btn svg {
	color: var(--color-green-600) !important;
}
</style>

<section
	id="volume-discounts"
	:data-product="product"
	class="volume-discounts mb-42"
>
	<form method="POST" target="_blank" action="<?= url('buy/volume') ?>">
		<header class="flex items-baseline justify-between mb-6">
			<h2 class="h2">Volume discounts</h2>
			<fieldset>
				<legend class="sr-only">License Type</legend>
				<div class="volume-toggles">
					<label><input type="radio" name="product" value="<?= $basic->value() ?>" v-model="product"> <?= $basic->label() ?></label>
					<label><input type="radio" name="product" value="<?= $enterprise->value() ?>" v-model="product" checked> <?= $enterprise->label() ?></label>
				</div>
			</fieldset>
		</header>

		<ul
			class="columns rounded overflow-hidden"
			style="--columns-md: 3; --columns: 3; --gap: var(--spacing-3)"
		>
			<?php foreach ($discounts as $volume => $discount): ?>
				<li class="block p-12 bg-light rounded text-center" >
					<article>
						<h3 class="mb text-sm">
							<?= $volume ?>+ licenses
						</h3>
						<div class="mb-6">
							<p class="h2">
								Save <?= $discount ?>%
							</p>
							<?php if ($sale->isActive()): ?>
								<p class="sale text-sm">on top!</p>
							<?php endif ?>
						</div>

						<button class="btn btn--filled mb-3" @click.prevent="openCheckout(product, <?= $volume ?>)" name="volume" value="<?= $volume ?>">
							<?= icon('cart') ?> Buy now
						</button>
					</article>
				</li>
			<?php endforeach ?>
		</ul>
	</form>
</section>
