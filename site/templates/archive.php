<?php layout() ?>

<article>

	<header class="mb-24">
		<h1 class="h1">
			Travel back in time
		</h1>
	</header>

	<ul class="columns items-center" style="--columns-sm: 1; --columns-md: 1; --columns-lg: 3; --gap: var(--spacing-12)">
		 <?php foreach ($versions as $version): ?>
		<li>
			<article class="<?= $version === $versions[0] ? 'p-6 bg-white shadow-2xl' : '' ?>">
				<header class="mb-3">
					<p class="h6 mb-1"><?= $version['since'] ?></p>
					<h2 class="h2 border-top pt-3"><?= $version['title'] ?></h2>
				</header>
				<div class="color-gray-700 mb-12">
					<p><?= $version['title'] . ' ' . ($version['description'] ?? null) ?> </p>
				</div>
				<div class="columns" style="--columns: 2">
					<a aria-label="Visit the <?= $version['title'] ?> docs" href="<?= $version['link'] ?>" class="btn <?= $version === end($versions) ? 'btn--filled' : 'btn--outlined' ?>">
						<?= icon('book') ?>
						Docs
					</a>
					<a aria-label="The Kirby <?= $version['mainVersion'] ?> repository on GitHub" href="<?= $version['repo'] ?>" class="btn <?= $version === end($versions) ? 'btn--filled' : 'btn--outlined' ?>">
						<?= icon('github') ?>
						Source
					</a>
				</div>
			</article>
		</li>
		<?php endforeach ?>
	</ul>

</article>
