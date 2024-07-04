<fieldset class="checkout-fieldset">
	<legend>Your business</legend>
	<div class="fields">
		<div class="field">
			<label class="label" for="website">
				Your website <abbr title="Required" aria-hidden>*</abbr>
			</label>
			<input
				id="website"
				name="website"
				class="input"
				type="url"
				v-model="form.website"
				placeholder="https://example.com"
				required
			>
		</div>

		<div class="field">
			<label class="label" for="address">
				Address <abbr title="Required" aria-hidden>*</abbr>
			</label>
			<input
				id="address"
				name="address"
				class="input"
				type="text"
				required
				v-model="form.address"
				placeholder="123 Sesame Street, New York, NY 10011, USA"
			>
		</div>

		<div class="field">
			<label class="label" for="projects">
				Projects <abbr title="Required" aria-hidden>*</abbr>
			</label>
			<input
				id="projects"
				name="projects"
				class="input"
				type="number"
				required
				:min="minimumProjects"
				v-model="form.projects"
				placeholder="42"
			>
		</div>
	</div>
	<span class="help">
		How many projects have you completed with Kirby? Can be approximate.
	</span>
</fieldset>

<div class="checkout-field field mb-6">
	<label class="label" for="references">
		Reference links <abbr title="Required" aria-hidden="">*</abbr>
	</label>
	<textarea
		id="references"
		name="references"
		class="input"
		:rows="minimumProjects + 1"
		required
		v-model="form.references"
		@input="validateReferences"
		placeholder="https://example.com"
	></textarea>
	<span class="help">
		Please provide at least {{ minimumProjects }} links, with your best project first.
	</span>
</div>

<div
	v-if="form.tier === 'certified'"
	class="checkout-field field mb-6"
>
	<label class="label" for="downloadLink">
		Download link to the review project
	</label>
	<input
		id="downloadLink"
		name="downloadLink"
		class="input"
		type="url"
		v-model="form.downloadLink"
		placeholder="https://download.example.com/my-review-project.zip"
	>
	<span class="help">
		Leave this field empty if you want to give us access to GitHub etc. or provide the project otherwise. We will get in touch with you to coordinate access to the project.
	</span>
</div>

<fieldset class="checkout-fieldset">
	<legend>Your contact information</legend>
	<div class="fields">
		<div class="field">
			<label class="label" for="name">
				Your name <abbr title="Required" aria-hidden>*</abbr>
			</label>
			<input
				id="name"
				name="name"
				class="input"
				type="text"
				required
				v-model="form.name"
				placeholder="Jane Doe"
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
				required
				v-model="form.email"
				placeholder="mail@example.com"
			>
		</div>
		<div class="field">
			<label class="label" for="discord">
				Discord name
			</label>
			<input
				id="discord"
				name="discord"
				class="input"
				type="text"
				v-model="form.discord"
				placeholder="janedoe"
			>
		</div>
	</div>
</fieldset>

<div class="checkout-field field mb-6">
	<label class="label" for="notes">
		Notes
	</label>
	<textarea
		id="notes"
		name="notes"
		class="input"
		rows="2"
		v-model="form.notes"
	></textarea>
</div>
