<div class="cheatsheet-grid">
  <?php foreach ($methods as $method): ?>
  <article class="cheatsheet-grid-item">
    <a href="<?= $method->url() ?>">
      <h3><?= $method->title() ?></h3>
      <?= $method->excerpt()->kt() ?>
    </a>
  </article>
  <?php endforeach ?>
</div>
