<!DOCTYPE html>
<html lang="en">
<head>
	<?php snippet('layouts/head') ?>
</head>
<body>
	<?php snippet('layouts/header') ?>
	<main id="main" class="main">
		<?php if ($container = $slots->container()): ?>
			<?= $container ?>
		<?php else: ?>
			<div class="container">
				<?= $slot ?>
			</div>
		<?php endif ?>
	</main>
	<?php snippet('layouts/footer') ?>
</body>
</html>
