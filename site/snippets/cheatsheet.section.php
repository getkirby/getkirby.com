<ul class="cheatsheet-section-entries">
  <?php foreach ($section->children()->forCheatsheet() as $entry): ?>
  <li>
    <a href="<?= $entry->cheatsheetUrl() ?>">
      <?= $entry->title() ?>
    </a>
  </li>
  <?php endforeach ?>
</ul>
