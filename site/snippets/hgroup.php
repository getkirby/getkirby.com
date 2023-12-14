<header class="max-w-xl mb-<?= $mb ?? 6 ?>">
	<h2 class="h2"><?= widont($title) ?></h2>
	<?php if ($subtitle ?? null): ?>
	<p class="h2 color-gray-600"><?= widont($subtitle) ?></p>
	<?php endif ?>
</header>
