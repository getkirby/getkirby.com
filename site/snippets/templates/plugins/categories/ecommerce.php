<?php snippet('templates/plugins/section', [
  'id'      => 'ecommerce',
  'icon'    => 'cart',
  'hero'    => true,
  'title'   => 'Shop integrations',
  'layout'  => 'cardlets',
  'columns' => 2,
  'plugins' => [
    'plugins/wagnerwagner/merx',
    'plugins/tristanbg/shopify',
    'plugins/hashandsalt/snipcart',
  ]
]) ?>

<?php snippet('templates/plugins/section', [
  'id'      => 'merx-extensions',
  'icon'    => 'cart',
  'title'   => 'Merx extensions',
  'layout'  => 'cardlets',
  'columns' => 2,
  'plugins' => $plugins->filter('subcategory', 'merx')->pluck('id')
]) ?>
