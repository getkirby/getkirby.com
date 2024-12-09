<div class="prose">
	<?= $section->teaser()->kt() ?>

	<?php if ($section->text()->isNotEmpty()): ?>
	<p><a href="<?= $section->url() ?>">Read more &rarr;</a></p>
	<?php elseif ($section->link()->isNotEmpty()): ?>
	<p><a href="<?= $section->link()->toUrl() ?>">Read more …</a></p>
	<?php endif ?>
</div>
