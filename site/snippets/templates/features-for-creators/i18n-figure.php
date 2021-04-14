<?php if ($image = image('translations.png')): ?>
<figure class="mb-6">
  <a class="block" href="<?= $image->url() ?>" data-lightbox="i18n">
    <?= $image ?>
  </a>
</figure>
<?php endif ?>

<?php if ($image = image('languages.png')): ?>
<figure>
  <a class="block" href="<?= $image->url() ?>" data-lightbox="i18n">
    <?= $image ?>
  </a>
</figure>
<?php endif ?>
