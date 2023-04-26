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
					<?php if ($hero = $slots->hero()): ?>
						<?= $hero ?>
					<?php else: ?>
						<header class="mb-12">
							<h1 class="h1"><?= $slots->h1() ?></h1>
						</header>
					<?php endif ?>
					<div class="mb-24">
						<?= $slot ?>
					</div>
					<footer>
						<?php snippet('layouts/github-edit') ?>
					</footer>
				</article>
				<?php if ($sidebar = $slots->sidebar()): ?>
					<?= $sidebar ?>
				<?php else: ?>
					<?php snippet('templates/cookbook/sidebar') ?>
				<?php endif ?>
			</div>
		</div>
	</main>
	<?php snippet('layouts/footer') ?>
</body>
</html>
