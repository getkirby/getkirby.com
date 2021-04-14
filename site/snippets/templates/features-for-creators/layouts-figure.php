<?php if ($image = image('layouts.png')): ?>
<figure>
  <a class="block" href="<?= $image->url() ?>" data-lightbox>
    <?= $image ?>
  </a>
</figure>
<?php endif ?>
