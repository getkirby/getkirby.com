<?php layout() ?>

<article class="max-w-xl mx-auto mb-42">
  <h1 class="h1 mb-24"><?= $page->title() ?></h1>
  <div class="prose">
	<?= $page->text()->kt() ?>
  </div>
</article>
