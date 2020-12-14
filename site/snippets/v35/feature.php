<article class="column grid" style="--columns: 12">
  <header class="column" style="--columns: 2">
    <h2 class="text-lg font-bold"><?= $headline ?></h2>
  </header>
  <div class="column" style="--columns: 6">
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
  </div>
  <div class="column text" style="--columns: 4">
    <p><?= $text ?></p>

    <?php if (empty($link) === false): ?>
    <p><a class="btn-link text-base" href="<?= url($link) ?>">Learn more</a></p>
    <?php endif ?>

  </div>
</article>
