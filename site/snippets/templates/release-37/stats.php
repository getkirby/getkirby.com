<style>
.v37-stats-grid {
  display: grid;
  grid-gap: var(--spacing-6);
  grid-template-columns: 1fr;
  grid-template-areas: "figure"
                       "box1"
                       "box2";
}

@media screen and (min-width: 45rem) {
  .v37-stats-grid {
    grid-template-columns: 1fr 1fr;
    grid-template-areas: "figure figure"
                        "box1 box2";
  }
}

@media screen and (min-width: 90rem) {
  .v37-stats-grid {
    grid-template-columns: 1fr 1fr 1fr;
    grid-template-areas: "figure figure box1"
                        "figure figure box2";
  }
}
</style>

<section id="stats" class="mb-42">
  <?php snippet('hgroup', [
    'title'    => 'New stats section',
    'subtitle' => 'Turn your dashboard into a smart report',
    'mb'       => 12
  ]) ?>

  <div class="v37-stats-grid">
    <figure class="release-box bg-light" style="--aspect-ratio: 2657/2248; grid-area: figure">
      <img src="<?= ($image = $page->image('stats.png'))->url() ?>" loading="lazy" alt="The stats section is used here for a shop site to show revenue, number of orders, average transaction price, refunds and discounted sales.">
    </figure>

    <div class="release-text-box" style="grid-area: box1">
      <h3>Easy as 1-2-3</h3>
      <div class="prose">
        Show beautiful stats for your site or shop. Revenue, transactions, Twitter likes, page views… it’s totally up to you. Add as many reports to a stats section as you need. Customize reports using our query syntax, and easily integrate into page models or site methods.
      </div>
    </div>

    <div class="release-code-box" style="grid-area: box2">
      <?= $page->stats()->kt() ?>
    </div>
  </div>
</section>
