<?php layout() ?>

<div class="mb-36">
  <h1 class="h1 mb-12">Guide</h1>
  <ul class="guides auto-fill auto-rows-fr mb-12" style="--min: 16rem; --gap: var(--spacing-12)">
	<?php foreach ($page->children()->listed() as $guide): ?>
	<li>
	  <article>
		<a class="block" href="<?= $guide->url() ?>">
		  <figure class="mb-3" style="--size: 4rem">
			<?= $guide->images()->findBy('extension', 'svg')->read() ?>
		  </figure>
		  <div class="border-top pt-3">
			<h2 class="h2 mb-3"><?= $guide->title() ?></h2>
			<p class="color-gray-700"><?= $guide->description() ?></p>
		  </div>
		</a>
	  </article>
	</li>
	<?php endforeach ?>
  </ul>
</div>

<footer class="h2 max-w-xl">
  Travel back in time with our <a href="/docs/archive"><span class="link">docs archive</span> &rarr;</a>
</footer>
