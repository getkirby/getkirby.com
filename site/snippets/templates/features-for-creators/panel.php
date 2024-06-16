<style>
#panel svg {
	width: 64px;
	height: 64px;
}
</style>

<section id="panel" style="margin-bottom: 16rem">
	<div class="columns items-end mb-12" style="--columns: 2; --gap: var(--spacing-24)">
		<div>
			<?php snippet('templates/features/intro', [
				'title' => 'The Panel',
				'intro' => 'A headquarter that adapts to your needs',
				'text'  => 'No matter if you need to curate projects, products, retailers, team members, restaurant menus, customers, galleries, albums, documentation or articles, Kirby lets you create a home for yourself and your editors that reflects the unique structure of your content, use cases and users – not the other way around.',
			]) ?>
		</div>
		<div class="mb-12">
			<?php snippet('voice', [
				'voice' => page('voices/matthias-ott')
			]) ?>
		</div>
	</div>

	<?php if ($images = $page->images()->template('content-type')): ?>
	<ul class="auto-fill highlight bg-dark rounded" style="--min: 12rem; --gap: var(--spacing-12);">
		<?php foreach ($images as $image): ?>
		<li>
			<a data-lightbox="panel" href="<?= $image->resize(1800, 1800)->url() ?>">
				<figure>
					<p class="mb-3 bg-black shadow-xl rounded overflow-hidden" style="--aspect-ratio: 3/2">
						<?= img($image, [
							'src' => [
								'crop'   => 'top',
								'width'  => 400,
								'height' => 266,
							],
							'srcset' => [
								'400w' => [
									'crop'   => 'top',
									'width'  => 400,
									'height' => 266,
								],
								'800w' => [
									'crop'   => 'top',
									'width'  => 800,
									'height' => 532,
								],
							]
						]) ?>
					</p>
					<figcaption class="font-mono text-sm color-gray-400">
						<h3 class="color-white"><?= $image->caption() ?></h3>
						<p"><?= $image->text() ?></p>
					</figcaption>
				</figure>
			</a>
		</li>
		<?php endforeach ?>
		<li>
			<a href="https://kirbysites.com">
				<figure>
					<p class="bg-light mb-3 shadow-xl rounded" style="--aspect-ratio: 3/2">
						<span class="grid place-items-center color-gray-400"><?= image('bulb.svg')->read() ?></span>
					</p>
					<figcaption class="font-mono text-sm color-gray-400">
						<h3 class="color-white">Your content</h3>
						<p>We cannot wait to see how you make Kirby's Panel yours.</p>
					</figcaption>
				</figure>
			</a>
		</li>
	</ul>
	<?php endif ?>

</section>
