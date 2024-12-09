<!DOCTYPE html>
<html lang="en">
<head>
	<?php snippet('layouts/head') ?>
</head>
<body>
	<?php snippet('layouts/header') ?>

	<?php if ($icons = $page->file('icons.svg')): ?>
	<div class="hidden">
		<?= $icons->read() ?>
	</div>
	<?php endif ?>

	<main id="main" class="main">
		<div class="container">
			<div class="with-sidebar">
				<?php if ($sidebar = $slots->sidebar()): ?>
					<?= $sidebar ?>
				<?php else: ?>
					<?php snippet('sidebar', [
						'title' => 'Kirby',
						'menu'  => collection('kirby')
					]) ?>
				<?php endif ?>

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

					<?php if ($content = $slots->content()): ?>
						<?= $content ?>
					<?php else: ?>
						<?php if ($toc = $slots->toc()): ?>
							<?= $toc ?>
						<?php else: ?>
							<?php snippet('toc') ?>
						<?php endif ?>

						<div class="prose mb-24">
							<?= $slot ?? $page->text()->kt() ?>
						</div>
					<?php endif ?>

					<?php if ($footer = $slots->footer()): ?>
						<?= $footer ?>
					<?php else: ?>
						<footer>
							<?php snippet('layouts/github-edit') ?>
						</footer>
					<?php endif ?>
				</article>
			</div>
		</div>
	</main>
	<?php snippet('layouts/footer') ?>
</body>
</html>
