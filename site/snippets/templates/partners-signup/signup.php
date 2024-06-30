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
.signup .columns .right-column {
	background: rgba(255,255,255, .25);
}

.submit-buttons {
	display: flex;
	gap: 1rem;
}

.back-button {
	flex-basis: 10rem;
}

[v-cloak] {
	display: none !important;
}
</style>

<div id="signup" class="signup bg-white rounded" v-scope @mounted="mounted">
	<form action="<?= url('partners/join') ?>" method="POST" @submit="submit" class="columns dialog-form" style="--columns: 2; gap: 0">
		<div>
			<fieldset class="mb-6">
				<legend class="label">Partnership</legend>
				<div class="radios">
					<label><input type="radio" name="tier" v-model="personalInfo.tier" value="regular" :disabled="view === 'details'" /> Regular partner</label>
					<label><input type="radio" name="tier" v-model="personalInfo.tier" value="certified" :disabled="view === 'details'" checked /> Certified partner</label>
				</div>
			</fieldset>

			<fieldset class="mb-6">
				<legend class="label">How many people are in your company?</legend>
				<div class="radios">
					<label><input type="radio" name="people" v-model="personalInfo.people" value="1" :disabled="view === 'details'" checked /> 1</label>
					<label><input type="radio" name="people" v-model="personalInfo.people" value="2" :disabled="view === 'details'" /> 2</label>
					<label><input type="radio" name="people" v-model="personalInfo.people" value="3" :disabled="view === 'details'" /> 3</label>
					<label><input type="radio" name="people" v-model="personalInfo.people" value="4+" :disabled="view === 'details'" /> 4+</label>
				</div>
			</fieldset>

			<section>
				<h3 class="label">Your listing</h3>

				<div class="rounded bg-light" style="padding: 2px">
					<?php snippet('templates/partners-signup/preview') ?>
				</div>
			</section>
		</div>

		<div class="flex flex-column justify-between right-column" v-if="view === 'info'">
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

			<button type="button" class="btn btn--filled" @click="view = 'details'">
				<?= icon('icon-arrow') ?> Apply now
			</button>
		</div>

		<div class="flex flex-column justify-between right-column" v-if="view === 'details'" v-cloak>
			<div>
				<fieldset class="checkout-fieldset">
					<legend>Your business</legend>
					<div class="fields">
						<div class="field">
							<label class="label" for="website">Your website <abbr title="Required" aria-hidden>*</abbr></label>
							<input id="website" name="website" class="input" type="url" required v-model="personalInfo.website" placeholder="https://example.com">
						</div>

						<div class="field">
							<label class="label" for="projects">Projects <abbr title="Required" aria-hidden>*</abbr></label>
							<input id="projects" name="projects" class="input" type="number" required :min="minimumProjects" v-model="personalInfo.projects" placeholder="42">
						</div>
					</div>
					<span class="help">How many projects have you completed with Kirby? Can be approximate.</span>
				</fieldset>

				<div class="checkout-field field mb-6">
					<label class="label" for="references">Reference links <abbr title="Required" aria-hidden="">*</abbr></label>
					<textarea id="references" name="references" class="input" :rows="minimumProjects + 1" required v-model="personalInfo.references" @input="validateReferences" placeholder="https://example.com"></textarea>
					<span class="help">Please provide at least {{ minimumProjects }} links, with your best project first.</span>
				</div>

				<div class="checkout-field field mb-6" v-if="personalInfo.tier === 'certified'">
					<label class="label" for="download">Download link to the review project</label>
					<input id="download" name="download" class="input" type="url" v-model="personalInfo.downloadLink" placeholder="https://download.example.com/my-review-project.zip">
					<span class="help">Leave this field empty if you want to give us access to GitHub etc. or provide the project otherwise. We will get in touch with you to coordinate access to the project.</span>
				</div>

				<fieldset class="checkout-fieldset">
					<legend>Your contact information</legend>
					<div class="fields">
						<div class="field">
							<label class="label" for="name">Your name <abbr title="Required" aria-hidden>*</abbr></label>
							<input id="name" name="name" class="input" type="text" required v-model="personalInfo.name" placeholder="Jane Doe">
						</div>

						<div class="field">
							<label class="label" for="email">Email <abbr title="Required" aria-hidden>*</abbr></label>
							<input id="email" name="email" class="input" type="email" required v-model="personalInfo.email" placeholder="mail@example.com">
						</div>
						<div class="field">
							<label class="label" for="discord">Discord name</label>
							<input id="discord" name="discord" class="input" type="text" required v-model="personalInfo.discord" placeholder="janedoe">
						</div>
					</div>
				</fieldset>

				<div class="checkout-field field mb-6">
					<label class="label" for="notes">Notes</label>
					<textarea id="notes" name="notes" class="input" rows="2" v-model="personalInfo.notes"></textarea>
				</div>
			</div>

			<div class="submit-buttons">
				<button type="button" class="btn btn--outlined back-button" @click="view = 'info'">
					Back
				</button>

				<button type="submit" class="btn btn--filled" :disabled="isProcessing">
					<span v-if="isProcessing" v-cloak><?= icon('loader') ?></span><span v-else><?= icon('verified') ?></span> Submit application
				</button>
			</div>
		</div>
	</form>
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
		// plan
		people: 1,
		tier: "certified",

		// listing fields
		businessName: "",
		businessType: "",
		location: "",
		description: "",

		// business info
		website: "",
		projects: "",
		references: "",
		downloadLink: "",

		// contact info
		name: "",
		email: "",
		discord: "",

		// notes
		notes: "",
	},

	// dynamic props
	isProcessing: false,
	view: "info",

	// computed
	get minimumProjects() {
		return this.personalInfo.tier === "certified" ? 4 : 2;
	},
	get price() {
		const tier = this.personalInfo.tier;
		const people = this.personalInfo.people;

		const price = this.locale.prices[tier][people];

		const formatter = new Intl.NumberFormat("en");
		return formatter.format(price);
	},

	// methods
	async fetchPrices() {
		// fetch prices with options that allow using the preloaded response
		const response = await fetch("/partners/join/prices", {
			method: "GET",
			credentials: "include",
			mode: "no-cors",
		});

		return await response.json();
	},
	labelStyle(value) {
		if (value) {
			return "opacity: 0";
		}

		return null;
	},
	async mounted() {
		this.locale = await this.fetchPrices();

		// stop checkout processing on unload
		window.addEventListener("pagehide", (e) => {
			this.isProcessing = false;
		});
	},
	submit() {
		this.isProcessing = true;
	},
	validateReferences(event) {
		// count all non-empty lines
		const lineCount = (event.target.value.match(/^\s*\S/gm) || []).length;

		let error = "";
		if (lineCount < this.minimumProjects) {
			error = "Please provide at least " + this.minimumProjects + " links";
		}

		event.target.setCustomValidity(error);
	}
}).mount();
</script>
