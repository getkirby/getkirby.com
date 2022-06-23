<section id="table-layout" class="mb-42">

  <?php snippet('hgroup', [
    'title'    => 'New table layout',
    'subtitle' => 'Who said spreadsheets cannot be cool?',
    'mb'       => 12
  ]) ?>

  <div class="columns" style="--columns: 2; --gap: var(--spacing-6)">

    <figure class="bg-light rounded-xl overflow-hidden" style="--aspect-ratio: 2633/805; --span: 2">
      <img src="<?= ($image = $page->image('table.png'))->url() ?>" loading="lazy">
    </figure>

    <div class="p-12 bg-white rounded-xl">
      <h3 class="text-xl font-bold">At a glance</h3>
      <div class="prose">
        Keep better overview of your pages and files with the brand new table layout. Define custom columns to customize the way you present your data.
      </div>
    </div>
    <div class="bg-black p-1 rounded-xl overflow-hidden">
      <?= $page->table()->kt() ?>
    </div>
  </div>

</section>
