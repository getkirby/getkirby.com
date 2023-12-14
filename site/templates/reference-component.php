<?php layout('reference') ?>

<div class="prose">
	<?= $page->text()->kt() ?>

	<?php snippet('templates/reference/entry/parameters') ?>
	<?php snippet('templates/reference/entry/returns') ?>
</div>
