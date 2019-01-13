<form id="search" class="menu-search js-menu-search<?= r(!empty($background), ' background:' . $background) ?>" action="<?= url('search') ?>" data-base-url="<?= url() ?>">
  <input id="menu-search-input" class="menu-search-input js-menu-search-input" placeholder="Search for …" name="q" autocomplete="off" aria-autocomplete="list" type="search">
</form>
