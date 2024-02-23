<div class="pricing p-6 bg-white shadow-xl rounded flex flex-column justify-between">
	<header>
		<h2>
			<?= $product->label() ?>

			<?php if ($sale->isActive()): ?>
			<span class="price px-1" data-regular>
				<span v-text="locale.currency">€</span>
				<span class="amount" v-text="amountDisplay(locale.prices.<?= $product->value() ?>.regular)"><?= $product->price('EUR')->regular() ?></span>
			</span>
			<?php endif ?>
		</h2>

		<a href="/buy/basic" @click="openCheckout('<?= $product->value() ?>', 1, $event)" target="_blank" class="h2 block mb-3">
			<span class="price" data-sale>
				<span class="currency-sign" v-text="locale.currency.trim()">€</span>
				<span class="amount" v-text="amountDisplay(locale.prices.<?= $product->value() ?>.sale)"><?= $product->price('EUR')->sale() ?></span>
			</span>
			per site
		</a>

		<p class="text-sm color-gray-700"><?= $description ?></p>
	</header>

	<details class="revenue">
		<summary>
			<span>Revenue limit: <strong><?= $limit ?></strong></span> <?= icon('info') ?>
		</summary>
		<div>
			<?php if ($product === Buy\Product::Basic): ?>
			<p>
				Your revenue or funding is less than <strong><?= $revenueLimitVerbose ?><span v-cloak v-if="locale.revenueLimit.length" v-text="locale.revenueLimit"></span></strong>
				in the <strong>last 12 months</strong>.
			</p>
			<p>
				If you build a website for a client, the limit has to fit the revenue of your client.
			</p>
			<?php else: ?>
			This license does not have a revenue limit.
			<?php endif ?>
		</div>
	</details>

	<?php snippet('templates/buy/checklist') ?>

	<footer>
		<p>
			<a href="/buy/<?= $product->value() ?>" @click="openCheckout('<?= $product->value() ?>', 1, $event)" target="_blank" class="btn btn--filled mb-1 w-100%">
				<?= icon('cart') ?>
				Buy <?= $product->label() ?>
			</a>
		</p>
	</footer>
</div>
