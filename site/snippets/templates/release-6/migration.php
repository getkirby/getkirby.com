<section id="migration" class="mb-42">

	<?php snippet('hgroup', [
		'title' => 'Migration from previous versions',
		'mb'    => 12
	]) ?>

	<div class="release-text-box" style="background: var(--color-light)">
		<div class="columns" style="--columns: 2; --gap: var(--spacing-24)">
			<div class="prose">
				<p>Kirby 6 is a major release and might require changes to existing sites. To ease the transition, we have compiled everything you need to know in a handy guide:</p>

				<p>
					<a href="<?= url('docs/guide/updates/update-to-v6') ?>">Migration guide →</a><br>
				</p>
			</div>

			<div class="prose">
				<?= kirbytext(
					'<info>' .
					'If you are not updating directly from Kirby 5 but an older version, please perform each major update step by step. ' .
					'Please refer to the changelogs of (link: releases/4 text: Kirby 4) and (link: releases/5 text: Kirby 5) for details.' .
					'</info>'
				) ?>
			</div>
		</div>
	</div>

</section>
