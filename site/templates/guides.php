<?php layout() ?>

<div class="mb-36">
	<h1 class="h1 mb-24">Guide</h1>
	<?php foreach (collection('guides')->group('category') as $category => $guides): ?>
	<section class="mb-24">
		<header>
			<h2 class="h6 mb-6"><?= option('categories')[$category] ?? ucfirst($category) ?></h2>
		</header>
		<ul class="guides auto-fill auto-rows-fr" style="--min: 16rem; --gap: var(--spacing-3)">
			<?php foreach ($guides as $guide): ?>
				<li class="bg-light rounded p-6">
					<article>
						<a class="block" href="<?= $guide->url() ?>">
							<h3 class="flex font-bold items-center mb-3" style="gap: .5rem">
								<?= icon($guide->icon()->or('book')) ?> <?= $guide->title() ?>
							</h3>
							<p class="color-gray-700"><?= $guide->description() ?></p>
						</a>
					</article>
				</li>
			<?php endforeach ?>
		</ul>
	</section>

	<?php endforeach ?>
</div>

<footer class="h2 max-w-xl">
	Travel back in time with our <a href="/docs/archive"><span class="link">docs archive</span> &rarr;</a>
</footer>
