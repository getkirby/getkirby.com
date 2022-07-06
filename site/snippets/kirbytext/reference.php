<nav class="auto-fill mb-12 text-sm" style="--min: 20rem; --gap: var(--spacing-1)">
  <?php foreach ($entries as $entry): ?>
  <a class="block p-3 bg-light" href="<?= $entry->url() ?>" style="text-decoration: none">
	<strong class="block"><?= $entry->title() ?></strong>
	<?= strip_tags($entry->intro()->kt()) ?>
  </a>
  <?php endforeach ?>
  </nav>
