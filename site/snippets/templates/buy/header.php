<header class="max-w-2xl mb-12">
	<h1 class="h1 mb-6">
		The transparency of <a href="<?= option('github.url') ?>">public&nbsp;code</a> meets a fair pricing&nbsp;model
	</h1>

	<?php if ($sale->isActive()): ?>
		<div class="h3 sale mb-3">
			<?= $sale->text() ?>
		</div>
	<?php endif ?>
</header>
