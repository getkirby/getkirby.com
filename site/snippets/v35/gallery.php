<ul class="v35-gallery">
  <?php foreach ($images as $image): ?>
  <li>
    <a data-lightbox href="<?= $image->url() ?>">
      <figure>
        <span><?= $image ?></span>
        <figcaption>Perfect HTML</figcaption>
      </figure>
    </a>
  </li>
  <?php endforeach; ?>
</ul>
