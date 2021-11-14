<?php if ($section = $page->find('changes/panel')) : ?>
  <section id="panel" class="mb-42">

    <?php snippet('templates/features/intro', [
      'title' => $section->title(),
    ]) ?>

    <div class="columns highlight bg-light" style="--columns: 3; --gap: var(--spacing-12)">
      <div>
        <h3 class="h3 mb-3">Enhancements</h3>
        <div class="prose text-sm mb-12">
          <?= $section->panelUx()->kt() ?>
        </div>
      </div>

      <div>
        <h3 class="h3 mb-3">Bug fixes</h3>
        <div class="prose text-sm">
          <?= $section->core()->kt() ?>
        </div>
      </div>

      <div>
        <h3 class="h3 mb-3">Breaking changes</h3>
        <div class="prose text-sm">
          <?= $section->core()->kt() ?>
        </div>
      </div>
    </div>

  </section>
<?php endif ?>
