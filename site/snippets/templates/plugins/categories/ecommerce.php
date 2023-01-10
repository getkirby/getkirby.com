<?php snippet('templates/plugins/section', [
  'id'      => 'ecommerce',
  'icon'    => 'cart',
  'hero'    => true,
  'title'   => 'Shop integrations',
  'layout'  => 'cards',
  'columns' => 2,
  'plugins' => [
    'plugins/ww/merx',
    'plugins/tristantbg/kirby-shopify',
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
