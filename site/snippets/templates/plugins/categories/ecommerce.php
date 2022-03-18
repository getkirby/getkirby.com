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
  'id'      => 'utilities',
  'icon'    => 'cart',
  'title'   => 'Merx extensions',
  'layout'  => 'cardlets',
  'columns' => 2,
  'plugins' => $plugins->filter('subcategory', 'merx')->pluck('id')
]) ?>
