<?php snippet('header') ?>

  <main class="try-page | main" id="maincontent">
    <article class="wrap">

      <header class="hero -align:center">
        <h1>Try Kirby for free</h1>
        <div class="intro">
          <?= $page->intro()->kt() ?>
        </div>
      </header>

      <?php if ($statusType && $statusMessage): ?>
      <div aria-labelledby="try-status-label" class="status -type:<?= $statusType ?>">
        <?= icon(r($statusType === 'status', 'check', 'warning'), true) ?>
        <p class="screen-reader-text" id="try-status-label"><strong><?= r($statusType === 'status', 'Status', 'Error') ?>:</strong></p>
        <p><?= $statusMessage ?></p>
      </div>
      <?php endif ?>

      <div class="links -mb:huge -align:center">
        <?php foreach ($page->links()->toStructure() as $link) : ?>
          <?php if ($link->action()->isNotEmpty()): ?>
          <form action="<?= $link->action() ?>" method="POST" class="demo">
            <button type="submit" class="cta">
              <?= icon($link->icon(), true) ?><!--
              --><span class="cta-text"><?= $link->text() ?></span>
            </button>

            <?= $link->description() ?>
          </form>
          <?php else: ?>
          <p>
            <?php snippet('cta', [
              'link' => $link->link(),
              'text' => $link->text(),
              'icon' => $link->icon(),
            ]) ?>
            <?= $link->description() ?>
          </p>
          <?php endif ?>
        <?php endforeach ?>
      </div>

      <figure class="starterkit">
        <a href="https://download.getkirby.com" class="intrinsic" style="padding-bottom: 164.5%">
          <?= $page->image('starterkit.jpg')->resize(800)->html(['alt' => 'The home page of Kirby\'s starterkit']) ?>
        </a>
      </figure>

      <div class="text description">
        <?= $page->text()->kt() ?>
      </div>

    </article>
  </main>

<?php snippet('footer') ?>
