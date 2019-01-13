<ul class="voices">
  <?php foreach(page('voices')->children()->listed()->shuffle()->limit(9) as $item): ?>
    <li>
      <blockquote class="voice">
        <footer class="voice-source">
          <a href="<?= $item->url() ?>">
            <?php if($image = $item->image()): ?>
            <?= $image->html(['alt' => 'Avatar of ' . $item->title()]); ?>
            <?php endif ?>
            <div>
              <h3 class="voice-author"><?= $item->title()->html() ?></h3>
            </div>
          </a>
        </footer>
        <div class="voice-text | text">
          <?= $item->text() ?>
        </div>
      </blockquote>
    </li>
  <?php endforeach ?>
</ul>
