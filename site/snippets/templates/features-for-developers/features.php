<section class="mb-42">
	<?php snippet('templates/features/triptych', ['features' => [
		[
			'title' => 'User management',
			'text'  => 'Work with roles and user permissions to create protected sections on your site. From client areas to communities: Kirby’s user system has got you covered.',
			'link' => '/docs/guide/users',
			'image' => '<div class="prose">' . $page->users()->kt() . '</div>'
		],
		[
			'title' => 'Media API',
			'text'  => 'Kirby comes with async image processing. Resize, crop and convert your images on the fly. Make sure that every visitor gets the perfect image size.',
			'link' => '/docs/guide/files/resize-images-on-the-fly',
			'image' => '<div class="prose">' . $page->assets()->kt() . '</div>'
		],
		[
			'title' => 'Caching',
			'text'  => 'Kirby comes with mighty caching on board. Not the right fit for your project? Add your cache driver of choice and reduce page loading times in the blink of an eye.',
			'link' => '/docs/guide/cache',
			'image' => '<div class="prose">' . $page->caching()->kt() . '</div>'
		],
	]]) ?>
</section>
