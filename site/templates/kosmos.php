<?php layout() ?>

<style>
.issues {
  --min: 10rem;
  --gap: var(--container-padding);
}
@media screen and (min-width: 40rem) {
  .issues {
    --min: 20rem;
  }
}
</style>

<article class="kosmos">
  <div class="columns mb-42" style="--columns: 2; --gap: var(--spacing-12)">
    <header class="flex flex-column justify-between">
      <h1 class="h1 mb-12">Kosmos is our monthly newsletter about Kirby and the&nbsp;web</h1>
      <?php snippet('voice', ['voice' => page('voices/ryan-gorley')]) ?>
    </header>
    <?php snippet('templates/kosmos/form') ?>

  </div>

  <div class="w-full p-container bg-dark">
    <h2 class="h2 mb-24 color-white text-center">Past episodes</h2>
    <ul class="issues auto-fill">
      <?php foreach ($page->children()->flip() as $issue): ?>
      <li class="shadow-2xl">
        <?php snippet('templates/kosmos/issue', ['issue' => $issue]) ?>
      </li>
      <?php endforeach ?>
    </ul>
  </div>
</article>
