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
.signup .radios[data-view="details"] {
	opacity: 0.5;
	pointer-events: none;
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

.partner-listing-static {
	background: var(--color-white);
	padding: var(--spacing-3);
}

.signup .benefits li,
.signup .requirements li {
	display: flex;
	align-items: baseline;
	gap: var(--spacing-2);
}
.signup .benefits li .icon,
.signup .requirements li .icon {
	flex-shrink: 0;
	height: 1em;
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
	<form
		action="<?= url('partners/join') ?>"
		method="POST"
		@submit="submit"
		class="columns dialog-form"
		style="--columns: 2; gap: 0"
	>
		<div>
			<fieldset class="mb-6">
				<legend class="label">Partnership</legend>
				<div class="radios" :data-view="view">
					<label>
						<input
							type="radio"
							name="tier"
							v-model="personalInfo.tier"
							value="regular"
							:disabled="view === 'details' && personalInfo.tier !== 'regular'"
						/>
						Regular partner
					</label>
					<label>
						<input
							type="radio"
							name="tier"
							v-model="personalInfo.tier"
							value="certified"
							:disabled="view === 'details' && personalInfo.tier !== 'certified'"
							checked
						/>
						Certified partner
					</label>
				</div>
			</fieldset>

			<fieldset class="mb-6">
				<legend class="label">How many people are in your company?</legend>
				<div class="radios" :data-view="view">
					<label>
						<input
							type="radio"
							name="people"
							v-model="personalInfo.people"
							value="1"
							:disabled="view === 'details' && personalInfo.people !== '1'"
							checked
						/>
						1
					</label>
					<label>
						<input
							type="radio"
							name="people"
							v-model="personalInfo.people"
							value="2"
							:disabled="view === 'details' && personalInfo.people !== '2'"
						/>
						2
					</label>
					<label>
						<input
							type="radio"
							name="people"
							v-model="personalInfo.people"
							value="3"
							:disabled="view === 'details' && personalInfo.people !== '3'"
						/>
						3
					</label>
					<label>
						<input
							type="radio"
							name="people"
							v-model="personalInfo.people"
							value="4+"
							:disabled="view === 'details' && personalInfo.people !== '4+'"
						/>
						4+
					</label>
				</div>
			</fieldset>

			<section>
				<h3 class="label">Your listing</h3>

				<div class="rounded bg-light" style="padding: 2px">
					<?php if ($renew): ?>
					<article class="partner-listing-static" v-if="personalInfo.tier === 'certified'">
					<?php snippet('templates/partners/partner.certified', ['partner' => $renew, 'placeholder' => true, 'lazy' => false]) ?>
					</article>
					<article class="partner-listing-static" v-else v-cloak>
					<?php snippet('templates/partners/partner', ['partner' => $renew, 'placeholder' => true]) ?>
					</article>
					<?php else: ?>
					<?php snippet('templates/partners-signup/preview') ?>
					<?php endif ?>
				</div>
			</section>
		</div>

		<div
			v-if="view === 'info'"
			class="flex flex-column justify-between right-column"
		>
			<div>
				<?php snippet('templates/partners-signup/info') ?>
			</div>

			<button
				v-if="renew"
				:disabled="isProcessing"
				type="submit"
				class="btn btn--filled"
			>
				<span v-if="isProcessing" v-cloak><?= icon('loader') ?></span>
				<span v-else><?= icon('verified') ?></span>
				Renew now
			</button>
			<button
				v-else
				type="button"
				class="btn btn--filled" @click="switchToDetails"
			>
				<?= icon('icon-arrow') ?> Apply now
			</button>
		</div>

		<div
			v-if="view === 'details'"
			v-cloak
			class="flex flex-column justify-between right-column"
		>
			<?php snippet('templates/partners-signup/form') ?>

			<div class="submit-buttons">
				<button
					type="button"
					class="btn btn--outlined back-button"
					@click="view = 'info'"
				>
					Back
				</button>

				<input type="hidden" name="timestamp" :value="locale.timestamp">
				<button
					:disabled="isProcessing"
					type="submit"
					class="btn btn--filled"
				>
					<span v-if="isProcessing" v-cloak><?= icon('loader') ?></span>
					<span v-else><?= icon('verified') ?></span>
					Submit application
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
		timestamp: "",
	},

	// user-generated props
	personalInfo: {
		// plan
		people: "<?= $people ?? '1' ?>",
		tier: "certified",

		// listing fields
		businessName: "",
		businessType: "",
		location: "",
		summary: "",

		// business info
		website: "",
		address: "",
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
	renew: <?= $renew ? 'true' : 'false' ?>,
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
	switchToDetails() {
		this.view = "details";

		// wait for the next tick
		setTimeout(() => {
			// (re)validate the references field when switching back and forth
			this.validateReferences();

			// focus the first invalid field
			for (const input of document.querySelector(".dialog-form").elements) {
				if (input.checkValidity() !== true) {
					input.focus();
					return;
				}
			}
		}, 0);
	},
	validateReferences() {
		const input = document.getElementById("references");

		// count all non-empty lines
		const lineCount = (input.value.match(/^\s*\S/gm) || []).length;

		let error = "";
		if (lineCount < this.minimumProjects) {
			error = "Please provide at least " + this.minimumProjects + " links";
		}

		input.setCustomValidity(error);
	}
}).mount();
</script>
