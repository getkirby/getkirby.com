<nav aria-label="Cookbook menu">
	<div class="sidebar cookbook-sidebar sticky" style="--top: var(--spacing-6)">
		<header class="sidebar-header mb-12">
			<p class="h1 color-gray-400">
				<a href="/docs/cookbook">Cookbook</a>
			</p>

			<?php snippet('sidebar/mobile-select', [
				'menu'          => collection('cookbook/categories'),
				'children'      => false,
				'hasCategories' => false,
				'placeholder'   => 'Select a category …'
			]) ?>
		</header>

		<ul class="filters">
			<li>
				<a href="/docs/cookbook"<?= ariaCurrent($page->slug() === 'cookbook') ?>>
					<?= icon('list-bullet') ?> All recipes
				</a>
			</li>
			<li>
				<button class="search-button" type="button" data-area="cookbook">
					<?= icon('search') ?> Search
				</button>
			</li>
			<li><hr class="hr"></li>
			<?php foreach (collection('cookbook/categories') as $category): ?>
			<li>
				<a aria-label="<?= $category->title() ?> recipes" href="<?= $category->url() ?>"<?= ariaCurrent($category->isOpen()) ?>>
					<?= icon($category->icon()) ?> <?= $category->title() ?>
				</a>
			</li>
			<?php endforeach ?>
		</ul>
	</div>
</nav>
