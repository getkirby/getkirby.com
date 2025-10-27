<header class="max-w-2xl mb-12">
	<h1 class="h1 mb-3">
		The transparency of <a href="<?= option('github.url') ?>">public&#8209;code</a> meets a fair pricing&nbsp;model
	</h1>

	<div class="mb-6">
		<a href="#revenue-limit" class="text-sm color-gray-600">
			&rarr; Which license type do I need?
		</a>
	</div>

	<?php if ($sale->isActive()): ?>
		<div class="h3 sale mb-3">
			<?= $sale->text() ?>
		</div>
	<?php endif ?>

</header>
