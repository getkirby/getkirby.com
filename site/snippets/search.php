<form id="search" class="search <?= r(!empty($background), 'background:' . $background) ?>" action="<?= url('search') ?>">
  <input placeholder="Search for …" name="q" autocomplete="off" aria-label="Search" aria-autocomplete="list" type="search">
</form>
