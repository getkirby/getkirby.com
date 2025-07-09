<?php layout() ?>

<style>
.search-results-page .search-results {
	background: var(--color-white);
	border: 1px solid var(--color-light);
	border-bottom: 0;
}
</style>

<div class="columns" style="--columns-sm: 1; --columns-md: 1; --columns: 4; --gap: var(--spacing-12)">
	<form action="/search">
		<label for="search" class="h1 block color-gray-400 mb-12">Search</label>
		<div class="sticky" style="--top: var(--spacing-6)">
			<div class="flex max-w-xl items-stretch mb-6 rounded">
				<input autofocus id="search" class="rounded flex-grow w-100% bg-light px-3 py-1 mr-3" type="text" value="<?= $query ?>" name="q">
				<button class="flex-shrink-0 flex bg-black color-white rounded items-center px-3" aria-label="Search">
					<?= icon('search') ?>
				</button>
			</div>
			<ul class="mb-12 leading-tight">
				<?php foreach ($areas as $areaId => $areaLabel): ?>
				<li class="flex items-center mb-1">
					<input
						<?= $areaId === $area ? 'checked' : '' ?>
						class="mr-3"
						id="area-<?= $areaId ?>"
						name="area"
						type="radio"
						value="<?= $areaId ?>"
					>
					<label
						class="search-area"
						data-area="<?= $areaId ?>"
						for="area-<?= $areaId ?>"
					>
						<?= $areaLabel ?>
					</label>
				</li>
				<?php endforeach ?>
			</ul>

			<footer class="text-xs font-mono">
				<p class="mb-6">
					Use <kbd class="text-sm bg-light p-1 rounded" title="Alternatively, Cmd + k or Ctrl + k">/</kbd> anywhere on the site to open the search dialog.
				</p>
				<p>It's a great solution if you want to integrate meaningful search features in your Kirby site.</p>
			</footer>
		</div>
	</form>

	<article class="search-results-page" style="--span: 3">

		<!-- No query: suggestions -->
		<?php if (empty($query)): ?>
		<h2 class="h1 mb-12">Suggestions …</h2>
		<div class="prose">
			<ul>
				<li>Search for object methods. i.e. <a href="<?= u('search') ?>?q=$site">$site</a>, <a href="<?= url('search') ?>?q=$page">$page</a> or <a href="<?= u('search') ?>?q=$file">$file</a></li>
				<li>All about <a href="<?= u('search') ?>?q=blueprint">blueprints</a></li>
				<li>List all <a href="<?= u('search') ?>?q=helpers">helper methods</a></li>
				<li><a href="<?= u('search') ?>?q=fields">Panel fields</a></li>
			</ul>
		</div>

		<!-- Query results -->
		<?php else: ?>
		<h1 class="h1 mb-12"><?= $pagination->total() ?> results</h1>

		<?php if ($pagination->total() === 0): ?>
		<p class="h2 max-w-xl mb-3">We couldn't find what you are looking for 😔<p>
		<?php else: ?>
		<ul class="search-results mb-6">
			<?php foreach ($results as $result): ?>
			<li class="search-result">
				<a class="leading-snug" href="<?= url($result->objectID()) ?>">
					<div>
						<h2 class="font-bold"><?= $result->title() ?></h2>
						<div class="search-byline text-xs color-gray-700">
							<?= $result->byline() ?? $result->intro() ?>
						</div>
						<div class="search-link text-xs font-mono color-gray-600">
							<?= $result->objectID() ?>
						</div>
					</div>
					<div class="search-area" data-area="<?= $result->area() ?>"><?= $areas[$result->area()] ?? '' ?></div>
				</a>
			</li>
			<?php endforeach ?>
		</ul>
		<?php snippet('pagination', $pagination) ?>
		<?php endif ?>
		<?php endif ?>

	</article>
</div>

<script>
	const $form   = document.querySelectorAll("form")[1];
	const $inputs = document.querySelectorAll("input[name=area]");
	[...$inputs].forEach(input => input.addEventListener("change", () => $form.submit()));
</script>
