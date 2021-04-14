<?php if ($image = image('assets.png')): ?>
<figure>
  <a class="block" href="<?= $image->url() ?>" data-lightbox>
    <?= $image ?>
  </a>
</figure>
<?php endif ?>
