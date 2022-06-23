<section id="changes" class="mb-42">

  <?php snippet('hgroup', [
    'title' => 'Changelog',
    'mb'    => 12
  ]) ?>

  <div class="masonry" style="--columns: 2; --gap: var(--spacing-6)">
    <div class="rounded-xl highlight bg-light">
      <h3 class="h3 mb-6">Features</h3>
      <div class="prose text-sm">
        <?= $page->features()->kt() ?>
      </div>
    </div>

    <div class="rounded-xl highlight bg-light">
      <h3 class="h3 mb-6">Bug fixes</h3>
      <div class="prose text-sm">
        <?= $page->fixes()->kt() ?>
      </div>
    </div>

    <div class="rounded-xl highlight bg-light">
      <h3 class="h3 mb-6">Enhancements</h3>
      <div class="prose text-sm">
        <?= $page->enhancements()->kt() ?>
      </div>
    </div>

    <div class="rounded-xl highlight bg-light">
      <h3 class="h3 mb-6">Refactoring</h3>
      <div class="prose text-sm">
        <?= $page->refactoring()->kt() ?>
      </div>
    </div>

    <div class="rounded-xl highlight bg-light">
      <h3 class="h3 mb-6">Deprecated</h3>
      <div class="prose text-sm">
        <?= $page->deprecated()->kt() ?>
      </div>
    </div>

    <div class="highlight bg-light">
      <h3 class="h3 mb-6">Breaking changes</h3>
      <div class="prose text-sm">
        <?= $page->breaking()->kt() ?>
      </div>
    </div>

  </div>

</section>
