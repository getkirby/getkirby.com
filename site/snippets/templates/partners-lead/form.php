<style>
.lead {
	background: var(--color-gray-200);
	box-shadow: var(--shadow-2xl);
	font-size: var(--text-sm);
}

.lead .btn {
	width: 100%;
}
.lead .btn :where(svg, strong) {
	color: var(--color-yellow-500);
}

.lead .columns > div {
	padding: var(--spacing-8);
	background: rgba(255,255,255, .5);
}

.lead .columns > div:last-child {
	background: rgba(200, 200, 200, .1);
}

[v-cloak] {
	display: none !important;
}
</style>

<div v-scope id="lead" class="lead bg-white rounded" @mounted="mounted">
	<form
		action="<?= $kirby->request()->url() ?>"
		method="POST"
		class="columns dialog-form"
		style="--columns: 2; --columns-md: 1; gap: 0"
		@submit="submit"
	>
		<input type="hidden" name="timestamp" :value="timestamp">

		<div>
			<fieldset class="checkout-fieldset">
				<legend>About yourself</legend>
				<div class="fields">
					<div class="field">
						<label class="label" for="name">
							Name <abbr title="Required" aria-hidden>*</abbr>
						</label>
						<input
							id="name"
							name="name"
							class="input"
							type="text"
							v-model="form.name"
							required
						>
					</div>

					<div class="field">
						<label class="label" for="email">
							Email <abbr title="Required" aria-hidden>*</abbr>
						</label>
						<input
							id="email"
							name="email"
							class="input"
							type="email"
							v-model="form.email"
							required
						>
					</div>

					<div class="field">
						<label class="label" for="customer">
							I am a … <abbr title="Required" aria-hidden>*</abbr>
						</label>
						<select
							id="customer"
							name="customer"
							class="input"
							v-model="form.customer"
							required
						>
							<option value="private">Private end user</option>
							<option value="small">Small business</option>
							<option value="mediumlarge">Medium to large business</option>
							<option value="agency">Agency looking for freelance support</option>
						</select>
					</div>

					<div v-if="isBusiness" class="field">
						<label class="label" for="company">
							Company <abbr title="Required" aria-hidden>*</abbr>
						</label>
						<input
							id="company"
							name="company"
							class="input"
							type="text"
							v-model="form.company"
							required
						>
					</div>
				</div>
				<span v-if="isBusiness" class="help">
					If you are a business, please disclose your company name.
				</span>
			</fieldset>

			<div class="checkout-field field">
				<label class="label" for="contact">
					Contact details
				</label>
				<textarea
					id="contact"
					name="contact"
					class="input"
					rows="2"
					v-model="form.contact"
					required
				></textarea>
				<span class="help">
					How do you want to be contacted? Please provide any additional contact details such as a phone number.
				</span>
			</div>

			<div class="checkout-field field">
				<label class="label" for="language">
					Language
				</label>
				<input
					id="language"
					name="language"
					class="input"
					type="text"
					v-model="form.language"
				>
				<span class="help">
					In which language(s) do you prefer to communicate?
				</span>
			</div>
		</div>

		<div
			class="flex flex-column justify-between"
		>
			<div class="mb-6">
				<div class="checkout-field field mb-6">
					<label class="label" for="project">
						Project description <abbr title="Required" aria-hidden="">*</abbr>
					</label>
					<textarea
						id="project"
						name="project"
						class="input"
						rows="4"
						v-model="form.project"
						required
					></textarea>
					<span class="help">
						Describe your project as detailed as possible.
					</span>
				</div>

				<fieldset class="checkout-fieldset">
					<legend>Project budget</legend>
					<div class="fields">
						<div class="field">
							<label class="label" for="budget">
								Status <abbr title="Required" aria-hidden>*</abbr>
							</label>
							<select
								id="budget"
								name="budget"
								class="input"
								v-model="form.budget"
								required
							>
								<option value="known">I already have a budget in mind</option>
								<option value="unknown">Help me determine what budget my project requires</option>
							</select>
						</div>

						<div
							v-if="form.budget === 'known'"
							class="field"
						>
							<label class="label" for="budget_available">
								Amount <abbr title="Required" aria-hidden>*</abbr>
							</label>
							<input
								id="budget_available"
								name="budget_available"
								class="input"
								type="text"
								v-model="form.budget_available"
								required
							>
						</div>
					</div>
					<p v-if="form.budget !== 'known'" class="help">
						Do you already have a budget in mind or would you like some help figuring out what your ideas could cost?
					</p>
					<p v-if="form.budget === 'known'" v-cloak class="help">
						What budget has been set for the project? Please also provide a currency.
					</p>
				</fieldset>

				<div class="checkout-field field mb-6">
					<label class="label" for="partner">
						Type of partner <abbr title="Required" aria-hidden="">*</abbr>
					</label>
					<input
						id="partner"
						name="partner"
						class="input"
						type="text"
						v-model="form.partner"
						required
					>
					<span class="help">
						Whether you prefer a freelancer, an agency, a developer or designer etc.
					</span>
				</div>
			</div>

			<button
				:disabled="isProcessing"
				type="submit"
				class="btn btn--filled"
			>
				<span v-if="isProcessing" v-cloak><?= icon('loader') ?></span>
				<span v-else><?= icon('email') ?></span>
				Post project
			</button>
		</div>
	</form>
</div>

<script type="module">
import {
	createApp,
	reactive
} from '<?= url('assets/js/libraries/petite-vue.js') ?>';

createApp({
	isProcessing: false,
	timestamp: "<?= $timestamp ?>",

	form: {
		name: "",
		email: "",
		customer: "",
		company: "",
		contact: "",

		project: "",
		partner: "",
		budget: "",
		budget_available: "",
		language: ""
	},

	get isBusiness() {
		return ["small", "mediumlarge", "agency"].includes(this.form.customer)
	},

	async mounted() {
		// stop checkout processing on unload
		window.addEventListener("pagehide", (e) => {
			this.isProcessing = false;
		});
	},
	submit() {
		this.isProcessing = true;
	}
}).mount();
</script>
