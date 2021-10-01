<ul class="plugins pt-1 auto-fill mb-24" style="--gap: var(--spacing-12); --row-gap: var(--spacing-6)">
  <?php foreach ($plugins as $plugin): ?>
  <li class="grid border-top">
    <figure class="iconbox bg-black color-white">
      <?= icon($plugin->icon()) ?>
    </figure>
    <div>
      <a class="block mb-3" href="<?= $plugin->url() ?>">
        <<?= $h = $headingLevel ?? 'h2' ?> class="h4"><?= $plugin->title() ?></<?= $h ?>>
        <p class="text-sm color-gray-700">
          <?= $plugin->description()->widont() ?>
        </p>
      </a>
      <?php if ($page->is($plugin->parent()) === false): ?>
      <a href="<?= $plugin->parent()->url() ?>" class="plugin-author">
        <?= icon('user') ?> <?= $plugin->parent()->title() ?>
      </a>
      <?php endif ?>
    </div>
    <div class="flex pt-1" style="--gap: var(--spacing-3)">
      <a aria-label="Download the <?= $plugin->title() ?> plugin" href="<?= $plugin->download() ?>" class="iconbox bg-light"><?= icon('download') ?></a>

      <?php if ($plugin->repository()->isNotEmpty()): ?>
      <a aria-label="Github repository of the <?= $plugin->title() ?> plugin" class="iconbox bg-light" href="<?= $plugin->repository() ?>">
        <?= icon('github') ?>
      </a>
      <?php endif ?>
    </div>
  </li>
  <?php endforeach ?>
</ul>
