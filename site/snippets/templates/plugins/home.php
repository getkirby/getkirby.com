<section id="fields" class="mb-24">
  <?php snippet('templates/plugins/headline', [
    'icon' => 'forms',
    'text' => 'Fields'
  ]) ?>
  <?php snippet('templates/plugins/cards', [
    'plugins' => pages(
      'plugins/fabianmichael/markdown-field',
      'plugins/sylvainjule/color-palette',
      'plugins/belugachris/navigation',
      'plugins/oblikstudio/json-field',
      'plugins/sylvainjule/locator',
      'plugins/sylvainjule/illustrated-radio',
    )
  ]) ?>
</section>

<section id="seo" class="mb-24">
  <?php snippet('templates/plugins/headline', [
    'icon' => 'seo',
    'text' => 'SEO'
  ]) ?>
  <?php snippet('templates/plugins/hero', [
    'plugin' => page('plugins/diesdasdigital/metaknight'),
  ]) ?>
</section>

<section id="template-engines" class="mb-24">
  <?php snippet('templates/plugins/headline', [
    'icon' => 'code',
    'text' => 'Template Engines'
  ]) ?>
  <?php snippet('templates/plugins/cardlets', [
    'columns' => 2,
    'plugins' => pages(
      'plugins/afbora/blade',
      'plugins/mgfagency/twig'
    )
  ]) ?>
</section>

<section id="analytics" class="mb-24">
  <?php snippet('templates/plugins/headline', [
    'icon' => 'analytics',
    'text' => 'Analytics'
  ]) ?>

  <?php snippet('templates/plugins/cards', [
    'columns' => 2,
    'plugins' => pages(
      'plugins/paulmorel/fathom-analytics',
      'plugins/sylvainjule/matomo',
      'plugins/rowdyrabouw/plausible',
      'plugins/daandelange/simplestats',
    )
  ]) ?>
</section>

<section id="ecommerce" class="mb-24">
  <?php snippet('templates/plugins/headline', [
    'icon' => 'cart',
    'text' => 'Shops'
  ]) ?>

  <div class="mb-6">
    <?php snippet('templates/plugins/hero', [
      'plugin' => page(
        'plugins/wagnerwagner/merx',
      ),
    ]) ?>
  </div>
  <?php snippet('templates/plugins/cardlets', [
    'columns' => 2,
    'plugins' => pages(
      'plugins/tristanbg/shopify',
      'plugins/hashandsalt/snipcart',
    )
  ]) ?>

</section>

<section id="blocks" class="mb-24">
  <?php snippet('templates/plugins/headline', [
    'icon' => 'widget',
    'text' => 'Blocks'
  ]) ?>
  <?php snippet('templates/plugins/cards', [
    'columns' => 3,
    'plugins' => pages(
      'plugins/jongacnik/fields-block',
      'plugins/microman/form-block',
      'plugins/microman/grid-block',
    )
  ]) ?>
</section>

<section id="sections" class="mb-24">
  <?php snippet('templates/plugins/headline', [
    'icon' => 'widget',
    'text' => 'Panel Apps'
  ]) ?>
  <?php snippet('templates/plugins/cards', [
    'columns' => 2,
    'plugins' => pages(
      'plugins/gearsdigital/localizer-for-kirby',
      'plugins/distantnative/retour',
      'plugins/lukasbestle/versions',
      'plugins/michnhokn/logger'
    )
  ]) ?>
</section>

