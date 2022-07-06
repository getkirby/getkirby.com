<div class="columns pt-6" style="--columns: 4; --gap: var(--spacing-2)">
  <?php foreach ($page->children()->listed() as $feature): ?>
  <a class="flex items-center bg-white p-3 shadow text-sm" href="<?= $feature->url() ?>">
	<input type="checkbox" class="mr-3" checked><?= $feature->title() ?>
  </a>
  <?php endforeach ?>
</div>
