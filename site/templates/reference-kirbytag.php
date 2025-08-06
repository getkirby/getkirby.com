<?php layout('reference') ?>

<div class="prose">
	<?php if (count($attributes) > 0): ?>
	<h2 id="attributes"><a href="#attributes">Attributes</a></h2>
	<p>In addition to the main <code><?= $page->slug() ?></code>, option, the tag supports the following attributes:
		<?php foreach ($attributes as $attribute): ?>
		<code><?= $attribute ?></code>
		<?php endforeach ?>
	</p>
	<?php endif ?>

	<?= $page->text()->kt() ?>
</div>
