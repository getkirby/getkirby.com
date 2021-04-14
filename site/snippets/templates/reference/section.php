<ul class="reference-section mb-12 auto-fill" style="--min: 15rem; --row-gap: 0; --column-gap: var(--spacing-3)">
  <?php foreach ($item as $entry): ?>
  <li>
    <a href="<?= $entry->url() ?>" class="flex items-center">
      <?php snippet('templates/reference/entry/icon', ['entry' => $entry]) ?>
      <h3><?= $entry->title() ?></h3>
    </a>
  </li>
  <?php endforeach ?>
</ul>
