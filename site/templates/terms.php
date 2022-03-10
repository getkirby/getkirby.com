<?php layout('article') ?>

<?php slot('header') ?>
<style>
  .version-details {
    max-width: 45rem !important;
  }

  .version-details .h3 {
    font-size: var(--text-xl);
  }

  .version-details .btn {
    text-decoration: none;
  }

  mark {
    background: var(--color-yellow-300);
    display: inline-block; /* trim whitespace */
    padding: 0 var(--spacing-1);
  }
  .h3 mark {
    margin-left: var(--spacing-1);
  }

  .diff ins {
    color: var(--prose-color-highlight);
    background-color: var(--color-green-300);
    text-decoration: none;
  }

  .diff del, .diff del * {
    color: var(--color-red-800);
    background-color: var(--color-red-300);
    text-decoration: line-through;
    text-decoration-color: currentColor !important;
  }
</style>

<header>
  <h1 class="h1 mb-12"><?= $page->title() ?></h1>
  <?php if ($page->intro()->isNotEmpty()): ?>
  <div class="prose mb-12">
    <?php if ($introDiff): ?>
    <div class="diff">
      <?= $introDiff ?>
    </div>
    <?php else: ?>
    <?= $page->intro()->kt() ?>
    <?php endif ?>
  </div>
  <?php endif ?>
</header>

<aside class="version-details prose mb-24">
  <h2 id="version-details" class="h2 mb-6">
    <a href="#version-details">Version Details</a>
  </h2>

  <div class="columns" style="--columns: 9; --gap: var(--spacing-1);">
    <div class="bg-light p-3" style="--span: 2;">
      <h3 class="h3 mb-6">Published on</h3>

      <p class="text-base">
        <?= date('F j, Y', strtotime($page->uid())) ?>
      </p>
    </div>

    <div class="bg-light p-3" style="--span: 7;">
      <h3 class="h3 mb-6">Validity</h3>

      <div class="text-base">
        <?= $page->validity()->kt() ?>
      </div>
    </div>

    <?php if ($page->resources()->isNotEmpty()): ?>
    <div class="bg-light p-3" style="--span: 3;">
      <h3 class="h3 mb-6">Resources</h3>

      <div class="text-base">
        <?= $page->resources()->kt() ?>
      </div>
    </div>
    <?php endif ?>

    <div class="bg-light p-3" style="--span: <?= $page->resources()->isNotEmpty() ? 6 : 9 ?>;">
      <h3 class="h3 mb-6">
        Other versions

        <?php if ($textDiff): ?>
        <mark class="text-base">Showing differences</mark>
        <?php endif ?>
      </h3>

      <p class="text-base<?php if ($page->hasPrev()): ?> mb-6<?php endif ?>">
        <?php foreach ($siblings as $version): ?>
        <?php if ($version === $page): ?>
          <?php if ($textDiff): ?><mark><?php endif ?>
          <strong><?= $page->uid() ?></strong>
        <?php else: ?>
          <a href="<?= $version->url() ?>"><?= $version->uid() ?></a>
        <?php endif ?>

        <?php if ($textDiff && $version === $page): ?>
          ←
        <?php elseif ($textDiff && $version === $page->prev()): ?>
          </mark>
        <?php endif ?>

        <?php if ((!$textDiff || $version !== $page) && !$version->isLast($siblings)): ?>·<?php endif ?>
        <?php endforeach ?>
      </p>

      <?php if ($page->hasPrev() && $textDiff): ?>
      <a href="<?= $page->url() ?>" class="btn btn--outlined"><?= icon('flash') ?> Show just this version</a>
      <?php elseif ($page->hasPrev()): ?>
      <a href="<?= $page->url() ?>?diff" class="btn btn--outlined"><?= icon('forms') ?> Compare with previous version</a>
      <?php endif ?>
    </div>
  </div>
</aside>
<?php endslot() ?>

<?php slot() ?>
<?php if ($textDiff): ?>
<div class="diff">
  <?= $textDiff ?>
</div>
<?php else: ?>
<?= $page->text()->kt() ?>
<?php endif ?>
<?php endslot() ?>
