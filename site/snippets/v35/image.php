<figure>
  <a href="<?= $image->url() ?>" data-lightbox>
    <img src="<?= $image->url() ?>" class="<?= $class ?? null ?>">
    <?php if ($image->caption()->isNotEmpty()): ?>
    <figcaption class="text-sm color-gray-400 mt-3">
      <?= $image->caption() ?>
    </figcaption>
    <?php endif ?>
  </a>
</figure>
