<article>
  <a class="bg-black block leading-tight" href="<?= $issue->url() ?>">
    <figure>
      <p class="bg-black" style="--aspect-ratio: 16/9">
        <?php if ($image = $issue->image()): ?>
        <img src="<?= $image->resize(500)->url() ?>" loading="lazy">
        <?php endif ?>
      </p>
      <figcaption class="p-3 color-white">
        <h3 class="font-bold mb-1">Episode <?= $issue->slug() ?></h3>
        <date class="font-mono text-xs color-gray-500"><?= $issue->date()->toDate('d M Y') ?></date>
      </figcaption>
    </figure>
  </a>
</article>
