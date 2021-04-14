<ul class="plugins pt-1 auto-fill mb-24" style="--gap: var(--spacing-12); --row-gap: var(--spacing-6)">
  <?php foreach ($plugins as $plugin): ?>
  <li class="grid border-top">
    <figure class="iconbox bg-black color-white">
      <?= icon($plugin->icon()) ?>
    </figure>
    <a class="block" href="<?= $plugin->url() ?>">
      <h3 class="h4"><?= $plugin->title() ?></h3>
      <p class="text-sm color-gray-700">
        <?= $plugin->description()->widont() ?>
      </p>
    </a>
    <nav class="flex pt-1" style="--gap: var(--spacing-3)">
      <a href="<?= $plugin->download() ?>" class="iconbox bg-light"><?= icon('download') ?></a>

      <?php if ($plugin->repository()->isNotEmpty()): ?>
      <a class="iconbox bg-light" href="<?= $plugin->repository() ?>">
        <?= icon('github') ?>
      </a>
      <?php endif ?>
    </nav>
  </li>
  <?php endforeach ?>
</ul>
