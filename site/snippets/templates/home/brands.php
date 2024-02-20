<section id="brands" class="mb-42">
	<h2 class="h2 mb-12">Trusted by brands world&#8209;wide</h2>
	<ul class="brands items-center">
		<?php foreach(collection('brands')->limit(18) as $client): ?>
		<li class="<?= $client->slug() ?>" title="<?= $client->title() ?>">
			<?= $client->image()->read() ?>
		</li>
		<?php endforeach ?>
	</ul>
</section>
