<ul class="columns" style="--columns: 3">
  <?php foreach ($images as $filename): ?>
  <?php
  $image = page()->images()->findBy('name', $filename);
  $thumb = page()->images()->findBy('name', $filename . '-thumb') ?? $image;
  ?>
  <li>
    <a data-lightbox href="<?= $image->url() ?>">
      <figure class="text-sm">
        <p class="dimmed mb-3" style="--aspect-ratio: 1/1">
          <img
            loading="lazy"
            src="<?= $thumb->resize(200)->url() ?>"
            srcset="<?= $thumb->srcset([
              200 => '1x',
              400 => '2x'
            ])?>"
            alt="<?= $image->alt() ?>"
          />
        </p>
        <figcaption><?= $image->caption()->kt() ?></figcaption>
      </figure>
    </a>
  </li>
  <?php endforeach; ?>
</ul>
