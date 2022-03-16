<?php if ($entry->link()->isNotEmpty()) : ?>
  <a href="<?= $entry->link() ?>" class="buzz-entry">
<?php else : ?>
  <article class="buzz-entry">
<?php endif ?>

    <figure class="rounded overflow-hidden mb-6 shadow-lg" style="--aspect-ratio: 800/400">
      <?php if ($entry->video()->isNotEmpty()) : ?>
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
      <?php elseif ($img = $entry->image()) : ?>
        <?= $img->resize(800, 400) ?>
      <?php else : ?>
      <?php endif ?>
    </figure>

    <header class="mb-12">
      <p class="font-mono text-xs mb-1"><?= $entry->category() ?></p>
      <h2 class="h3 mb-3"><?= $entry->title()->widont() ?></h2>
      <?php if ($entry->text()->isNotEmpty()) : ?>
        <p class="text-base color-gray-700"><?= $entry->text()->widont() ?></p>
      <?php endif ?>
    </header>

<?php if ($entry->link()->isNotEmpty()) : ?>
  </a>
<?php else : ?>
  </article>
<?php endif ?>
