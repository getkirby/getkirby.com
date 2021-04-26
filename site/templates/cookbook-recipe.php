<?php layout('cookbook') ?>

<?php slot('h1') ?>
<?= $page->title()->widont() ?>
<?php endslot() ?>

<?php slot() ?>

  <?php snippet('toc', ['title' => 'In this recipe']) ?>
  <div class="prose mb-24">
    <?= $page->text()->kt() ?>
  </div>

  <?php if ($authors->count()): ?>
  <section id="authors">
    <header class="prose mb-6">
      <h2><?= $authors->count() > 1 ? 'Authors' : 'Author' ?></h2>
    </header>
    <ul class="auto-fill" style="--min: 12rem; --max: 14rem">
      <?php foreach ($authors as $author): ?>
      <li>
        <a class="block bg-white p-6 shadow-2xl" href="<?= $author->website() ?>">
          <figure>
            <p class="mb-3" style="--aspect-ratio: 1/1"><?= $author->image()->crop(400) ?></p>
            <figcaption class="flex-grow text-sm leading-tight">
              <p class="font-bold"><?= $author->title() ?></p>
              <p class="mb-6 color-gray-700"><?= $author->bio() ?></p>
              <p class="font-mono link"><?= $author->website()->shortUrl() ?></p>
            </figcaption>
          </figure>
        </a>
      </li>
      <?php endforeach ?>
    </ul>
  </section>
  <?php endif ?>

<?php endslot() ?>

