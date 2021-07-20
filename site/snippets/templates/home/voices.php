<section id="voices" class="mb-42">
  <h2 class="h2 mb-12">What our customers say</h2>
  <ul class="columns" style="--columns-md: 2; --columns: 4; --gap: var(--spacing-12)">
    <?php foreach(collection('voices/home') as $voice): ?>
    <li>
      <?php snippet('voice', ['voice' => $voice]) ?>
    </li>
    <?php endforeach ?>
  </ul>
</section>
