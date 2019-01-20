<ul class="cheatsheet-section-entries">
  <?php foreach ($section->children()->listed() as $entry): ?>
  <li>
    <a href="<?= $entry->url() ?>">
      <?= $entry->title() ?>

      <span><?= $entry->meta() ?></span>
    </a>
  </li>
  <?php endforeach ?>
</ul>
