<?php layout() ?>

<style>
.buzz-entries {
  --columns: 2;
}
@media screen and (min-width: 60rem) {
  .buzz-entries {
    --columns: 3;
  }
}
.buzz-entry {
  border-radius: var(--rounded);
  overflow: hidden;
}
.buzz-entry figure {
  align-self: end;
}
</style>

<article class="kosmos">
  <div class="mb-12">
    <header class="flex flex-column justify-between">
      <h1 class="h1 mb-12">What others say.<br>What we say.<br>The buzz.</h1>
    </header>
  </div>

  <section class="buzz-entries columns" style="--gap: var(--spacing-12)">
    <?php foreach($page->children()->listed()->flip() as $entry): ?>
    <?php snippet('templates/buzz/entry', ['entry' => $entry]) ?>
    <?php endforeach ?>
  </section>
</article>
