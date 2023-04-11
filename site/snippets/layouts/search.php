<?php
$area  = $area ?? 'all';
$areas = option('search.areas');
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
</style>

<div class="search">
  <button class="search-button" type="button" data-area="<?= $area ?? 'all' ?>">
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
          <li>
            <a class="leading-tight" href="">
              <strong class="search-title text-sm"></strong>
              <span class="search-area" data-area=""></span>
              <span class="text-xs search-link font-mono color-gray-500"></span>
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
        <a class="ml-auto color-gray-600" href="https://algolia.com">
          Search by <?= icon('algolia') ?>
        </a>
      </div>
    </form>
  </dialog>
</div>
