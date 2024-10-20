<?php
$sale = new Kirby\Buy\Sale();
?>

<?php if ($page->id() !== 'buy' && $sale->isActive() === true): ?>
<aside class="banner text-sm rounded shadow-lg">
	<a href="<?= url('buy') ?>"><?= $sale->text() ?></a>
</aside>
<?php endif ?>

<?php
// expire the cache when the sale banner/prices change
$sale->expires();
?>
