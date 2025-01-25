<blockquote class="voice">
	<p class="mb-3 text-lg leading-snug">
		<?= $voice->text()->widont() ?>
	</p>
	<footer>
		<a href="<?= $voice->website() ?>">
			<figure class="flex items-center">
				<?php if($image = $voice->image()): ?>
				<div class="flex-shrink-0 mr-3" style="width: var(--spacing-12); --aspect-ratio: 1/1">
					<?= img($image, [
						'alt' => 'Photo of ' . $voice->title(),
						'src' => [
							'crop'  => true,
							'width' => 48
						],
						'srcset' => [
							'48w' => [
								'crop' => true,
								'width' => 48
							],
							'96w' => [
								'crop' => true,
								'width' => 96
							]
						],
					]) ?>
				</div>
				<?php endif ?>
				<figcaption class="text-sm">
					<p><strong><?= $voice->title()->html() ?></strong></p>
					<?php if ($voice->bio()->isNotEmpty()): ?>
					<p class="font-mono text-xs color-gray-700"><?= $voice->bio()->html() ?></p>
					<?php endif ?>
				</figcaption>
			</figure>
		</a>
	</footer>
</blockquote>
