<style>
.checkout .dialog {
	position: relative;
	border-radius: var(--rounded);
	box-shadow: var(--shadow-2xl);
	background: var(--color-gray-200);
	border: 1px solid var(--color-gray-300);
	font-size: var(--text-sm);
}

.checkout form {
	border-radius: var(--rounded);
	overflow: hidden;
}

@media screen and (min-width: 55rem) {
	.checkout {
		border: none;
	}

	.checkout form {
		display: grid;
		grid-template-columns: 1fr 1fr;
		grid-template-areas: "preview form";
	}
}

.checkout-loader {
	position: absolute;
	display: flex;
	align-items: center;
	justify-content: center;
	top: 0;
	left: 0;
	right: 0;
	bottom: 0;
	background: rgba(255,255,255,.7);
}

.checkout-preview {
	grid-area: preview;
	background: var(--color-white);
}
.checkout-form {
	grid-area: form;
	padding: var(--spacing-8);
	display: flex;
	flex-direction: column;
	justify-content: space-between;
	background: rgba(255,255,255, .25);
}
.checkout :where(.info, .help) {
	padding-top: var(--spacing-1);
	color: var(--color-gray-700);
}
.checkout .help {
	font-size: var(--text-xs);
}
.checkout .buttons {
	margin-top: var(--spacing-8);
	display: flex;
	gap: .75rem;
}
.checkout .buttons .btn {
	flex-basis: 50%;
	flex-grow: 1;
}
.checkout-preview {
	display: flex;
	flex-direction: column;
	justify-content: space-between;
	padding: var(--spacing-8);
	gap: var(--spacing-6);
}

.checkout-preview :where(th, td) {
	border-top: 1px solid var(--color-border);
	height: calc(2.25rem + 1px);
	padding: .425rem 0;
}
.checkout-preview th {
	font-weight: var(--font-normal);
}
.checkout-preview th .inputs {
	display: flex;
	gap: .25rem;
	align-items: center;
}
.checkout-preview th :where(input, select) {
	background: var(--color-light);
	height: 1.375rem;
	line-height: 1.375rem;
	padding-left: var(--spacing-1);
	border-radius: var(--rounded);
}
.checkout-preview th :where(select) {
	padding: 0 var(--spacing-2);
}
.checkout-preview th input {
	width: 3.5rem;
}
.checkout-preview td {
	text-align: right;
}
.checkout-preview tr.total > * {
	border-top-width: 2px;
	font-weight: var(--font-bold);
}

.checkout[data-product="enterprise"] {
	--color-price: var(--color-green-300);
	--color-text: var(--color-green-900);
	--color-back: var(--color-green-400);
	--color-back-disabled: var(--color-green-300);
	--color-icon: var(--color-green-600);
	--color-icon-donation: var(--color-green-700);
}

.checkout[data-product="basic"] {
	--color-price: var(--color-yellow-300);
	--color-text: var(--color-yellow-900);
	--color-back: var(--color-yellow-400);
	--color-back-disabled: var(--color-yellow-300);
	--color-icon: var(--color-yellow-600);
	--color-icon-donation: var(--color-yellow-700);
}

.checkout .donation svg {
	color: var(--color-icon-donation);
}

.checkout-preview tr.total td mark {
	background: var(--color-price);
}

.checkout .btn.btn--filled svg {
	color: var(--color-icon) !important;
}

.checkout button[type="reset"] {
	position: absolute;
	right: -.5rem;
	top: -.5rem;
	background: var(--color-black);
	border-radius: 50%;
	width: 1.25rem;
	height: 1.25rem;
	display: flex;
	align-items: center;
	justify-content: center;
	box-shadow: var(--shadow);
	color: var(--color-white);
}
</style>

<div id="checkout" class="checkout mb-42" v-cloak :data-product="product" v-if="checkoutIsOpen">
	<div class="dialog" :inert="isFetchingPrices || isProcessing">
		<form class="dialog-form" action="<?= url('buy') ?>" method="POST" @submit="submit">
			<div class="checkout-preview">
				<div>
					<h2 class="label">Your order</h2>
					<table>
						<tr>
							<th>
								<div class="inputs">
									<label class="sr-only" for="quantity">Quantity</label>
									<input id="quantity" type="number" name="quantity" value="1" required min="<?= option('buy.quantities.min') ?>" max="<?= option('buy.quantities.max') ?>" step="1" v-model="quantity" @input="restrictQuantity">
									<label class="sr-only" for="product">Product</label>
									<select id="product" required name="product" v-model="product" value="<?= $basic->value() ?>">
										<option value="<?= $basic->value() ?>" selected>Kirby <?= $basic->label() ?></option>
										<option value="<?= $enterprise->value() ?>">Kirby <?= $enterprise->label() ?></option>
									</select>
								</div>
							</th>
							<td>{{ amount(netLicenseAmount) }}</td>
						</tr>
						<tr v-if="discountRate">
							<th>
								<p>Volume Discount (-{{ discountRate }}%)</p>
								<p v-if="quantity >= 50" class="text-xs color-gray-700">Please <a class="underline" href="mailto:support@getkirby.com">contact us</a> for <span class="whitespace-nowrap">high-volume</span> discounts</p>
							</th>
							<td>{{ amount(discountAmount) }}</td>
						</tr>
						<tr v-if="form.donate">
							<th>
								Your donation
							</th>
							<td>{{ amount(donationAmount) }}</td>
						</tr>
						<tr v-if="locale.vatRate > 0">
							<th>
								VAT ({{ (vatRate * 100).toFixed(2) }}%)
							</th>
							<td>{{ amount(vatAmount) }}</td>
						</tr>
						<tr class="total">
							<th>
								Total
							</th>
							<td><mark>{{ amount(totalAmount) }}</mark></td>
						</tr>
					</table>
				</div>

				<?php if ($donation['customerAmount'] > 0): ?>
				<div>
					<h2 class="font-bold">Support a good cause</h2>
					<p class="mb-3 help">
						For every license purchased, we donate <span class="whitespace-nowrap">€<?= $donation['teamAmount'] ?></span><span class="whitespace-nowrap" v-if="locale.currencySign !== '€'" v-text="' (~ ' + locale.currencySign + locale.prices.donation.team + ')'"></span> to
						<a class="underline" rel="noopener noreferrer" target="_blank" href="<?= $donation['link'] ?>"><?= $donation['charity'] ?></a> <?= $donation['purpose'] ?>. Join us and contribute as well.
					</p>
					<label class="checkbox donation">
						<input id="donate" type="checkbox" name="donate" v-model="form.donate">
						<?php if ($donation['customerAmount'] === $donation['teamAmount']): ?>
						Match our donation <?= icon('heart') ?>
						<?php else: ?>
						<span v-text="donationText">Donate an additional €<?= $donation['customerAmount'] ?> per license 💛</span>
						<?php endif ?>
					</label>
				</div>
				<?php endif ?>
			</div>
			<div class="checkout-form">
				<div>
					<fieldset class="checkout-fieldset checkout-identity">
						<legend>Your details</legend>
						<div class="fields">
							<div class="field">
								<label class="label" for="email">Email <abbr title="Required" aria-hidden>*</abbr></label>
								<input id="email" name="email" class="input" type="email" required v-model="form.email" placeholder="mail@example.com">
							</div>

							<div class="fieldgroup">
								<div class="field">
									<label class="label" for="country">Country <abbr title="Required" aria-hidden>*</abbr></label>
									<select id="country" name="country" required autocomplete="country" class="input" v-model="form.country" @change="changeCountry">
										<?php foreach (Kirby\Buy\Paddle::COUNTRIES as $countryCode => $countryName): ?>
										<option value="<?= $countryCode ?>"><?= $countryName ?></option>
										<?php endforeach ?>
									</select>
								</div>
								<div v-if="needsPostalCode" class="field">
									<label class="label" for="postalCode">Postal Code <abbr title="Required" aria-hidden>*</abbr></label>
									<input id="postalCode" name="postalCode" class="input" autocomplete="postal-code" :required="needsPostalCode" v-model="form.postalCode" type="text">
								</div>
							</div>
						</div>
					</fieldset>

					<fieldset class="checkout-fieldset checkout-company" v-if="locale.vatRate > 0">
						<legend>Your business</legend>
						<div class="fields">
							<div class="field">
								<label class="label" for="vatId">VAT ID</label>
								<input id="vatId" name="vatId" class="input" type="text" v-model="form.vatId">
							</div>

							<div class="field" v-if="vatIdExists">
								<label class="label" for="company">Company <abbr title="Required" aria-hidden>*</abbr></label>
								<input id="company" name="company" placeholder="Company name …" autocomplete="organization" class="input" type="text" v-model="form.company" :required="vatIdExists">
							</div>

							<div class="field" v-if="vatIdExists">
								<label class="label" for="street">Street <abbr title="Required" aria-hidden>*</abbr></label>
								<input id="street" name="street" class="input" type="text" v-model="form.street" :required="vatIdExists">
							</div>

							<div class="field" v-if="vatIdExists">
								<label class="label" for="city">Town/City <abbr title="Required" aria-hidden>*</abbr></label>
								<input id="city" name="city" class="input" type="text" v-model="form.city" :required="vatIdExists">
							</div>

							<div class="field" v-if="vatIdExists">
								<label class="label" for="state">State/County <abbr title="Required" aria-hidden>*</abbr></label>
								<input id="state" name="state" class="input" type="text" v-model="form.state" :required="vatIdExists">
							</div>
						</div>
					</fieldset>

					<div class="field">
						<label class="font-bold flex items-center" style="gap: var(--spacing-2)">
							<input id="newsletter" type="checkbox" name="newsletter" v-model="form.newsletter">
							Subscribe to our Kosmos newsletter
						</label>
						<p class="help">We won't ever spam you! You can unsubscribe at any time. <a class="underline" target="_blank" href="<?= url('kosmos') ?>">Learn more about Kosmos…</a></p>
					</div>

					<div v-if="product === '<?= $basic->value() ?>'" class="field">
						<p class="font-bold">Confirm the revenue limit</p>
						<p class="info mb-3">
							<mark>End customers must not exceed a total annual revenue/funding of
							<strong><?= $revenueLimit ?><span v-if="locale.revenueLimit.length" v-text="locale.revenueLimit"></span></strong></mark>
							to be eligible for the Kirby Basic license. <a class="underline" href="#revenue-limit">Read more…</a>
						</p>
						<label class="flex items-baseline" style="gap: var(--spacing-2)">
							<input id="limit" type="checkbox" name="limit" required>
							<span>
								I have read and understood this restriction <abbr title="Required" aria-hidden>*</abbr><br>
								<button type="button" class="underline" @click="product = '<?= $enterprise->value() ?>'">Switch to Enterprise</button> to remove the revenue limit.
							</span>
						</label>
					</div>
				</div>
				<div class="buttons">
					<button type="submit" class="btn btn--filled" :disabled="isProcessing">
						<span v-if="isProcessing"><?= icon('loader') ?></span><span v-else><?= icon('cart') ?></span> Checkout
					</button>
				</div>
			</div>

			<p class="checkout-loader" v-if="isFetchingPrices">
				<?= icon('loader') ?>
			</p>
		</form>

		<button type="reset" @click="closeCheckout" aria-label="Close checkout">
			<?= icon('cancel-small') ?>
		</button>
	</div>
	<p class="text-xs text-center mb-6 color-gray-700 pt-6">Final VAT calculation is performed at checkout. With your purchase you agree to our <a class="underline" href="<?= url('license') ?>">License terms</a></p>
</div>
