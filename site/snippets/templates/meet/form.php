<dialog id="form">
	<form method="post" action="<?= $page->url() ?>" class="p-6 bg-light">
		<div class="field">
			<label class="label">Name</label>
			<input class="input" type="text" name="name" required>
		</div>
		<div class="field">
			<label class="label">Business</label>
			<input class="input" type="text" name="business" placeholder="Sleepy Kittens Inc.">
		</div>
		<div class="field">
			<label class="label">Type</label>
			<div class="select">
				<select>
					<option>Freelancer</option>
					<option>Agency/Studio/Team</option>
				</select>
			</div>
		</div>
		<div class="field">
			<label class="label">Located in</label>
			<div class="columns" style="--columns: 2; --gap: var(--spacing-1)">
				<input class="input" type="text" name="place" placeholder="Place" required>
				<input class="input" type="text" name="country" placeholder="Country" required>
			</div>
		</div>
		<div class="field">
			<label class="label">Interested in in</label>
			<div class="checkbox">
				<label class="label"><input type="checkbox" name="interests" value="Meetups">Meetups</label>
				<label class="label"><input type="checkbox" name="interests" value="Collaboration">Collaboration</label>
			</div>
		</div>
		<div class="field">
			<label class="label">Expertise</label>
			<textarea name="expertise"></textarea>
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
		<input type="submit" name="submit" class="btn btn--filled" value="Add me">
	</form>
</dialog>

<style>
#form {
	width: 90%;
	max-width: 42rem;
}
</style>

<script>
</script>
