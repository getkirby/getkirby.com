<article class="overflow-hidden columns" style="--columns-md: 2; --columns: 3;">
	<div class="highlight">
		<h2 class="h2 mb-12">Made with Kirby</h2>

		<div class="prose text-base color-gray-700 mb-12">
			<?= $case->intro()->kt() ?>
		</div>

		<a class="btn btn--outlined" href="https://git-tower.com">
			<?= icon('heart') ?>
			<?= $case->link()->shortUrl() ?>
		</a>

	</div>

	<div class="flex" style="--span: 2; --span-md: 1; padding-top: var(--spacing-12);">
			<figure class="shadow-2xl" style="align-self: flex-end; justify-self: flex-end">
				<?= $case->image()->crop(1200, 800, 'top left') ?>
			</figure>
	</div>
</article>
