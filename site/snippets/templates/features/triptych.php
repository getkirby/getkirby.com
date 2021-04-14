<ul class="columns" style="--columns: 3; --gap: var(--spacing-12)">
  <?php foreach ($features as $feature): ?>
  <li>
    <article>
      <h2 class="h2 mb-6"><?= $feature['title'] ?></h2>
      <p class="text-lg leading-snug color-gray-700 mb-6"><?= $feature['text'] ?></p>
      <?= $feature['image'] ?? null ?>
    </article>
  </li>
  <?php endforeach ?>
</ul>
