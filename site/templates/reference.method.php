<?php snippet('reference/entry/header') ?>
<?php snippet('reference/entry/meta') ?>

<div class="text">
  <?php
  if (is_a($page, ReferenceKirbytagPage::class) === true) {
    snippet('reference/entry/attributes');
  } else {
    snippet('reference/entry/call');
    snippet('reference/entry/parameters');
  }

  if (is_a($page, ReferenceFieldmethodPage::class) === true) {
    snippet('reference/entry/aliases');
  }

  snippet('reference/entry/returns');
  snippet('reference/entry/throws');

  echo $page->text()->kt()->anchorHeadlines();

  snippet('reference/entry/inherits');
  snippet('reference/entry/source');
  ?>
</div>

<?php snippet('reference/entry/footer') ?>
