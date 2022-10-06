<section id="migration" class="mb-42">

  <?php snippet('hgroup', [
    'title' => 'Migration from Kirby 3.7.x',
    'mb'    => 12
  ]) ?>

  <div class="release-text-box" style="background: var(--color-light)">
    <div class="columns" style="--columns: 2; --gap: var(--spacing-24)">
      <div class="prose">
        <p>To ease the transition, we have compiled everything you need to know in detailed migration guides:</p>

        <p>
          <a href=" <?= url('releases/3.8/migration-sites') ?>">Migration guide for site developers →</a><br>
          <a href="<?= url('releases/3.8/migration-plugins') ?>">Migration guide for plugin developers →</a>
        </p>
      </div>

      <div class="prose">
        <?= kirbytext(
          '<info>' .
            'If you are updating from Kirby 3.6 or older, please first perform each major update step by step. ' .
            'Please refer to the changelogs of (link: releases/3.5 text: Kirby 3.5), (link: releases/3.6 text: Kirby 3.6) ' .
            'and (link: releases/3.7 text: Kirby 3.7) for details.' .
            '</info>'
        ) ?>
      </div>
    </div>
  </div>

</section>
