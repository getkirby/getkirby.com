<section id="<?= $id ?>" class="features-section<?= ($reverse ?? false) ? ' features-section--reverse' : '' ?>">
  <header class="features-section-header max-w-xl">
    <h2 class="h2"><?= widont($title) ?></h2>
    <?php if ($intro ?? null): ?>
    <p class="h2 color-gray-600"><?= widont($intro) ?></p>
    <?php endif ?>
  </header>

  <?php if ($text ?? null): ?>
  <div class="features-section-text prose leading-snug text-lg">
    <p><?= $text ?></p>
  </div>
  <?php endif ?>

  <div class="features-section-figure">
    <?php snippet($figure) ?>
  </div>

  <div class="features-section-grid">
    <?php snippet('templates/features/features-grid', ['features' => $features]) ?>
  </div>

  <?php if ($voice ?? null): ?>
  <div class="features-section-voice">
    <?php snippet('voice', [
      'voice' => page('voices/' . $voice)
    ]) ?>
  </div>
  <?php endif ?>

  <?php snippet($footer ?? '') ?>
</section>
