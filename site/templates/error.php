<?php layout() ?>

<article class="max-w-xl">
	<h1 class="h1 mb-12">
		Not found&nbsp;😔
	</h1>
	<form action="/search" class="flex items-stretch rounded text-lg">
		<input autofocus id="search" class="rounded flex-grow bg-light px-3 py-1 mr-3" type="text" name="q" placeholder="Search instead...">
		<button class="flex-shrink-0 flex bg-black color-white rounded items-center px-3" aria-label="Search">
			<?= icon('search') ?>
		</button>
	</form>
</article>
