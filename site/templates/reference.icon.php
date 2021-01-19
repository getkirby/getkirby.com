<?php snippet('reference/entry/header') ?>
<?php snippet('reference/entry/meta') ?>

<?php snippet('toc', $page->text()->headlines('h2')) ?>

<div class="text">
  <?= $page->text()->kt()->anchorHeadlines() ?>

  <?php foreach ($colors as $color): ?>
  <section class="cheatsheet-icons" data-color="<?= strtolower($color) ?>">
    <h2 id="<?= $slug = Str::slug($color) ?>">
      <a href="#<?= $slug ?>">
        <?= $color ?>
      </a>
    </h2>
    <ul>
      <?php foreach ($sizes as $size): ?>
      <li>
        <h3><?= $size ?> px</h3>
        <figure>
          <svg class="cheatsheet-icon" data-size="<?= $size ?>">
            <use xlink:href="#icon-<?= $page->slug() ?>" />
          </svg>
        </figure>
      </li>
      <?php endforeach ?>
    </ul>
  </section>
  <?php endforeach ?>
</div>

<?php snippet('reference/entry/footer') ?>
