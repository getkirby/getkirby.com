<?php snippet('header', [ 'background' => 'dark' ]) ?>

  <main class="issue-page | main" id="maincontent">
    <article>

      <!-- # Hero Section -->

      <header class="issue-hero | hero | -align:center">
        <h1 class="-mb:0">
          <a href="<?= url('kosmos') ?>">Kirby Kosmos</a><br>
        </h1>
        <nav class="issue-nav h1">
          <?php if ($next = $page->nextListed()): ?>
          <a class="issue-nav-button issue-nav-next" aria-label="Next issue" href="<?= $next->url() ?>"><?php icon('chevron-left') ?></a>
          <?php else: ?>
          <span class="issue-nav-button issue-nav-next"><?php icon('chevron-left') ?></span>
          <?php endif ?>

          <span class="issue-nav-index"><?= $page->uid() ?></span>

          <?php if ($prev = $page->prevListed()): ?>
          <a class="issue-nav-button issue-nav-prev" aria-label="Previous issue" href="<?= $prev->url() ?>"><?php icon('chevron-right') ?></a>
          <?php else: ?>
          <span class="issue-nav-button issue-nav-prev"><?php icon('chevron-right') ?></span>
          <?php endif ?>
        </nav>
      </header>

      <!-- # Article Content -->
      <div class="issue-body">
        <div class="text">
          <?= $page->text()->kt()->anchorHeadlines() ?>
        </div>
      </div>

    </article>

  </main>

<?php snippet('footer', ['theme' => 'dark']) ?>
