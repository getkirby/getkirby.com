<!DOCTYPE html>
<html lang="en">
<head>
	<?php snippet('layouts/head') ?>
</head>
<body>
	<?php snippet('layouts/header') ?>
	<main id="main" class="main">
		<div class="container">
			<div class="with-sidebar">
				<article class="mb-24">

					<?php if ($header = $slots->header()): ?>
						<?= $header ?>
					<?php else: ?>
						<header>
							<h1 class="h1 mb-12"><?php slot('h1') ?><?= $page->title() ?><?php endslot() ?></h1>
							<?php if ($page->intro()->isNotEmpty()): ?>
							<div class="prose mb-12">
								<p class="intro">
									<?= $page->intro()->kti() ?>
								</p>
							</div>
							<?php endif ?>
						</header>
					<?php endif ?>
					<?php if ($screencast = $slots->screencast()): ?>
						<?= $screencast ?>
					<?php else: ?>
						<?php snippet('screencast') ?>
					<?php endif ?>

					<?php if ($toc = $slots->toc()): ?>
						<?= $toc ?>
					<?php else: ?>
						<?php snippet('toc') ?>
					<?php endif ?>

					<div class="prose mb-24">
						<?= $slot ?? $page->text()->kt() ?>
					</div>

					<?php if ($prevnext = $slots->prevnext()): ?>
						<?= $prevnext ?>
					<?php endif ?>

					<?php if ($footer = $slots->footer()): ?>
						<?= $footer ?>
					<?php else: ?>
						<footer>
							<?php snippet('layouts/github-edit') ?>
						</footer>
					<?php endif ?>

				</article>

				<?php if ($sidebar = $slots->sidebar()): ?>
					<?= $sidebar ?>
				<?php else: ?>
					<?php snippet('sidebar', [
						'title' => 'Kirby',
						'menu'  => collection('kirby')
					]) ?>
				<?php endif ?>
			</div>
		</div>
	</main>
	<?php snippet('layouts/footer') ?>
</body>
</html>
