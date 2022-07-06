<ul class="plugins pt-1 auto-fill mb-24" style="--gap: var(--spacing-12); --row-gap: var(--spacing-6)">
  <?php foreach ($plugins as $plugin): ?>
  <li class="grid border-top">
	<figure class="iconbox bg-black color-white">
	  <a href="<?= $plugin->url() ?>"><?= icon($plugin->icon()) ?></a>
	</figure>
	<div>
	  <<?= $h = $headingLevel ?? 'h2' ?> class="h4">
		<a href="<?= $plugin->url() ?>">
		<?= $plugin->title() ?>
	  </<?= $h ?>>

	  <p class="mb-3">
		<a href="<?= $plugin->parent()->url() ?>" class="block font-mono text-xs color-gray-500">
		by <span class="color-black"><?= $plugin->parent()->title() ?></span>
		</a>
	  </p>

	  <p class="text-sm color-gray-700 mb-3">
		<?= $plugin->description()->widont() ?>
	  </p>
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
