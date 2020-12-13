<ul class="v35-gallery">
  <?php foreach ($images as $filename): ?>
  <?php
  $image = page()->images()->findBy('name', $filename);
  $thumb = page()->images()->findBy('name', $filename . '-thumb') ?? $image;
  ?>
  <li>
    <a data-lightbox href="<?= $image->url() ?>">
      <figure>
        <span><?= $thumb ?></span>
        <figcaption><?= $image->caption()->kt() ?></figcaption>
      </figure>
    </a>
  </li>
  <?php endforeach; ?>
</ul>
