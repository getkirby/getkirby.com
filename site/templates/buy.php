<?php layout() ?>

<style>
article[data-loading] .price[data-sale] {
	color: var(--color-gray-600)
}

.checklist {
	font-size: var(--text-base);
}
.checklist li {
	display: flex;
	align-items: center;
	gap: .5rem;
}
.checklist li + li {
	margin-top: .25rem;
}

.revenue {
	position: relative;
}
.revenue summary {
	list-style: none;
}
.revenue summary::-webkit-details-marker {
	display: none;
}
.revenue div {
	position: absolute;
	top: 100%;
	left: 50%;
	width: 21rem;
	transform: translateX(-50%);
	background: black;
	color: white;
	margin-top: 1rem;
	padding: 1rem;
	border-radius: var(--rounded);
	box-shadow: var(--shadow-xl);
}
.revenue div::after {
	position: absolute;
	top: -4px;
	left: 50%;
	content: "";
	border-left: 4px solid transparent;
	border-bottom: 4px solid black;
	border-right: 4px solid transparent;
}
.revenue div p + p {
	margin-top: .75rem;
}
.revenue div strong {
	font-weight: var(--font-normal);
	color: var(--color-yellow-500);
}

.product[data-product="basic"] {
	border: 1px solid var(--color-gray-250);
}
.product[data-product="basic"] .price[data-sale] {
	color: var(--color-yellow-700);
}

.product[data-product="enterprise"] {
	background: var(--color-white);
	box-shadow: var(--shadow-xl);
}

.product[data-product="enterprise"] .description mark {
	background: var(--color-green-300);
}
.product[data-product="enterprise"] .btn svg {
	color: var(--color-green-600);
}
.product[data-product="enterprise"] .price[data-sale] {
	color: var(--color-green-700);
}

.price {
	display: inline-flex;
	align-items: baseline;
}
.price[data-regular] {
	color: var(--color-gray-700);
	text-decoration: line-through;
}
.price[data-sale] {
	gap: 0.3rem;
}
.price[data-sale] .currency-sign {
	font-size: var(--text-xl);
}

[v-cloak] {
	display: none;
}
</style>

<article v-scope data-loading @mounted="mounted">
	<?php snippet('templates/buy/checkout') ?>

	<div v-else>
		<div class="columns mb-42" style="--columns-sm: 1; --columns-md: 1; --columns-lg: 2; --gap: var(--spacing-3)">
			<div>
				<h1 class="h1 max-w-xl mb-12">
					The transparency of <a href="https://github.com/getkirby">open&#8209;source</a> meets a fair pricing&nbsp;model
				</h1>

				<?php if ($sale->isActive()): ?>
					<div class="h3 sale mb-6">
						<?= $sale->text() ?>
					</div>
				<?php endif ?>

				<?php snippet('templates/buy/checklist') ?>

			</div>
			<div class="columns" style="--columns: 2; --gap: var(--spacing-6)">
				<?php snippet('templates/buy/product', [
					'product'     => $basic,
					'description' => 'A discounted license for individuals and small teams with a',
					'limit'       => 'total annual revenue/funding of less than ' . $revenueLimit
				]) ?>
				<?php snippet('templates/buy/product', [
					'product'     => $enterprise,
					'description' => 'The standard license for companies and organizations of any size.',
					'limit'       => 'No&nbsp;revenue limit.'
				]) ?>
				<p class="text-xs text-center mb-6 color-gray-700" style="--span: 2">
					Prices + VAT if applicable. With your purchase you agree to our <a class="underline" href="<?= url('license') ?>">License terms</a>
				</p>
			</div>
		</div>
		<?php snippet('templates/buy/volume-discounts') ?>
	</div>

	<section class="mb-42 columns columns--reverse" style="--columns: 2; --columns-md: 1; --gap: var(--spacing-36)">
		<?php snippet('templates/buy/good-cause') ?>
		<?php snippet('templates/buy/faq') ?>
	</section>

	<footer class="h2">
		Manage your existing licenses in our <a href="https://hub.getkirby.com"><span class="link">license&nbsp;hub</span> &rarr;</a>
	</footer>
</article>

<script type="module">
import {
	createApp,
	reactive
} from '<?= url('assets/js/libraries/petite-vue.js') ?>';

// close price details on clicks outside the details
document.addEventListener("click", (event) => {
	for (const details of [...document.querySelectorAll("details")]) {
		if (details.contains(event.target) === false) {
			details.removeAttribute("open");
		}
	}
});

// countries which require a postal code
const postalCodeCountries = <?= json_encode(Kirby\Buy\Paddle::COUNTRIES_WITH_POSTAL_CODE) ?>;

createApp({
	// props dynamically populated by the backend
	locale: {
		country: "",
		currency: "€",
		prices: {
			basic: {
				regular: <?= $basic->price('EUR')->regular() ?>,
				sale: <?= $basic->price('EUR')->sale() ?>,
			},
			donation: {
				customer: <?= $basic->price('EUR')->customerDonation() ?>,
				team: <?= $basic->price('EUR')->teamDonation() ?>,
			},
			enterprise: {
				regular: <?= $enterprise->price('EUR')->regular() ?>,
				sale: <?= $enterprise->price('EUR')->sale() ?>,
			}
		},
		revenueLimit: "",
		status: null,
		vatRate: 0,
	},

	// user-generated props
	form: {
		city: "",
		company: "",
		country: "",
		donate: false,
		email: "",
		newsletter: false,
		postalCode: "",
		state: "",
		street: "",
		vatId: "",
	},

	// dynamic props
	checkoutIsOpen: false,
	isFetchingPrices: false,
	isProcessing: false,
	product: "enterprise",
	quantity: 1,

	// computed
	get discountRate() {
		<?php foreach ($discountsReversed as $minimum => $rate): ?>
		if (this.quantity >= <?= $minimum ?>) {
			return <?= $rate ?>;
		}
		<?php endforeach ?>

		return 0;
	},
	get discountAmount() {
		const factor = this.discountRate / 100;
		return this.netLicenseAmount * factor * -1;
	},
	get donationText() {
		return "Donate an additional " + this.locale.currency + this.locale.prices.donation.customer + " per license 💛";
	},
	get donationAmount() {
		return this.form.donate ? (this.locale.prices.donation.customer * this.quantity) : 0;
	},
	get needsPostalCode() {
		return postalCodeCountries.includes(this.form.country);
	},
	get netLicenseAmount() {
		return this.price * this.quantity;
	},
	get price() {
		return this.locale.prices[this.product].sale;
	},
	get subtotal() {
		return this.netLicenseAmount + this.donationAmount + this.discountAmount;
	},
	get totalAmount() {
		return this.subtotal + this.vatAmount;
	},
	get vatAmount() {
		const rate = this.vatIdExists ? 0 : this.locale.vatRate;
		return this.subtotal * rate;
	},
	get vatIdExists() {
		return this.locale.vatRate > 0 && this.form.vatId?.length > 0;
	},

	// methods
	amount(amount) {
		if (Number.isFinite(amount) === true) {
			const formatter = new Intl.NumberFormat("en", {
				minimumFractionDigits: 2,
				maximumFractionDigits: 2,
			});
			return this.locale.currency + formatter.format(amount);
		}
	},
	amountDisplay(amount) {
		if (Number.isFinite(amount) === true) {
			const formatter = new Intl.NumberFormat("en");
			return formatter.format(amount);
		}
	},
	async changeCountry(event) {
		this.locale       = await this.fetchPrices(this.form.country);
		this.form.country = this.locale.country;

		window.localStorage.setItem("country", this.locale.country);
	},
	closeCheckout() {
		this.checkoutIsOpen = false;

		window.scrollTo({
			top: 0,
			behavior: "smooth",
		});
	},
	async fetchPrices(country) {
		if (this.isFetchingPrices === true) {
			return;
		}

		this.isFetchingPrices = true;

		const query = country ? "?" + new URLSearchParams({
			country: country,
		}) : "";

		// fetch prices with options that allow using the preloaded response
		const response = await fetch("/buy/prices" + query, {
			method: "GET",
			credentials: "include",
			mode: "no-cors",
		});

		this.isFetchingPrices = false;

		return await response.json();
	},
	async mounted() {
		const country = window.localStorage.getItem("country") ?? this.locale.country;

		this.locale               = await this.fetchPrices(country);
		this.form.country = this.locale.country;

		document.querySelector("article[data-loading]").removeAttribute("data-loading");

		// stop checkout processing on unload
		window.addEventListener("pagehide", (e) => {
			this.isProcessing = false;
		});
	},
	async openCheckout(product, quantity = 1) {
		this.product = product;
		this.quantity = quantity;
		this.checkoutIsOpen = true;

		await this.$nextTick();

		const y = document.querySelector("#checkout").getBoundingClientRect().top + window.scrollY;

		window.scroll({
			top: y - 32,
			behavior: "smooth",
		});

		document.querySelector("input[name=quantity]").focus({ preventScroll: true });
	},
	restrictQuantity(event) {
		// allow an empty input...
		if (this.quantity !== "") {
			// ...but otherwise prevent values outside of the valid range
			this.quantity = Math.max(Math.min(this.quantity, event.target.max), event.target.min);
		}
	},
	submit() {
		this.isProcessing = true;
	}
}).mount();
</script>
