<style>
@import url("/assets/css/site/dialog.css");

.checkout .dialog {
	position: relative;
	border-radius: var(--rounded);
	box-shadow: var(--shadow-2xl);
	background: var(--color-gray-200);
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
.checkout .help {
	font-size: var(--text-xs);
	padding-top: var(--spacing-1);
	color: var(--color-gray-700);
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

.checkout-preview tr.total td {
	color: var(--color-purple-600);
}

.checkout .btn.btn--filled {
	background: var(--color-purple-400) !important;
	border-color: var(--color-purple-400);
	color: var(--color-purple-900) !important;
}
.checkout .btn.btn--filled[disabled] {
	background: var(--color-purple-300) !important;
	border-color: var(--color-purple-300);
}
.checkout .btn.btn--filled svg {
	color: var(--color-purple-900) !important;
}

.checkout-fieldset {
	margin-bottom: var(--spacing-6);
}
.checkout-fieldset legend {
	font-weight: var(--font-bold);
	margin-bottom: var(--spacing-2);
}
.checkout-fieldset .fields {
	border: 1px solid var(--color-border);
	border-radius: var(--rounded);
	overflow: clip;
}
.checkout-fieldset .field {
	display: flex;
	background: var(--color-white);
	align-items: center;
}
.checkout-fieldset .field + .field {
	margin-top: 0;
	border-top: 1px solid var(--color-border);
}

.checkout-fieldset .label {
	display: flex;
	align-items: center;
	height: 2.25rem;
	flex-basis: 6.75rem;
	flex-shrink: 0;
	font-weight: var(--font-normal);
	margin-bottom: 0;
	white-space: nowrap;
	background: rgba(0,0,0, .03);
	padding: var(--spacing-2);
}
.checkout-fieldset .field .input {
	box-shadow: none;
	outline-offset: -2px;
	width: 100%;
	flex-grow: 1;
}

.checkout-fieldset .fieldgroup {
	border-top: 1px solid var(--color-border);
}

@media screen and (min-width: 70rem) {
	.checkout-fieldset .fieldgroup {
		display: flex;
		align-items: center;
		border-top: 1px solid var(--color-border);
	}
	.checkout-fieldset .fieldgroup .field {
		border-top: 0;
	}
	.checkout-fieldset .fieldgroup .field:first-child {
		flex-grow: 1;
	}
	.checkout-fieldset .fieldgroup .field:nth-child(2) {
		flex-basis: 14rem;
		border-left: 1px solid var(--color-border);
	}
	.checkout-fieldset .fieldgroup .field:nth-child(2) .label {
		flex-basis: 6rem;
	}
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

<div id="checkout" class="checkout mb-42" v-cloak v-if="checkoutIsOpen">
	<div class="dialog" :inert="isFetchingPrices || isProcessing">
		<form class="dialog-form" action="<?= url('buy') ?>" method="POST" @submit="submit">
			<div class="checkout-preview">
				<div>
					<h2 class="label">Your order</h2>
					<table>
						<tr>
							<th>
								<div class="inputs">
									<input type="number" name="quantity" value="1" required min="<?= option('buy.quantities.min') ?>" max="<?= option('buy.quantities.max') ?>" step="1" v-model="quantity" @input="restrictQuantity">
									<select required name="product" v-model="product" value="<?= $basic->value() ?>">
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
						<tr v-if="personalInfo.donate">
							<th>
								Your donation
							</th>
							<td>{{ amount(donationAmount) }}</td>
						</tr>
						<tr v-if="locale.vatRate > 0">
							<th>
								VAT ({{ vatIdExists ? 0 : locale.vatRate * 100 }}%)
							</th>
							<td>{{ amount(vatAmount) }}</td>
						</tr>
						<tr class="total">
							<th>
								Total
							</th>
							<td>{{ amount(totalAmount) }}</td>
						</tr>
					</table>
				</div>

				<?php if ($donation['customerAmount'] > 0): ?>
				<div>
					<h2 class="font-bold">Support a good cause</h2>
					<p class="mb-3 help">
						For every purchased license we donate <span class="whitespace-nowrap">€<?= $donation['teamAmount'] ?></span><span class="whitespace-nowrap" v-if="locale.currency !== '€'" v-text="' (~ ' + locale.currency + locale.prices.donation.team + ')'"></span> to
						<a class="underline" rel="noopener noreferrer" target="_blank" href="<?= $donation['link'] ?>"><?= $donation['charity'] ?></a> <?= $donation['purpose'] ?>.
					</p>
					<label class="checkbox">
						<input id="donate" type="checkbox" name="donate" v-model="personalInfo.donate">
						<?php if ($donation['customerAmount'] === $donation['teamAmount']): ?>
						Match our donation 💛
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
								<label class="label" for="email">Email <abbr title="Required">*</abbr></label>
								<input id="email" name="email" class="input" type="email" required v-model="personalInfo.email" placeholder="mail@example.com">
							</div>

							<div class="fieldgroup">
								<div class="field">
									<label class="label" for="country">Country <abbr title="Required">*</abbr></label>
									<select id="country" name="country" required autocomplete="country" class="input" v-model="personalInfo.country" @change="changeCountry">
										<?php foreach ($countries as $countryCode => $countryName): ?>
										<option value="<?= $countryCode ?>"><?= $countryName ?></option>
										<?php endforeach ?>
									</select>
								</div>
								<div v-if="needsPostalCode" class="field">
									<label class="label" for="postalCode">Postal Code <abbr title="Required">*</abbr></label>
									<input id="postalCode" name="postalCode" class="input" autocomplete="postal-code" :required="needsPostalCode" v-model="personalInfo.postalCode" type="text">
								</div>
							</div>
						</div>
					</fieldset>

					<fieldset class="checkout-fieldset checkout-company" v-if="locale.vatRate > 0">
						<legend>Your business</legend>
						<div class="fields">
							<div class="field">
								<label class="label" for="vatId">VAT ID</label>
								<input id="vatId" name="vatId" class="input" type="text" v-model="personalInfo.vatId">
							</div>

							<div class="field" v-if="vatIdExists">
								<label class="label" for="company">Company <abbr title="Required">*</abbr></label>
								<input id="company" name="company" placeholder="Company name …" autocomplete="organization" class="input" type="text" v-model="personalInfo.company" :required="vatIdExists">
							</div>

							<div class="field" v-if="vatIdExists">
								<label class="label" for="street">Street <abbr title="Required">*</abbr></label>
								<input id="street" name="street" class="input" type="text" v-model="personalInfo.street" :required="vatIdExists">
							</div>

							<div class="field" v-if="vatIdExists">
								<label class="label" for="city">Town/City <abbr title="Required">*</abbr></label>
								<input id="city" name="city" class="input" type="text" v-model="personalInfo.city" :required="vatIdExists">
							</div>

							<div class="field" v-if="vatIdExists">
								<label class="label" for="state">State/County <abbr title="Required">*</abbr></label>
								<input id="state" name="state" class="input" type="text" v-model="personalInfo.state" :required="vatIdExists">
							</div>
						</div>
					</fieldset>

					<div class="field">
						<label class="font-bold flex items-center" style="gap: var(--spacing-2)">
							<input id="newsletter" type="checkbox" name="newsletter" v-model="personalInfo.newsletter">
							Subscribe to our Kosmos newsletter
						</label>
						<p class="help">We won't ever spam you! You can unsubscribe at any time. <a class="underline" target="_blank" href="<?= url('kosmos') ?>">Learn more about Kosmos…</a></p>
					</div>

					<div v-if="product === '<?= $basic->value() ?>'" class="field">
						<label class="font-bold flex items-center" style="gap: var(--spacing-2)">
							<input id="limit" type="checkbox" name="limit" required>
							<span>Confirm the revenue limit <abbr title="Required">*</abbr></span>
						</label>
						<p class="help">
							End customers must not exceed an annual revenue/funding of
							<strong><?= $revenueLimitVerbose ?><span v-if="locale.revenueLimit.length" v-text="locale.revenueLimit"></span></strong>
							to be eligible for this license.
							<button type="button" class="underline" @click="product = '<?= $enterprise->value() ?>'">Switch to Enterprise</button> to remove the revenue limit.
						</p>
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

		<button type="reset" @click="closeCheckout">
			<?= icon('cancel-small') ?>
		</button>
	</div>
	<p class="text-xs text-center mb-6 color-gray-700 pt-6">Final VAT calculation is performed at checkout. With your purchase you agree to our <a class="underline" href="<?= url('license') ?>">License terms</a></p>
</div>
