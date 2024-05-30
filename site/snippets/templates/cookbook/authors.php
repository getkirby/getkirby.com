<?php if ($authors->count()): ?>
	<section id="authors">
		<header class="prose mb-6">
			<h2><?= $authors->count() > 1 ? 'Authors' : 'Author' ?></h2>
		</header>

		<ul class="columns" style="--columns: 1; --gap: 1.5rem">
			<?php foreach ($authors as $author): ?>
			<li class="max-w-xl bg-light rounded overflow-hidden shadow-lg">
				<figure class="columns" style="--columns: 7; --gap: 0">
					<div style="--aspect-ratio: 1/1; --span: 2">
						<?= $author->image()->crop(400) ?>
					</div>
					<figcaption class="p-6 text-sm leading-tight" style="--span: 5">
						<div class="mb-6">
							<p class="h4 font-bold"><?= $author->title() ?></p>
							<p class="mb-1 color-gray-800"><?= $author->bio() ?></p>

							<?php if ($author->website()->isNotEmpty()): ?>
								<a href="<?= $author->website() ?>">
									<p class="font-mono link">
										<?= $author->website()->shortUrl() ?>
									</p>
								</a>
							<?php endif ?>
						</div>

						<a href="<?= $author->url() ?>">
							<p class="link">&rarr; All their articles</p>
						</a>
					</figcaption>
				</figure>
			</li>
			<?php endforeach ?>
		</ul>
	</section>
<?php endif ?>
