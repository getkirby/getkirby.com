<?php layout('reference') ?>

<div class="prose">
  <?= $page->text()->kt() ?>
</div>

<?php foreach ($colors as $color): ?>
<section class="mb-12">
  <h2 class="h3 mb-1" id="<?= $slug = Str::slug($color) ?>">
    <a href="#<?= $slug ?>">
      <?= $color ?>
    </a>
  </h2>
  <ul class="columns" style="--columns: 3">
    <?php foreach ($sizes as $size): ?>
    <li>
      <h3 class="font-mono mb-1"><?= $size ?> px</h3>
      <figure class="grid place-items-center icon rounded" data-bg="<?= strtolower($color) ?>">
        <svg data-size="<?= $size ?>">
          <use xlink:href="#icon-<?= $page->slug() ?>" />
        </svg>
      </figure>
    </li>
    <?php endforeach ?>
  </ul>
</section>
<?php endforeach ?>

<style>
figure.icon {
  height: 12rem;
  background: var(--color-light);
}
figure.icon[data-bg="white"] {
  fill: var(--color-white);
  background: var(--color-black);
}
svg[data-size="16"] {
  width: 1rem;
  height: 1rem;
}
svg[data-size="32"] {
  width: 2rem;
  height: 2rem;
}
svg[data-size="64"] {
  width: 4rem;
  height: 4rem;
}
</style>
