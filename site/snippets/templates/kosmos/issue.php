<article>
  <a class="bg-black block leading-tight" href="<?= $issue->url() ?>">
    <figure>
      <p class="bg-black" style="--aspect-ratio: 16/9">
        <?= img($issue->image(), [
          'alt' => 'A preview of ' . $issue->title(),
          'src' => [
            'width' => 450
          ],
          'srcset' => [
            '1x' => 450,
            '2x' => 900,
          ]
        ]) ?>
      </p>
      <figcaption class="p-3 color-white">
        <h3 class="font-bold mb-1">Episode <?= $issue->slug() ?></h3>
        <date class="font-mono text-xs color-gray-500"><?= $issue->date()->toDate('d M Y') ?></date>
      </figcaption>
    </figure>
  </a>
</article>
