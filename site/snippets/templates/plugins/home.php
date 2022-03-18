<?php snippet('templates/plugins/section', [
  'id'      => 'fields',
  'icon'    => 'forms',
  'title'   => 'Fields',
  'layout'  => 'cards',
  'plugins' => [
    'plugins/fabianmichael/markdown-field',
    'plugins/sylvainjule/color-palette',
    'plugins/belugachris/navigation',
    'plugins/oblikstudio/json-field',
    'plugins/sylvainjule/locator',
    'plugins/sylvainjule/illustrated-radio',
  ]
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'seo',
  'icon'    => 'seo',
  'title'   => 'SEO',
  'layout'  => 'hero',
  'plugins' => [
    'plugins/diesdasdigital/metaknight'
  ]
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'template-engines',
  'icon'    => 'code',
  'title'   => 'Template Engines',
  'layout'  => 'cardlets',
  'columns' => 2,
  'plugins' => [
    'plugins/afbora/blade',
    'plugins/mgfagency/twig',
    'plugins/clicktonext/plates',
    'plugins/bnomei/handlebars',
  ]
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'analytics',
  'icon'    => 'analytics',
  'title'   => 'Analytics',
  'layout'  => 'cards',
  'columns' => 2,
  'plugins' => [
    'plugins/paulmorel/fathom-analytics',
    'plugins/sylvainjule/matomo',
    'plugins/rowdyrabouw/plausible',
    'plugins/daandelange/simplestats',
  ]
]) ?>

<section id="ecommerce" class="mb-24">
  <?php snippet('templates/plugins/headline', [
    'icon' => 'cart',
    'text' => 'Shops'
  ]) ?>

  <div class="mb-6">
    <?php snippet('templates/plugins/hero', [
      'plugins' => pages([
        'plugins/wagnerwagner/merx',
      ]),
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

<?php snippet('templates/plugins/section', [
  'id'      => 'blocks',
  'icon'    => 'widget',
  'title'   => 'Blocks',
  'layout'  => 'cards',
  'plugins' => [
    'plugins/jongacnik/fields-block',
    'plugins/microman/form-block',
    'plugins/microman/grid-block',
  ]
]) ?>

<?php snippet('templates/plugins/section', [
  'icon'    => 'widget',
  'id'      => 'extensions',
  'title'   => 'Panel Extensions',
  'layout'  => 'cards',
  'columns' => 2,
  'plugins' => [
    'plugins/gearsdigital/localizer-for-kirby',
    'plugins/distantnative/retour',
    'plugins/lukasbestle/versions',
    'plugins/michnhokn/logger'
  ]
]) ?>

