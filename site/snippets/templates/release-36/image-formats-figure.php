<div class="columns mb-6" style="--columns: 3">
  <figure>
    <img src="<?= ($image = $page->image('demo.jpg'))->url() ?>" loading="lazy">
    <figcaption class="font-mono text-sm pt-1">
      JPG <?= $image->niceSize() ?>
    </figcaption>
  </figure>
  <figure>
    <img src="<?= ($image = $page->image('demo.webp'))->url() ?>" loading="lazy">
    <figcaption class="font-mono text-sm pt-1">
      Webp <?= $image->niceSize() ?>
    </figcaption>
  </figure>
  <figure>
    <img src="<?= ($image = $page->image('demo.avif'))->url() ?>" loading="lazy">
    <figcaption class="font-mono text-sm pt-1">
      AVIF <?= $image->niceSize() ?>
    </figcaption>
  </figure>
</div>

<div class="pt-12">
  <?= $page->webp()->kt() ?>
</div>
