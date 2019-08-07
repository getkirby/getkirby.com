<ul class="cheatsheet-section-entries">
  <?php foreach ($section->children()->forCheatsheet() as $item): ?>
  <li>
    <?php snippet('cheatsheet.entry', [
      'item' => $item,
      'excerpt' => $excerpt ?? false,
    ]) ?>
  </li>
  <?php endforeach ?>
</ul>