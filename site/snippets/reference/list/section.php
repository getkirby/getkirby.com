<section class="-mb:large">
  <h3 id="<?= $section->slug() ?>">
    <a href="#<?= $section->slug() ?>">
      <?= $section->title() ?>
    </a>
  </h3>
  <?= $section->svg() ?>
  <ul class="cheatsheet-section-entries">
  <?php foreach ($section->children()->forCheatsheet() as $item): ?>
  <li>
    <?php snippet('reference/list/item', [
      'item'    => $item,
      'excerpt' => $excerpt ?? false,
    ]) ?>
  </li>
  <?php endforeach ?>
</ul>
</section>
