<div class="columns pt-6" style="--columns: 4; --gap: .75rem">
  <?php foreach ($page->children()->listed() as $feature): ?>
  <a class="block" href="<?= $feature->url() ?>">
    <input type="checkbox" class="mr-3" checked><?= $feature->title() ?>
  </a>
  <?php endforeach ?>
</div>
