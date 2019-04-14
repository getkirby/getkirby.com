<ul class="list recipe-cards">
  <?php foreach ($recipes as $recipe): ?>
  <li class="recipe-card">
    <a class="recipe-card-body" href="<?= $recipe->url() ?>">
      <h3 class="recipe-card-title">
        <span><?= $recipe->title() ?></span>

        <?php if ($recipe->published()->toDate('U') > (time() - 4500000)): ?>
        <code class="cookbook-new">New</code>
        <?php endif ?>
      </h3>

      <p class="recipe-card-description">
        <?= $recipe->description()->widont() ?>
      </p>
    </a>
    <footer class="recipe-card-footer">
      <?php foreach ($recipe->categories() as $category) : ?>
      <a href="<?= $category->url() ?>"><?= icon($category->icon()) ?>
      <?= $category->title() ?></a>
      <?php endforeach ?>
    </footer>
  </li>
  <?php endforeach ?>
</ul>
