<ul class="cheatsheet-section-entries">
  <?php foreach ($section->children()->listed() as $entry): ?>
  <li>
    <a href="<?= $entry->url() ?>">
      <?= $entry->title() ?>
    </a>
  </li>
  <?php endforeach ?>
</ul>
