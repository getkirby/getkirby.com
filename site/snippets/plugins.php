<ul class="list plugin-cards <?php e(@$class, ' ' . @$class) ?>">
  <?php foreach ($plugins as $plugin): ?>
  <li class="plugin-card" data-filter="<?= htmlspecialchars($plugin->title()) ?> <?= htmlspecialchars($plugin->title()) ?> <?= htmlspecialchars($plugin->parent()->title()) ?>">
    <a class="plugin-card-body" href="<?= $plugin->url() ?>">
      <h3 class="plugin-card-title"><?= $plugin->title() ?></h3>
      <p class="plugin-card-author">by <?= $plugin->parent()->title() ?></p>
      <p class="plugin-card-description">
        <?= $plugin->description()->widont() ?>
      </p>
    </a>
    <footer class="plugin-card-footer">
      <?php if ($category = option('plugins.categories.' . $plugin->category())): ?>
      <a href="<?= url('plugins?category=' . $plugin->category()) ?>"><?= icon($category['icon']) ?> <?= $category['label'] ?></a>
      <?php endif ?>
    </footer>
  </li>
  <?php endforeach ?>
</ul>
