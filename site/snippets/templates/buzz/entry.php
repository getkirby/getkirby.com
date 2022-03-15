<?php if($entry->link()->isNotEmpty()): ?>
<a href="<?= $entry->link() ?>" class="buzz-entry mb-6 bg-black color-white grid">
<?php else: ?>
<article class="buzz-entry mb-6 bg-black color-white grid">
<?php endif ?>

  <header class="p-6">
    <span class="h6 block mb-3"><?= $entry->category() ?></span>
    <h2 class="h2 color-white mb-3"><?= $entry->title() ?></h2>
    <?php if($entry->text()->isNotEmpty()): ?>
    <p class="text-base color-gray-400"><?= $entry->text() ?></p>
    <?php endif ?>
  </header>

  <?php if(($img = $entry->image()) || $entry->video()->isNotEmpty()): ?>
  <figure style="--aspect-ratio: 1.91/1">
    <?php if($entry->video()->isNotEmpty()): ?>
    <?= video(str_replace('www.youtube.com', 'www.youtube-nocookie.com', $entry->video()), [
    'youtube' => [
      'controls'       => 0,
      'modestbranding' => 1,
      'showinfo'       => 0,
      'rel'            => 0,
    ]
  ], [
    'loading' => 'lazy'
  ]) ?>
    <?php else: ?>
    <?= $img->resize(896, 469) ?>
    <?php endif ?>
  </figure>
  <?php endif ?>

<?php if($entry->link()->isNotEmpty()): ?>
</a>
<?php else: ?>
</article>
<?php endif ?>
