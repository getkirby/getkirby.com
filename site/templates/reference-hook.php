<?php layout('reference') ?>

<div class="prose">
  <?= $page->content()->get('example')->or($page->example())->kt() ?>
  <?= $page->details()->kt() ?>
</div>
