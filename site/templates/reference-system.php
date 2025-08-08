<?php layout('reference') ?>

<div class="prose">
	<h2 id="example"><a href="#example">Example</a></h2>
	<?= $page->example()->kt() ?>

	<h2 id="custom-setup"><a href="#custom-setup">Custom setup</a></h2>
	<?= $page->setup()->kt() ?>

	<?= $page->text()->kt() ?>
</div>
