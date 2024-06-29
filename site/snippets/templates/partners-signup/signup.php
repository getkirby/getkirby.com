<style>
.signup {
	background: var(--color-gray-200);
	box-shadow: var(--shadow-2xl);
	font-size: var(--text-sm);
}
.signup .radios {
	display: flex;
	align-items: center;
	gap: var(--spacing-1);
}
.signup .radios label {
	display: inline-flex;
	flex-grow: 1;
	align-items: center;
	gap: var(--spacing-2);
	cursor: pointer;
	padding: var(--spacing-2) var(--spacing-3);
	background: rgba(0,0,0, .05);
	border-radius: var(--rounded);
}
.signup .radios input {
	cursor: pointer;
}

.signup .label {
	font-weight: var(--font-bold);
	margin-bottom: var(--spacing-2);
}

.signup .benefits li,
.signup .requirements li {
	display: flex;
	align-items: center;
	gap: var(--spacing-2);
}
.signup .benefits li svg {
	color: var(--color-green-700);
}
.signup .benefits .extra {
	color: var(--color-green-800);
}

.signup .requirements li svg {
	color: var(--color-yellow-700);
}

.signup .price {
	display: inline-flex;
	align-items: baseline;
	gap: 0.2rem;
}

.signup .currency-sign {
	font-size: var(--text-base);
}

.signup .btn {
	width: 100%;
}
.signup .btn svg,
.signup .btn strong {
	color: var(--color-green-500);
}

.signup .columns > div {
	padding: var(--spacing-8);
	background: white;
}
.signup .columns > div:last-child {
	background: rgba(255,255,255, .25);
}

[v-cloak] {
	display: none !important;
}
</style>

<div id="signup" class="signup bg-white rounded" v-scope>

	<div class="columns" style="--columns: 2; gap: 0">

		<div>
			<fieldset class="mb-6">
				<legend class="label">Partnership</legend>
				<div class="radios">
					<label><input type="radio" name="tier" v-model="personalInfo.tier" value="regular" /> Regular partner</label>
					<label><input type="radio" name="tier" v-model="personalInfo.tier" value="certified" checked /> Certified partner</label>
				</div>
			</fieldset>

			<fieldset class="mb-6">
				<legend class="label">How many people are in your company?</legend>
				<div class="radios">
					<label><input type="radio" name="people" v-model="personalInfo.people" value="1" checked /> 1</label>
					<label><input type="radio" name="people" v-model="personalInfo.people" value="2" /> 2</label>
					<label><input type="radio" name="people" v-model="personalInfo.people" value="3" /> 3</label>
					<label><input type="radio" name="people" v-model="personalInfo.people" value="4+" /> 4+</label>
				</div>
			</fieldset>

			<section>
				<h3 class="label">Your listing</h3>

				<div class="rounded bg-light" style="padding: 2px">
					<?php snippet('templates/partners-signup/preview') ?>
				</div>
			</section>
		</div>

		<div class="flex flex-column justify-between">
			<div>
				<section class="mb-6">
					<h3 class="font-bold mb-1">What you get</h3>
					<ul class="benefits">
						<li><?= icon('star') ?> Your own customizable profile page</li>
						<li><?= icon('star') ?> Exposure and traffic from getkirby.com</li>
						<li v-if="personalInfo.tier === 'certified'"><?= icon('star') ?> <span>Project gallery with up to <span class="extra">6 projects</span></span></li>
						<li v-else v-cloak><?= icon('star') ?> Project gallery with up to 3 projects</li>
						<li><?= icon('star') ?> Access to the Discord #partners channel</li>
						<li><?= icon('star') ?> Directly matched client leads</li>
						<li><?= icon('star') ?> More visibility within the Kirby community</li>
					</ul>
				</section>

				<section class="mb-6" v-if="personalInfo.tier === 'certified'">
					<h3 class="font-bold mb-1">Certified partner benefits</h3>
					<ul class="benefits">
						<li class="extra"><?= icon('star') ?> Certification, including official badges</li>
						<li class="extra"><?= icon('star') ?> 10% discount on all licenses</li>
						<li class="extra"><?= icon('star') ?> Regular office hour calls with the Kirby core team</li>
						<li class="extra"><?= icon('star') ?> Detailed results of our project review</li>
						<li class="extra"><?= icon('star') ?> Priority listing in the directory</li>
						<li class="extra"><?= icon('star') ?> Promotion on social media and in the Kosmos newsletter</li>
					</ul>
				</section>

				<section class="mb-6">
					<h3 class="font-bold mb-1">Requirements</h3>
					<ul class="requirements" v-if="personalInfo.tier === 'certified'">
						<li><?= icon('check') ?> 4 completed Kirby projects</li>
						<li><?= icon('check') ?> 1 reviewed project</li>
					</ul>
					<ul class="requirements" v-else v-cloak>
						<li><?= icon('check') ?> 2 completed Kirby projects</li>
					</ul>
				</section>

				<section class="mb-12">
					<h3 class="font-bold">Price per year</h3>
					<p class="price text-xl mb-3">
						<span v-text="locale.currency.trim()" class="currency-sign">€</span>
						<span v-text="price"><?= $certified->price()->regular(1) ?></span>
					</p>
					<ul class="text-xs color-gray-700">
						<li>Price + VAT if applicable.</li>
						<li>You will be charged once your application has been accepted.</li>
						<li>Your partnership will <em>not</em> automatically renew.</li>
					</ul>
				</section>
			</div>

			<a :href="link" target="_blank" class="btn btn--filled">
				<?= icon('icon-arrow') ?> Apply now
			</a>
		</div>
	</div>

</div>

<script type="module">
import {
	createApp,
	reactive
} from '<?= url('assets/js/libraries/petite-vue.js') ?>';

createApp({
	// props dynamically populated by the backend
	locale: {
		currency: "€",
		prices: {
			regular: {
				"1": <?= $regular->price()->regular(1) ?>,
				"2": <?= $regular->price()->regular(2) ?>,
				"3": <?= $regular->price()->regular(3) ?>,
				"4+": <?= $regular->price()->regular(4) ?>,
			},
			certified: {
				"1": <?= $certified->price()->regular(1) ?>,
				"2": <?= $certified->price()->regular(2) ?>,
				"3": <?= $certified->price()->regular(3) ?>,
				"4+": <?= $certified->price()->regular(4) ?>,
			}
		},
	},

	// user-generated props
	personalInfo: {
		people: 1,
		tier: "certified",
		title: "",
		subtitle: "",
		location: "",
		description: ""
	},
	get price() {
		const tier = this.personalInfo.tier;
		const people = this.personalInfo.people;

		const price = this.locale.prices[tier][people];

		const formatter = new Intl.NumberFormat("en");
		return formatter.format(price);
	},
	get link() {
		const link = "https://airtable.com/appeeHREbUMMaZGRP/pag4FOyHuNDzqbbkv/form"
		const params = new URLSearchParams();

		params.append("prefill_Plan", this.personalInfo.tier);
		params.append("prefill_People", this.personalInfo.people);
		params.append("prefill_Title", this.personalInfo.title);
		params.append("prefill_Subtitle", this.personalInfo.subtitle);
		params.append("prefill_Location", this.personalInfo.location);
		params.append("prefill_Location", this.personalInfo.location);
		params.append("prefill_Description", this.personalInfo.description);
		params.append("prefill_Currency", "EUR");

		return link + "?" + params;
	}
}).mount();
</script>
