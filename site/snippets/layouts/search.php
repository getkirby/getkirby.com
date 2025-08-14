<?php
$area ??= 'all';
$areas  = $kirby->option('search.areas')($kirby);
?>

<style>
.search-input figure svg:last-child {
	animation: Spin .9s linear infinite;
}
@keyframes Spin {
	100% {
		transform: rotate(360deg);
	}
}
form:not([data-fetching]) .search-input figure svg:last-child {
	display: none;
}
form[data-fetching] .search-input figure svg:first-child {
	display: none;
}

.search-footer svg {
	width: auto;
}
</style>

<div class="search">
	<button class="search-button" type="button" data-area="<?= $area ?>" aria-label="Search">
		<?= icon('search') ?>
	</button>

	<dialog class="overlay search-dialog">
		<form class="relative bg-white shadow-xl" action="/search">
			<!-- Input -->
			<div class="search-input relative flex items-stretch">
				<figure class="grid place-items-center">
					<?= icon('search') ?>
					<?= icon('loader') ?>
				</figure>
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
								<h3 class="search-title font-bold text-sm"></h3>
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
				<?php if(option('archived', false) === false): ?>
				<a class="ml-auto color-gray-600" href="https://algolia.com">
					Search by <?= icon('algolia', 'Algolia') ?>
				</a>
				<?php endif ?>
			</div>
		</form>
	</dialog>
</div>
