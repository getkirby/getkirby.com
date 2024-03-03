<?php layout('cookbook') ?>

<?php slot('h1') ?>
<?= $page->title()->widont() ?>
<?php endslot() ?>

<?php slot('sidebar') ?>

<?php snippet('templates/quicktips/sidebar') ?>
<?php endslot() ?>
<?php slot('tags') ?>

<div class="mb-6">
	<span>Tags:</span>
		<?php foreach ($page->tags()->split(',') as $tag): ?>
			<a href="<?= page('docs/quicktips')->url() . '/tags/' . Str::slug($tag) ?>"><?= $tag ?></a>
		<?php endforeach ?>
</div>
<?php endslot() ?>

<?php slot() ?>

	<?php snippet('toc', ['title' => 'In this recipe']) ?>
	<div class="prose mb-24">
		<?= $page->text()->kt() ?>
	</div>

	<?php if ($authors->count()): ?>
	<section id="authors">
		<header class="prose mb-6">
			<h2><?= $authors->count() > 1 ? 'Authors' : 'Author' ?></h2>
		</header>
		<ul class="auto-fill" style="--min: 12rem; --max: 14rem">
			<?php foreach ($authors as $author): ?>
			<li>
				<figure class="block bg-white p-6 shadow-2xl">
					<p class="mb-3" style="--aspect-ratio: 1/1"><?= $author->image()->crop(400) ?></p>
					<figcaption class="flex-grow text-sm leading-tight">
						<div class="mb-6">
							<p class="font-bold"><?= $author->title() ?></p>
							<p class="mb-1 color-gray-700"><?= $author->bio() ?></p>

							<?php if ($author->website()->isNotEmpty()): ?>
							<a href="<?= $author->website() ?>">
								<p class="font-mono link"><?= $author->website()->shortUrl() ?></p>
							</a>
							<?php endif ?>
						</div>

						<a href="<?= $author->url() ?>">
							<p class="link">&rarr; All their recipes</p>
						</a>
					</figcaption>
				</figure>
			</li>
			<?php endforeach ?>
		</ul>
	</section>
	<?php endif ?>

<?php endslot() ?>


