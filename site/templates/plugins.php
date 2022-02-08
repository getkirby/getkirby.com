<?php layout('plugins') ?>

<h1 class="h1 mb-12"><?= $heading ?></h1>

<?php if (empty($currentCategory) === true) : ?>
  <?php snippet('templates/plugins/home') ?>
<?php else : ?>
  <?php $cards = $plugins->filter(fn ($page) => $page->images()->findBy('name', 'card')); ?>
  <?php if ($cards->count()): ?>
  <div class="mb-6">
    <?php snippet('templates/plugins/cards', ['plugins' => $cards, 'columns' => 3]) ?>
  </div>
  <?php endif ?>
  <?php snippet('templates/plugins/cardlets', ['plugins' => $plugins->not($cards), 'columns' => 2]) ?>
<?php endif ?>
