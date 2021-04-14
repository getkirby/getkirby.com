<article>
  <header class="mb-3">
    <h2 class="h3"><?= $headline ?></h2>
  </header>
  <figure class="mb-3">
    <a href="<?= $image->url() ?>" data-lightbox>
      <img
        loading="lazy"
        src="<?= $image->resize(600)->url() ?>"
        srcset="<?= $image->srcset([
          600  => '1x',
          1200 => '2x'
        ]) ?>"
        alt="<?= $headline ?>"
      />
    </a>
  </figure>
  <div class="prose text-sm">
    <p><?= $text ?></p>
    <?php if (empty($link) === false): ?>
    <p><a href="<?= url($link) ?>">Learn more &rarr;</a></p>
    <?php endif ?>
  </div>
</article>
