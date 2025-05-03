<div class="product p-6 rounded-xl flex flex-column justify-between" style="gap: 4rem" data-product="<?= $product->value() ?>">
	<header>
		<h2>
			<?= $product->label() ?>

			<?php if ($sale->isActive()): ?>
			<span class="price px-1" data-regular>
				<span v-text="locale.currencySign">€</span>
				<span class="amount" v-text="amountDisplay(locale.prices.<?= $product->value() ?>.regular)"><?= $product->price('EUR')->regular() ?></span>
			</span>
			<?php endif ?>
		</h2>

		<a href="/buy/basic" @click.prevent="openCheckout('<?= $product->value() ?>', 1)" target="_blank" class="h2 block mb-3">
			<span class="price" data-sale>
				<span class="currency-sign" v-text="locale.currencySign.trim()">€</span>
				<span class="amount" v-text="amountDisplay(locale.prices.<?= $product->value() ?>.sale)"><?= $product->price('EUR')->sale() ?></span>
			</span>
			per site
		</a>

		<?php if ($product === Kirby\Buy\Product::Basic): ?>
		<details class="revenue text-sm color-gray-700">
			<summary><?= $description ?> <mark><?= $limit ?> &rarr;</mark></summary>
			<div>
				<p>
					You may use the discounted Basic license if your total revenue/funding (not profit) in the <strong>last 12 months</strong> was below <strong><?= $revenueLimit ?><span v-cloak v-if="locale.revenueLimit.length" v-text="locale.revenueLimit"></span></strong>.
				</p>
				<p>
					If the website is for a client, the limit applies to the client's total revenue/funding.
				</p>
				<p style="color: var(--color-gray-400)">
					See the <a class="underline" href="#revenue-limit">frequently asked questions below</a> for more information.
				</p>
			</div>
		</details>
		<?php else: ?>
		<p class="description text-sm color-gray-700"><?= $description ?> <mark><?= $limit ?></mark></p>
		<?php endif ?>
	</header>


	<footer>
		<p>
			<a href="/buy/<?= $product->value() ?>" @click.prevent="openCheckout('<?= $product->value() ?>', 1)" target="_blank" class="btn btn--filled mb-1 w-100%">
				<?= icon('cart') ?>
				Buy <?= $product->label() ?>
			</a>
		</p>
	</footer>
</div>
