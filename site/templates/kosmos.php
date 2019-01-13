<?php snippet('header', ['background' => 'dark']) ?>

  <main class="kosmos-page | main" id="maincontent">
    <div class="wrap">
      <?php snippet('hero', ['align' => 'left', 'theme' => 'dark']) ?>
      <?php snippet('kosmos-form') ?>

      <h2 class="h3 | -color:yellow-on-dark">All issues</h2>
      <?php snippet('kosmos-issues', ['issues' => $page->children()->listed()->flip()]) ?>
    </div>
  </main>

<?php snippet('footer', ['theme' => 'dark']) ?>
