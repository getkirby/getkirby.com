<div class="video-embed" style="--aspect-ratio: 16/9">
	<a href="<?= esc($url, 'attr') ?>" data-iframe="<?= esc($iframe, 'attr') ?>" aria-label="<?= $attr['title'] ?? 'YouTube video' ?>">
		<?= img($poster, [
			'src' => [
				'width' => 616
			],
			'lazy' => ($attr['loading'] ?? null) === 'lazy',
			// sizes generated with https://ausi.github.io/respimagelint/
			'sizes' => '(min-width: 1520px) 616px, (min-width: 1160px) 42.06vw, (min-width: 960px) calc(50vw - 56px), (min-width: 780px) calc(75vw - 84px), (min-width: 480px) calc(100vw - 96px), 90vw',
			'srcset' => [
				400,
				616,
				800,
				1000,
				1232
			],
		]) ?>

		<svg version="1.1" viewBox="0 0 68 48" class="play-button">
			<path class="ytp-large-play-button-bg" d="M66.52,7.74c-0.78-2.93-2.49-5.41-5.42-6.19C55.79,.13,34,0,34,0S12.21,.13,6.9,1.55 C3.97,2.33,2.27,4.81,1.48,7.74C0.06,13.05,0,24,0,24s0.06,10.95,1.48,16.26c0.78,2.93,2.49,5.41,5.42,6.19 C12.21,47.87,34,48,34,48s21.79-0.13,27.1-1.55c2.93-0.78,4.64-3.26,5.42-6.19C67.94,34.95,68,24,68,24S67.94,13.05,66.52,7.74z" fill="#f00"/>
			<path d="M 45,24 27,14 27,34" fill="#fff"/>
		</svg>
	</a>
	<span class="text-overlay">
		This video is loaded from YouTube servers with your consent.
		<a href="<?= url('privacy#website__third-party-services') ?>" class="link">Read more…</a>
	</span>
</div>
