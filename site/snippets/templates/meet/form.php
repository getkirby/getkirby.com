<dialog class="dialog" id="form">
	<form class="dialog-form" method="post" action="<?= $page->url() ?>" class="p-6 bg-light">
		<div class="field">
			<label class="label" for="name">Name <abbr title="Required">*</abbr></label>
			<input class="input" type="text" id="name" name="name" minlength="1" maxlength="100" required>
		</div>
		<div class="field">
			<label class="label" for="place">Located in <abbr title="Required">*</abbr></label>
			<div class="columns" style="--columns: 2; --gap: var(--spacing-1)">
				<input class="input" type="text" id="place" name="place" minlength="2" maxlength="100" placeholder="Place" required>
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
			<label class="label" for="business">Business</label>
			<input class="input" type="text" id="business" minlength="2" maxlength="100" name="business" placeholder="Sleepy Kittens Inc.">
		</div>
		<div class="field mb-6">
			<label class="label">Contact details</label>
			<div class="columns" style="--columns: 2; --gap: var(--spacing-1)">
				<input class="input" type="text" name="forum" minlength="2" maxlength="32" placeholder="Forum account">
				<input class="input" type="text" name="github" minlength="2" maxlength="32" placeholder="GitHub account">
				<input class="input" type="text" name="discord" minlength="2" maxlength="32" placeholder="Discord account">
				<input class="input" type="text" name="mastodon" minlength="2" maxlength="100" placeholder="@mastodon@account">
				<input class="input" type="text" name="instagram" minlength="2" maxlength="32" placeholder="@instagram account">
				<input class="input" type="text" name="linkedin" minlength="2" maxlength="32" placeholder="LinkedIn account">
			</div>
		</div>
		<div class="buttons">
			<button type="submit" class="btn btn--filled">
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
document.querySelector('#form').addEventListener('click', function (event) {
	if (event.target === this) {
		this.close();
	}
});
</script>
