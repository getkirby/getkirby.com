<section id="brands" class="mb-42">
	<h2 class="h2 mb-12"><?= $title ?></h2>
	<ul class="brands items-center" style="--brands-columns: 5">
		<?php foreach(collection('brands/' . $tag)->limit(12) as $brand): ?>
		<?php snippet('brand', ['brand' => $brand]) ?>
		<?php endforeach ?>
	</ul>
</section>
