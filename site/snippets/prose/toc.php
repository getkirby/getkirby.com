<?php
$items = $field->toToc($tag ?? 'h2');
?>

<?php if($items->count() > 3): ?>
  <nav class="toc | -mb:large">

    <h2 class="h4">Table of Contents</h2>

    <ol>
      <?php foreach($items as $item): ?>
        <li>
          <a href="<?= $item->url() ?>">
            <span><?= widont($item->text()) ?></span>
          </a>
        </li>
      <?php endforeach ?>
    </ol>

  </nav>
<?php endif ?>
