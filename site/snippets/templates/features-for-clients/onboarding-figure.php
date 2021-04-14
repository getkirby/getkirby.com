<?php if ($image = image('company.jpg')): ?>
<figure>
  <a class="block" href="<?= $image->url() ?>" data-lightbox>
    <?= $image->html(['class' => 'shadow-2xl']) ?>
  </a>
</figure>
<?php endif ?>
