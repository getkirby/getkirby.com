<section id="gallery-block" class="mb-42">

  <?php snippet('hgroup', [
    'title'    => 'Better gallery block',
    'subtitle' => 'Artistic control for your images',
    'mb'       => 12
  ]) ?>

  <div class="columns mb-6" style="--columns: 3">

    <div class="release-text-box">
      <h3>Better settings</h3>
      <div class="prose">
        The gallery block features new ratio, crop and caption fields.
      </div>
    </div>

    <div class="release-box bg-light" style="--span: 2">
      <figure style="--aspect-ratio: 1591/1137">
        <img src="<?= $page->image('gallery-block-1.png')?->url() ?>" loading="lazy" alt="The card design shows the new rounded corners that have been introduced throughout the Panel">
      </figure>
    </div>

    <div class="release-box bg-light" style="--span: 2">
      <figure style="--aspect-ratio: 1874/694">
        <img src="<?= $page->image('gallery-block-2.png')?->url() ?>" loading="lazy" alt="The card design shows the new rounded corners that have been introduced throughout the Panel">
      </figure>
    </div>

    <div class="release-text-box">
      <h3>Better preview</h3>
      <div class="prose">
        The gallery block preview displays images according to the selected ratio for an even more realistic preview experience.
      </div>
    </div>
  </div>

</section>
