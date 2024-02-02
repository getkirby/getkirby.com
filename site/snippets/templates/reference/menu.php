<div class="reference-menu">
  <button class="btn">
    <?= icon('dashboard') ?> Reference
  </button>

	<?php if ($page->hasEntries()): ?>
	<button class="btn">
		<?= icon('code') ?> <?= $page->parent()->title() ?>
	</button>
	<?php endif ?>

	<button class="btn hidden">
		<?= icon('cross') ?>Close
	</button>
</div>
