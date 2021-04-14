<?php if ($image = image('blocks.png')): ?>
<figure>
  <a class="block" href="<?= $image->url() ?>" data-lightbox>
    <?= $image ?>
  </a>
</figure>
<?php endif ?>
