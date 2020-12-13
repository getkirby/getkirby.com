<article class="column grid" style="--columns: 12">
  <header class="column" style="--columns: 2">
    <h2 class="text-lg font-bold"><?= $headline ?></h2>
  </header>
  <div class="column" style="--columns: 6">
    <?php snippet('v35/image', [
      'image' => $image,
    ]) ?>
  </div>
  <div class="column text" style="--columns: 4">
    <p><?= $text ?></p>
  </div>
</article>
