<section id="brands" class="mb-42">
	<h2 class="h2 mb-12">Trusted by clients world&#8209;wide</h2>
	<ul class="brands items-center">
		<?php foreach(collection('brands/featured')->limit(24) as $brand): ?>
		<?php snippet('brand', ['brand' => $brand]) ?>
		<?php endforeach ?>
	</ul>
</section>
