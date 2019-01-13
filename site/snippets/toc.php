<?php if($item->count() > 3): ?>
  <nav class="toc | -mb:large">

    <h2 class="h4">Table of Contents</h2>

    <ol>
      <?php foreach($item as $headline): ?>
        <li><a href="<?= $headline->url() ?>"><span><?= $headline->text() ?></span></a></li>
      <?php endforeach ?>
    </ol>

  </nav>
<?php endif ?>
