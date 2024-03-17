<div class="product p-6 rounded-xl flex flex-column justify-between" style="gap: 4rem" data-product="<?= $product->value() ?>">
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

		<a href="/buy/basic" @click.prevent="openCheckout('<?= $product->value() ?>', 1)" target="_blank" class="h2 block mb-3">
			<span class="price" data-sale>
				<span class="currency-sign" v-text="locale.currency.trim()">€</span>
				<span class="amount" v-text="amountDisplay(locale.prices.<?= $product->value() ?>.sale)"><?= $product->price('EUR')->sale() ?></span>
			</span>
			per site
		</a>

		<p class="text-sm color-gray-700"><?= $description ?></p>

		<?php if (1==2): ?>
		<details class="revenue">
			<summary>
				<?php if ($product === Buy\Product::Basic): ?>
					<?= icon('alert') ?> <span>Your revenue: <strong>< <?= $limit ?></strong>*</span>
				<?php else: ?>
					<?= icon('check') ?> No revenue limit</span>
				<?php endif ?>
			</summary>
			<div>
				<?php if ($product === Buy\Product::Basic): ?>
				<p>
					You qualify to use a Basic license as long as your overall revenue/funding (not profit) was less than <strong><?= $revenueLimit ?><span v-cloak v-if="locale.revenueLimit.length" v-text="locale.revenueLimit"></span></strong> in the <strong>last 12 months</strong>.
				</p>
				<p>
					If you build a website for a client, the limit applies to the revenue of your client.
				</p>
				<?php else: ?>
				This license does not have any revenue limit.
				<?php endif ?>
			</div>
		</details>
		<?php endif ?>

	</header>


	<footer>
		<p>
			<a href="/buy/<?= $product->value() ?>" @click.prevent="openCheckout('<?= $product->value() ?>', 1)" target="_blank" class="btn <?= $product === Buy\Product::Basic ? 'btn--outlined' : 'btn--filled' ?> mb-1 w-100%">
				<?= icon('cart') ?>
				Buy <?= $product->label() ?>
			</a>
		</p>
	</footer>
</div>
