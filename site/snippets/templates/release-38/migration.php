<section id="migration" class="mb-42">

  <?php snippet('hgroup', [
    'title' => 'Migration from Kirby 3.7.x',
    'mb'    => 12
  ]) ?>

  <div class="release-padded-box bg-light prose">
    <p>To ease the transition, we have compiled everything you need to know in detailed migration guides:</p>

    <p>
      <a href="<?= url('releases/3.8/migration-sites') ?>">Migration guide for site developers →</a><br>
      <a href="<?= url('releases/3.8/migration-plugins') ?>">Migration guide for plugin developers →</a>
    </p>
    
    <?= kirbytext(
      '<info>' .
      'If you are updating from Kirby 3.6 or older, please first perform each major update step by step. ' .
      'Please refer to the changelogs of (link: releases/3.5 text: Kirby 3.5), (link: releases/3.6 text: Kirby 3.6) ' .
      'and (link: releases/3.7 text: Kirby 3.7) for details.' .
      '</info>'
    ) ?>
  </div>

</section>
