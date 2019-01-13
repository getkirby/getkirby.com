<ul>
  <?php foreach($pages as $item): ?>
    <li>
      <a href="<?= $item->url() ?>">
        <?= $item->title()->html() ?>
      </a>
    </li>
  <?php endforeach ?>
</ul>
