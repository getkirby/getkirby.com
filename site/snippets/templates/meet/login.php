<dialog class="dialog" id="login">
	<form class="dialog-form" method="dialog" class="p-6 bg-light">
		<div class="flex flex-column mb-6" style="gap: .5rem">
			<a href="<?= url('oauth/login/github') ?>" class="btn btn--filled">
				<?= icon('github') ?> Login via Github
			</a>
			<a href="<?= url('oauth/login/discord') ?>" type="submit" class="btn btn--filled">
				<?= icon('discord') ?> Login via Discord
			</a>
		</div>
		<p class="text-center">No account on those platforms? <a class="link whitespace-nowrap" href="mailto:mail@getkirby.com">Send us an email</a> and we'll add you.</p>
	</form>
</dialog>

<style>
@import url("/assets/css/site/dialog.css");

.dialog {
	max-width: 20rem;
}
.dialog-form {
	padding: var(--spacing-6);
}
</style>

<script>
document.querySelector('#login').addEventListener('click', function (event) {
	if (event.target === this) {
		this.close();
	}
});
</script>
