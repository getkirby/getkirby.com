<section id="stats" class="mb-42">
  <?php snippet('hgroup', [
    'title'    => 'New stats section',
    'subtitle' => 'Turn your dashboard into a cool report',
    'mb'       => 12
  ]) ?>

  <div class="columns" style="--columns: 3; --gap: var(--spacing-6)">

    <figure class="bg-light rounded-xl overflow-hidden" style="--aspect-ratio: 2657/2248; grid-column: span 2; grid-row: span 2">
      <img src="<?= ($image = $page->image('stats.png'))->url() ?>" loading="lazy">
    </figure>

    <div class="p-12 bg-white rounded-xl flex flex-column">
      <h3 class="text-lg font-bold">Easy as 1-2-3</h3>
      <div class="prose text-lg">
        Show beautiful stats for your site or shop. Revenues, transactions, Twitter likes, page views… it’s totally up to you. Add as many reports to a stats section as you need. Customize reports using our query syntax, and easily integrate into page models or site methods.
      </div>
    </div>

    <div class="bg-black p-1 rounded-xl overflow-hidden">
      <?= $page->stats()->kt() ?>
    </div>
  </div>


</section>
