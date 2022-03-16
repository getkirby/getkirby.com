<ul class="auto-fill auto-rows-fr" style="--min: 16rem; --column-gap: var(--spacing-12); --row-gap: var(--spacing-24)">
  <?php foreach ($recipes as $recipe): ?>
  <li>
    <article>
      <a class="block pt-1" href="<?= $recipe->url() ?>">
        <figure class="mb-3">
          <div class="mb-3">
            <p class="h6 mb-1 flex align-center justify-between">
              <?= $recipe->parent()->title() ?>
              <?php if ($recipe->isNew()): ?><span aria-hidden="true" style="color: var(--color-yellow-500)"><?= icon('flash') ?></span><?php endif ?>
            </p>
            <h2 class="h2 border-top pt-3">
              <?= $recipe->title() ?>
            </h2>
          </div>
        </figure>
        <p class="color-gray-700"><?= $recipe->description()->widont() ?></p>
      </a>
    </article>
  </li>
  <?php endforeach ?>
</ul>
