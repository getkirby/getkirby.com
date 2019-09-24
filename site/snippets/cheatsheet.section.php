<ul class="cheatsheet-section-entries">
  <?php foreach ($section->children()->forCheatsheet() as $entry): ?>
  <li>
    <a href="<?= $entry->url() ?>">
      <?= $entry->title() ?>
      <?php if ($entry->intendedTemplate()->name() === 'endpoint'): ?>
        <div class="-mt:small">
          <span><?= $entry->info() ?></span>
          <small><?= $entry->excerpt()->kt() ?></small> 
        </div>
      <?php endif ?> 
    </a>
  </li>
  <?php endforeach ?>
</ul>
