<?php $audiences = collection('audience')->filter('isActive', false)->limit(4) ?>
<div class="columns auto-rows-fr" style="--columns-md: 2; --columns: <?= $audiences->count() ?>; --gap: var(--spacing-12)">
  <?php foreach ($audiences as $audience): ?>
  <a class="block border-top pt-3" href="<?= $audience->url() ?>">
	<article>
	  <h3 class="h2 mb-3">
		<span class="mr-1"><?= $audience->for() ?></span>
		<span aria-hidden="true" class="font-thin">&rarr;</span>
	  </h3>
	  <p class="color-gray-700"><?= $audience->description()->widont() ?></p>
	</article>
  </a>
  <?php endforeach ?>
</div>
