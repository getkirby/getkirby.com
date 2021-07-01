<div class="pt-6">
  <?php foreach ($page->children()->unlisted() as $feature): ?>
  <a class="block" href="<?= $feature->url() ?>">
    <input type="checkbox" class="mr-3"><?= $feature->title() ?>
  </a>
  <?php endforeach ?>
</div>
