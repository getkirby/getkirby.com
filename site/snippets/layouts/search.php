<?php
$area ??= 'all';
$areas  = $kirby->option('search.areas')($kirby);
?>

<div class="search">
	<button class="search-button" type="button" data-area="<?= $area ?>" aria-label="Search">
		<?= icon('search') ?>
	</button>

	<dialog class="overlay search-dialog">
		<form class="relative bg-white shadow-xl" action="/search">
			<!-- Input -->
			<div class="search-input relative flex items-stretch">
				<div class="search-input-icon grid place-items-center">
					<?= icon('search') ?>
					<?= icon('loader') ?>
				</div>
				<input
					type="text"
					name="q"
					value="<?= $q ?? null ?>"
					placeholder="Search for anything …"
					autocomplete="off"
				>
				<nav class="search-input-area grid relative place-items-center flex-shrink-0 text-sm leading-tight">
					<button type="button" class="flex items-center">
						<span class="block search-area" data-area="<?= $area ?>"><?= $areas[$area] ?? $area ?></span>
					</button>
					<ul class="bg-black shadow-xl hidden">
						<?php foreach ($areas as $value => $label): ?>
						<li><button class="search-area" type="button" data-area="<?= $value ?>"><?= $label ?></button></li>
						<?php endforeach ?>
					</ul>
					<input name="area" type="hidden" value="<?= $area ?>">
				</nav>
			</div>

			<!-- Results -->
			<div class="search-results">
				<ul></ul>
				<template>
					<li class="search-result">
						<a class="leading-snug" href="">
							<div>
								<div class="search-title font-bold text-sm"></div>
								<div class="search-byline text-xs color-gray-700"></div>
								<div class="search-link text-xs font-mono color-gray-600"></div>
							</div>
							<div class="search-area" data-area=""></div>
						</a>
					</li>
				</template>
			</div>

			<!-- Footer -->
			<div class="search-footer flex flex-wrap items-center justify-between text-sm">
				<div class="search-more flex-shrink-0">
					<a class="hidden font-bold" href="/search">
						View all <span class="search-more-count mx-1"></span> results &rsaquo;
					</a>
				</div>
				<?php if (option('archived', false) === false): ?>
				<a
					href="https://algolia.com"
					aria-label="Search by Algolia"
					class="ml-auto color-gray-600"
				>
					Search by <?= icon('algolia') ?>
				</a>
				<?php endif ?>
			</div>
		</form>
	</dialog>
</div>
