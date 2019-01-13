<?php if($item->pages() > 0): ?>

  <nav class="pagination">

    <?php snippet('arrow-link', [
        'link'      => ($item->hasPrevPage() ? $item->prevPageURL() : null),
        'text'      => 'Prev<span class="pagination-label-page"> page</span>',
        'direction' => 'left',
        'disabled'  => !$item->hasPrevPage(),
        'rel'       => 'prev',
      ]) ?>

    <span class="hide-if-css">|</span>

    Page <?= $item->page() ?>&thinsp;/&thinsp;<?= $item->pages() ?>

    <span class="hide-if-css">|</span>

    <?php snippet('arrow-link', [
      'link'      => ($item->hasNextPage() ? $item->nextPageURL() : null),
      'text'      => 'Next<span class="pagination-label-page"> page</span>',
      'direction' => 'right',
      'disabled'  => !$item->hasNextPage(),
      'rel'       => 'next',
    ]) ?>
  </nav>

<?php endif ?>
