<div class="cheatsheet-grid">
  <?php foreach ($methods as $method): ?>
  <article class="cheatsheet-grid-item">
    <a href="<?= $method->url() ?>">
      <h4><?= $method->title() ?></h4>
      <?= $method->excerpt()->kt() ?>
    </a>
  </article>
  <?php endforeach ?>
</div>
