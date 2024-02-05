<dialog class="dialog" id="form">
	<form class="dialog-form" method="post" action="<?= $page->url() ?>" class="p-6 bg-light">
		<div class="field">
			<label class="label" for="name">Name <abbr title="Required">*</abbr></label>
			<input class="input" type="text" id="name" name="name" required>
		</div>
		<div class="field">
			<label class="label" for="business">Business</label>
			<input class="input" type="text" id="business" name="business" placeholder="Sleepy Kittens Inc.">
		</div>
		<div class="field">
			<label class="label" for="type">Type</label>
			<select class="input" id="type" name="type">
				<option>Freelancer</option>
				<option>Agency/Studio/Team</option>
			</select>
		</div>
		<div class="field">
			<label class="label" for="place">Located in <abbr title="Required">*</abbr></label>
			<div class="columns" style="--columns: 2; --gap: var(--spacing-1)">
				<input class="input" type="text" id="place" name="place" placeholder="Place" required>

				<select class="input" id="country" name="country" required>
					<option value="">Select a country …</option>
					<hr>
					<?php foreach ($countries as $countryCode => $countryName): ?>
					<option value="<?= $countryName ?>"><?= $countryName ?></option>
					<?php endforeach ?>
				</select>
			</div>
		</div>
		<div class="field">
			<label class="label">Interested in in</label>
			<div class="columns" style="--columns: 2; gap: var(--spacing-1)">
				<label class="checkbox">
					<input type="checkbox" name="interests[]" value="Meetups">
					Meetups
				</label>
				<label class="checkbox">
					<input type="checkbox" name="interests[]" value="Collaboration">
					Collaboration
				</label>
			</div>
		</div>
		<div class="field">
			<label class="label" for="expertise">Expertise</label>
			<textarea class="input" rows="5" id="expertise" name="expertise"></textarea>
		</div>
		<div class="field mb-6">
			<label class="label">Contact details</label>
			<div class="columns" style="--columns: 2; --gap: var(--spacing-1)">
				<input class="input" type="url" name="website" placeholder="https://">
				<input class="input" type="email" name="email" placeholder="you@mail.com">
				<input class="input" type="text" name="forum" placeholder="Forum account">
				<input class="input" type="text" name="github" placeholder="GitHub account">
				<input class="input" type="text" name="discord" placeholder="Discord account">
				<input class="input" type="text" name="mastodon" placeholder="@mastodon@account">
				<input class="input" type="text" name="instagram" placeholder="@instagram account">
				<input class="input" type="text" name="linkedin" placeholder="LinkedIn account">
			</div>
		</div>
		<div class="buttons">
			<button type="submit" name="submit" class="btn btn--filled">
				<?= icon('add') ?> Add me
			</button>
		</div>
	</form>
</dialog>

<style>
@import url("/assets/css/site/dialog.css");

.dialog {
	max-width: 40rem;
}
.dialog-form {
	padding: var(--spacing-6);
}

.dialog-form textarea.input {
	height: auto;
}

</style>

<script>
</script>
