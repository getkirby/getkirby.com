<nav aria-label="Cookbook menu">
	<div class="sidebar cookbook-sidebar sticky" style="--top: var(--spacing-6)">
		<p class="h1 color-gray-400 mb-12"><a href="/docs/cookbook">Cookbook</a></p>

		<select
			class="sidebar-mobile-select"
			onchange="window.location.href = this.value"
		>
			<option disabled selected>Select a category</option>
				<?php foreach (collection('cookbook/categories') as $category): ?>
				<option value="<?= $category->url() ?>">
					&nbsp;&nbsp;&nbsp;<?= $category->title() ?>
				</option>
				<?php endforeach ?>
		</select>

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
