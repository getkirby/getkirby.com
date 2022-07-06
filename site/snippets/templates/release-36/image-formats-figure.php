<div class="columns mb-6" style="--columns: 3">
  <figure>
	<div class="bg-black" style="--aspect-ratio: 1024/1536">
	  <img src="<?= ($image = $page->image('demo.jpg'))->url() ?>" loading="lazy">
	</div>
	<figcaption class="font-mono text-sm pt-1">
	  JPEG <?= $image->niceSize() ?>
	</figcaption>
  </figure>
  <figure>
	<div class="bg-black" style="--aspect-ratio: 1024/1536">
	  <picture>
		<source srcset="<?= ($image = $page->image('demo.webp'))->url() ?>" loading="lazy" type="image/webp">
		<img src="<?= ($page->image('demo.jpg'))->url() ?>" loading="lazy">
	  </picture>
	</div>
	<figcaption class="font-mono text-sm pt-1">
	  WebP <?= $image->niceSize() ?>
	</figcaption>
  </figure>
  <figure>
	<div class="bg-black" style="--aspect-ratio: 1024/1536">
	  <picture>
		<source srcset="<?= ($image = $page->image('demo.avif'))->url() ?>" loading="lazy" type="image/avif">
		<img src="<?= ($page->image('demo.jpg'))->url() ?>" loading="lazy">
	  </picture>
	</div>
	<figcaption class="font-mono text-sm pt-1">
	  AVIF <?= $image->niceSize() ?>
	</figcaption>
  </figure>
</div>

<div class="pt-12">
  <?= $page->webp()->kt() ?>
</div>
