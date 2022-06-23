<section id="section-search" class="mb-42">
  <?php snippet('hgroup', [
    'title'    => 'New section search',
    'subtitle' => 'Filter pages and files',
    'mb'       => 12
  ]) ?>

  <div class="columns" style="--columns: 3; --gap: var(--spacing-6)">

    <div class="p-12 bg-white rounded-xl flex flex-column">
      <div class="prose text-lg">
        The new section search offers faster access to your pages and files. Long lists of articles or downloads can be filtered instantly now.
      </div>
    </div>

    <div class="bg-light pt-12 px-12 rounded-xl overflow-hidden grid items-end" style="grid-column: span 2; grid-row: span 2">
      <figure style="--aspect-ratio: 2062/1345">
        <img src="<?= ($image = $page->image('search.png'))->url() ?>" loading="lazy">
      </figure>
    </div>

    <div class="bg-black p-6 grid rounded-xl overflow-hidden">
      <?= $page->sectionSearch()->kt() ?>
    </div>
  </div>


</section>
