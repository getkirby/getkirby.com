<?php snippet('cheatsheet.article.header') ?>

  <div class="text">
    <h2 id="example"><a href="#example">Example</a></h2>
    <?= $page->example()->kt() ?>

    <h2 id="custom-setup"><a href="#custom-setup">Custom Url setup</a></h2>
    <?= $page->parent()->custom()->replace(['url' => $page->slug()])->kt() ?>

    <?= $page->text()->kt() ?>
  </div>

  <?php snippet('github.edit') ?>

<?php snippet('cheatsheet.article.footer') ?>
