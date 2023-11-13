<?php
$sale = new Buy\Sale();
?>

<?php if ($page->id() !== 'buy' && $sale->isActive() === true): ?>
<aside class="banner text-sm">
  <a href="<?= url('buy') ?>"><?= $sale->text() ?></a>
</aside>

<?php
// set the cache expiry to end of sale
$sale->expires();
?>
<?php endif ?>
