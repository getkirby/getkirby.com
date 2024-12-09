<style>
.v4-totp-columns {
	display: grid;
	gap: var(--spacing-6);
	grid-template-areas:
		"screenshot"
		"teaser"
		"qrcode"
}

@media screen and (min-width: 32rem) {
	.v4-totp-columns {
		grid-template-columns: 3fr 2fr;
		grid-template-areas:
			"screenshot screenshot"
			"teaser qrcode"
	}
}

@media screen and (min-width: 70rem) {
	.v4-totp-columns {
		grid-template-columns: 2fr 1fr;
		grid-template-areas:
			"screenshot teaser"
			"screenshot qrcode"
	}
}
</style>

<div class="v4-totp-columns">
	<div class="release-text-box" style="grid-area: teaser">
		<?php snippet('templates/release-4/teaser', ['section' => $section]) ?>
	</div>

	<figure class="release-box color-white grid place-items-center" style="grid-area: screenshot">
		<?php snippet('templates/release-4/image', [
			'alt'   => 'Time-based one-time passwords in Kirby 4',
			'img'   => $section->image('totp.png')->resize(1500),
			'class' => 'rounded shadow-xl'
		]) ?>
	</figure>

	<div class="release-code-box p-6 bg-light" style="grid-area: qrcode">
		<?= $section->totpExample()->kt() ?>
	</div>
</div>
