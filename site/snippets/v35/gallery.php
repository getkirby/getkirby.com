<ul class="v35-gallery">
  <?php foreach ($images as $filename): ?>
  <?php
  $image = page()->images()->findBy('name', $filename);
  $thumb = page()->images()->findBy('name', $filename . '-thumb') ?? $image;
  ?>
  <li>
    <a data-lightbox href="<?= $image->url() ?>">
      <figure>
        <span>
          <img
            loading="lazy"
            class="shadow"
            src="<?= $thumb->resize(200)->url() ?>"
            srcset="<?= $thumb->srcset([
              200 => '1x',
              400 => '2x'
            ])?>"
            alt="<?= $image->alt() ?>"
          />
          <?= $thumb ?>
        </span>
        <figcaption><?= $image->caption()->kt() ?></figcaption>
      </figure>
    </a>
  </li>
  <?php endforeach; ?>
</ul>
