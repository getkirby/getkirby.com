<section id="migration" class="mb-42">

	<?php snippet('hgroup', [
		'title' => 'Migration from previous versions',
		'mb'    => 12
	]) ?>

	<div class="release-text-box" style="background: var(--color-light)">
		<div class="columns" style="--columns: 2; --gap: var(--spacing-24)">
			<div class="prose">
				<p>Kirby 5 is a major release and requires some changes to existing sites. To ease the transition, we have compiled everything you need to know in a handy guide:</p>

				<p>
					<a href="<?= url('docs/guide/updates/update-to-v5') ?>">Migration guide →</a><br>
				</p>
			</div>

			<div class="prose">
				<?= kirbytext(
					'<info>' .
								'If you are not updating directly from Kirby 4.x but an older version, please first perform each major update step by step. ' .
								'Please refer to the changelogs of (link: releases/3.5 text: Kirby 3.5), (link: releases/3.6 text: Kirby 3.6), ' .
								'(link: releases/3.7 text: Kirby 3.7), (link: releases/3.8 text: Kirby 3.8), (link: releases/3.9 text: Kirby 3.9) and (link: docs/guide/updates/update-to-v4 text: Kirby 4.0) for details.' .
								'</info>'
				) ?>
			</div>
		</div>
	</div>

</section>
