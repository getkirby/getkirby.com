<div class="prose">
	<?= $section->teaser()->kt() ?>
	<?php if ($section->link()->isNotEmpty()): ?>
	<p><a href="<?= $section->link()->toUrl() ?>">Read more …</a></p>
	<?php endif ?>
</div>
