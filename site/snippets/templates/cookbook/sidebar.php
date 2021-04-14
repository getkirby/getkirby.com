
<nav>
	<div class="cookbook-sidebar sticky" style="--top: var(--spacing-6)">
		<p class="h1 color-gray-400 mb-12"><a href="/docs/cookbook">Cookbook</a></p>
		<ul class="filters">
			<li>
				<a href="/docs/cookbook"<?= ariaCurrent($page->slug() === 'cookbook') ?>>
					<?= icon('list') ?> All recipes
				</a>
			</li>
			<li>
				<a href="/docs/cookbook/new"<?= ariaCurrent($page->slug() === 'new') ?>>
					<?= icon('flash') ?> New
				</a>
			</li>
			<li>
				<button class="search-button" type="button" data-area="cookbook">
					<?= icon('search') ?> Search
				</button>
			</li>
			<hr class="hr">
			<?php foreach (collection('cookbook/categories') as $category): ?>
			<li>
				<a href="<?= $category->url() ?>"<?= ariaCurrent($category->isOpen()) ?>>
					<?= icon($category->icon()) ?> <?= $category->title() ?>
				</a>
			</li>
			<?php endforeach ?>
		</ul>
	</div>
</nav>
