<section id="brands" class="mb-42">
	<?php if ($title ?? null): ?>
	<h2 class="h2 mb-12"><?= $title ?></h2>
	<?php endif ?>
	<ul class="brands items-center" style="--brands-columns: <?= $columns ?? 5 ?>">
		<?php foreach(collection('brands/' . $tag)->limit($limit ?? 10) as $brand): ?>
		<?php snippet('brand', ['brand' => $brand]) ?>
		<?php endforeach ?>
	</ul>
</section>
