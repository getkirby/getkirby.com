<style>
.v6-auth-columns {
	display: grid;
	gap: var(--spacing-6);
	grid-template-areas:
		"teaser"
		"login"
		"register";
}

@media screen and (min-width: 64rem) {
	.v6-auth-columns {
		grid-template-columns: 1fr 1fr;
		grid-template-areas:
			"teaser register"
			"login register";
	}
}

.v6-auth-columns figure {
	display: grid;
	place-items: center;
	padding: var(--spacing-12);
}
</style>

<div class="v6-auth-columns">
	<div class="release-text-box" style="grid-area: teaser">
		<?php snippet('templates/release-4/teaser', ['section' => $section]) ?>
	</div>
	<figure class="release-box bg-light" style="grid-area: login">
		<?= img($section->image('passkey-login.png'), [
			'alt' => 'Panel login screen with a “Login with passkey” button above the password login',
			'src' => [
				'width' => 450
			],
			'lazy' => true,
			'srcset' => [
				450,
				900
			]
		]) ?>
	</figure>
	<figure class="release-box bg-dark" style="grid-area: register">
		<?= img($section->image('passkey-register.png'), [
			'alt' => 'Security drawer listing a registered passkey and a form to create a new one',
			'src' => [
				'width' => 434
			],
			'class' => 'shadow-xl rounded',
			'lazy' => true,
			'srcset' => [
				434,
				868
			]
		]) ?>
	</figure>
</div>
