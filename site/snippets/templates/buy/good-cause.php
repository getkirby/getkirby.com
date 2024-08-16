<style>
@media (max-width: 40rem) {
	.causes li:not(:first-child) {
		display: none;
	}
}
</style>

<div id="good-cause">
	<h2 class="h2 mb-6">For a good cause? <mark class="px-1 rounded">It’s free.</mark></h2>
	<div class="prose mb-6">
		<p>We care about a better society and the future of our planet. We offer free&nbsp;licenses for <strong>students, selected educational projects, social and environmental organizations, charities and non-profits</strong> with insufficient funding.</p>
	</div>

	<a class="btn btn--filled mb-12" href="mailto:support@getkirby.com">
		<?= icon('heart') ?>
		Contact us
	</a>

	<ul class="columns causes" style="--columns: 2; --gap: var(--spacing-12);">
		<?php foreach (collection('cases/causes')->shuffle()->limit(2) as $case): ?>
			<li>
				<a href="<?= $case->link()->toUrl() ?>">
					<figure>
						<span class="block shadow-2xl mb-3" style="--aspect-ratio: 3/4">
							<?= img($image = $case->image(), [
								'alt' => 'Screenshot of the ' . $image->alt() . ' website',
								'src' => [
									'width' => 300
								],
								'srcset' => [
									400,
									800,
								]
							]) ?>
						</span>
						<figcaption class="text-sm">
							<?= $case->title() ?>
						</figcaption>
					</figure>
				</a>
			</li>
		<?php endforeach ?>
	</ul>
</div>
