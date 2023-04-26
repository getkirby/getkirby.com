<?php layout() ?>

<div class="mb-36">
  <h1 class="h1 mb-12">Guide</h1>
	<?php $categories = $page->children()->listed()->pluck('category', ',', true);
	?>
	<?php foreach ($categories as $category): ?>
	<h2 class="h2 mb-12" style="font-size: var(--text-4xl)"><?= $category ?></h2>
  <ul class="guides auto-fill auto-rows-fr mb-24" style="--min: 16rem; --gap: var(--spacing-12)">
    <?php $filtered = $page->children()->filterBy('category', '==', $category);
		foreach ($filtered as $guide): ?>
    <li>
      <article>
        <a class="block" href="<?= $guide->url() ?>">
          <?php if ($svg = $guide->images()->findBy('extension', 'svg')): ?>
            <figure class="mb-3" style="--size: 4rem">
              <?= $svg->read() ?>
            </figure>
          <?php endif ?>
          <div class="border-top pt-3">
            <h3 class="h2 mb-3"><?= $guide->title() ?></h3>
            <p class="color-gray-700"><?= $guide->description() ?></p>
          </div>
        </a>
      </article>
    </li>
    <?php endforeach ?>
  </ul>
	<?php endforeach ?>
</div>

<footer class="h2 max-w-xl">
  Travel back in time with our <a href="/docs/archive"><span class="link">docs archive</span> &rarr;</a>
</footer>
