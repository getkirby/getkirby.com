<?php if ($section = $page->find('changes/security')) : ?>
  <section id="enhancements" class="mb-42">

    <?php snippet('templates/features/intro', [
      'title' => 'Security',
    ]) ?>

    <div class="columns highlight bg-light" style="--columns: 2; --gap: var(--spacing-12)">
      <div>
        <h3 class="h3 mb-3">Headline A</h3>
        <div class="prose text-sm mb-12">
          <?= $section->panelUx()->kt() ?>
        </div>
      </div>

      <div>
        <h3 class="h3 mb-3">Headline B</h3>
        <div class="prose text-sm">
          <?= $section->core()->kt() ?>
        </div>
      </div>
    </div>

  </section>
<?php endif ?>
