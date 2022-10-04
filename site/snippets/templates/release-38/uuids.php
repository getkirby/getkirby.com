<section id="uuids" class="mb-42">

  <?php snippet('hgroup', [
    'title'    => 'New Unique ID system',
    'subtitle' => 'For everlasting relationships',
    'mb'       => 12
  ]) ?>

  <figure class="release-box mb-6" style="--aspect-ratio: 1558/688">
    <img src="<?= $page->image('uuids.png')?->url() ?>" loading="lazy" alt="UUIDs">
  </figure>

  <div class="columns" style="--columns: 6">
    <div class="release-text-box" style="--span: 3">
      <h3>Reliability built-in</h3>
      <div class="prose">
        <?= $page->uuidsInfo()->kt() ?>
      </div>
    </div>
    <div class="release-text-box" style="--span: 3">
      <h3>Permalinks</h3>
      <div class="prose">
        <?= $page->uuidsPermalinks()->kt() ?>
      </div>
    </div>
    <div class="release-text-box" style="--span: 2">
      <h3>Updated picker fields</h3>
      <div class="prose">
        <?= $page->uuidsPickerFields()->kt() ?>
      </div>
    </div>

    <figure class="release-box" style="--aspect-ratio: 1123/682; --span: 4; grid-row: span 2">
      <img src="<?= $page->image('pickers.png')?->url() ?>" loading="lazy" alt="Updated picker fields">
    </figure>

    <div class="release-code-box" style="--span: 2">
      <?= $page->uuidsContentFile()->kt() ?>
    </div>

  </div>

</section>
