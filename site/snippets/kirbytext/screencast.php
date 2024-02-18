<article class="screencast mb-6 bg-black color-white grid">
	<header class="p-6">
		<a href="https://videos.getkirby.com" class="h6 block mb-3">Screencast</a>
		<h2 class="h2 color-white"><?= $title ?></h2>
		<?php if ($text ?? null): ?>
		<p class="text-base color-gray-400"><?= widont($text) ?></p>
		<?php endif ?>
	</header>
	<figure class="video" style="--aspect-ratio: 16/9">
		<?= video(str_replace('www.youtube.com', 'www.youtube-nocookie.com', $url), [
			'youtube' => [
				'controls'       => 0,
				'modestbranding' => 1,
				'showinfo'       => 0,
				'rel'            => 0,
			]
		], [
			'loading' => 'lazy'
		]) ?>
	</figure>
</article>
