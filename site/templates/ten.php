<?php layout() ?>

<style>
  .avatar {
    background: var(--color-light);
    display: flex;
    padding: .5rem;
  }

  .avatar figcaption {
    font-size: var(--text-md) !important;
  }

  .avatar img {
    width: 9rem !important;
    height: 9rem !important;
    object-fit: cover;
    margin-right: 1rem;
  }

  .screenshot img {
    box-shadow: none !important;
  }
</style>

<article>
  <header class="h1 mb-42">
    <h1>10 years</h1>
    <p class="color-gray-500">Since 1.0.0</p>
  </header>

  <?php foreach ($page->children() as $year) : ?>
    <section class="columns mb-24" style="--columns: 12">
      <div style="--span: 2">
        <datetime class="sticky font-mono text-sm" style="--top: 1.5rem">
          <?= $year->title() ?>
        </datetime>
      </div>
      <div style="--span: 6">
        <div class="prose text-lg">
          <?= $year->text()->kt() ?>
        </div>
      </div>
    </section>
  <?php endforeach ?>

</article>
