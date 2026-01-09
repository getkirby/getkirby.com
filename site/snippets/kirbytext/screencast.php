<article class="screencast mb-6 bg-black color-white grid">
	<header class="p-6">
		<a href="https://videos.getkirby.com" class="h6 block mb-3">Screencast</a>
		<h2 class="h2 color-white mb-3"><?= $title ?></h2>
		<?php if ($text ?? null): ?>
		<p class="text-base color-gray-400"><?= widont($text) ?></p>
		<?php endif ?>
	</header>
	<figure class="video">
		<?= video($url, $poster, [], [
			'loading' => $lazy ? 'lazy' : null
		]) ?>
	</figure>
</article>
