<?php layout('reference') ?>

<?php foreach ($page->children()->unlisted() as $package): ?>
<div class="mb-24">
  <h2 class="h2 mb-3" id="<?= $package->slug() ?>"><?= $package->title() ?></h2>
  <?php snippet('templates/reference/section', $package->children()->listed()) ?>
</div>
<?php endforeach ?>
