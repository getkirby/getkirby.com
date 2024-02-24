<dialog class="dialog" id="form">

	<?php if ($message && $message['type'] === 'success'): ?>
		<form class="dialog-form" method="dialog">
			<div class="text-base text-center">
				<h2 class="font-bold">Thank you for your submission 💛</h2>
				<p class="mb-6">We will review your entry and add it as soon as possible:</p>
				<p>
					<a href="<?= $message['pr'] ?>" target="_blank" class="btn btn--filled">
						<?= icon('bolt') ?>
						Track the progress
					</a>
				</p>
			</div>
		</form>
	<?php else: ?>

		<?php if ($message && $message['type'] === 'alert'): ?>
		<aside class="dialog-alert">
			<?= esc($message['text']) ?>
		</aside>
		<?php endif ?>

		<form class="dialog-form" method="post" action="<?= $page->url() ?>#add" class="p-6 bg-light">
			<div class="field">
				<label class="label" for="name">Name <abbr title="Required" aria-hidden>*</abbr></label>
				<input class="input" type="text" id="name" name="name" minlength="1" maxlength="100" required value="<?= esc($user['name']) ?>">
			</div>
			<div class="field">
				<div class="columns" style="--columns: 2; gap: var(--spacing-3)">
					<div>
						<label class="label" for="place">Place <abbr title="Required" aria-hidden>*</abbr></label>
						<input class="input" type="text" id="place" name="place" minlength="2" maxlength="100" placeholder="Gotham City" required value="<?= esc($user['place']) ?>">
					</div>
					<div>
						<label class="label" for="country">Country <abbr title="Required" aria-hidden>*</abbr></label>
						<input class="input" type="text" id="country" name="country" minlength="2" maxlength="100" placeholder="Narnia" required value="<?= esc($user['country']) ?>">
					</div>
				</div>
			</div>
			<div class="field">
				<label class="label" for="business">Organisation</label>
				<input class="input" type="text" id="business" minlength="2" maxlength="100" name="business" placeholder="Sleepy Kittens Inc." value="<?= esc($user['business']) ?>">
			</div>
			<fieldset class="field mb-6">
				<legend class="label">On the web</legend>
				<div class="columns" style="--columns: 2; --gap: var(--spacing-3)">
					<div>
						<label class="block mb-1 text-xs" for="forum">Forum</label>
						<input class="input" type="text" id="forum" name="forum" minlength="2" maxlength="32" placeholder="Username" value="<?= esc($user['forum']) ?>">
					</div>
					<div>
						<label class="block mb-1 text-xs" for="github">Github</label>
						<input class="input" type="text" id="github" name="github" minlength="2" maxlength="32" placeholder="Username" value="<?= esc($user['github']) ?>">
					</div>
					<div>
						<label class="block mb-1 text-xs" for="discord">Discord</label>
						<input class="input" type="text" id="discord" name="discord" minlength="2" maxlength="32" placeholder="Username" value="<?= esc($user['discord']) ?>">
					</div>
					<div>
						<label class="block mb-1 text-xs" for="mastodon">Mastodon</label>
						<input class="input" type="text" id="mastodon" name="mastodon" minlength="2" maxlength="100" placeholder="@username@mastodon.social" value="<?= esc($user['mastodon']) ?>">
					</div>
					<div>
						<label class="block mb-1 text-xs" for="instagram">Instagram</label>
						<input class="input" type="text" id="instagram" name="instagram" minlength="2" maxlength="32" placeholder="Username" value="<?= esc($user['instagram']) ?>">
					</div>
					<div>
						<label class="block mb-1 text-xs" for="linkedin">LinkedIn</label>
						<input class="input" type="text" id="linkedin" name="linkedin" minlength="2" maxlength="32" placeholder="Username" value="<?= esc($user['linkedin']) ?>">
					</div>
				</div>
			</fieldset>
			<div class="buttons">
				<button type="submit" class="btn btn--filled">
					<?= icon('add') ?> Add me
				</button>
			</div>
		</form>
	<?php endif ?>
</dialog>

<style>
@import url("/assets/css/site/dialog.css");

.dialog {
	max-width: 40rem;
}

.dialog-alert {
	padding: var(--spacing-3) var(--spacing-6);
	background: var(--color-red-400);
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

document.querySelector('#form').addEventListener('close', function () {
	history.replaceState(null, null, ' ');
});

if (window.location.hash === '#add') {
	document.querySelector('#form').showModal();
}
</script>
