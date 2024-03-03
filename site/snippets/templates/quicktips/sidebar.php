<?php use Kirby\Http\Uri; ?>
<nav aria-label="Cookbook menu">
	<div class="cookbook-sidebar sticky" style="--top: var(--spacing-6)">
		<p class="h1 color-gray-400 mb-12"><a href="/docs/cookbook">Quicktips</a></p>
		<ul class="filters">
			<li>
				<a href="/docs/quicktips"<?= ariaCurrent(Uri::current()->path()->last() === 'quicktips') ?>>
					<?= icon('list-bullet') ?> All quicktips
				</a>
			</li>
			<li>
				<button class="search-button" type="button" data-area="cookbook">
					<?= icon('search') ?> Search
				</button>
			</li>
			<li><hr class="hr"></li>
			<?php foreach ($tags as $tag): ?>
			<li>
				<a aria-label="<?= $tag ?> recipes" href="<?= page('docs/quicktips')->url(). '/tags/' . Str::slug($tag) ?>"<?= ariaCurrent($tag === Uri::current()->path()->last()) ?>>
					 <?= Str::ucFirst($tag) ?>
				</a>
			</li>
			<?php endforeach ?>
		</ul>
	</div>
</nav>
