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
</style>

<section class="mb-42" id="volume-discounts">
	<form class="volume-discounts" method="POST" target="_blank" action="<?= url('buy/volume') ?>">
		<header class="flex items-baseline justify-between mb-6">
			<h2 class="h2">Volume discounts</h2>
			<fieldset>
				<legend class="sr-only">License Type</legend>
				<div class="volume-toggles">
					<label><input type="radio" name="product" value="<?= $basic->value() ?>" v-model="product" checked> <?= $basic->label() ?></label>
					<label><input type="radio" name="product" value="<?= $enterprise->value() ?>" v-model="product"> <?= $enterprise->label() ?></label>
				</div>
			</fieldset>
		</header>
		<div class="columns rounded overflow-hidden" style="--columns-md: 3; --columns: 3; --gap: var(--spacing-3)">
			<?php foreach ($discounts as $volume => $discount) : ?>
				<div class="block p-12 bg-light rounded text-center" >
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

						<button class="btn btn--filled mb-3" @click="openCheckout(product, <?= $volume ?>, $event)" name="volume" value="<?= $volume ?>">
							<?= icon('cart') ?> Buy now
						</button>
					</article>
				</div>
			<?php endforeach ?>
		</div>
	</form>
</section>
