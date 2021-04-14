<style>
  .ingrid {
    display: grid;
    grid-template-columns: repeat(12, 1fr);
    grid-template-rows: repeat(4, min-content);
    grid-gap: clamp(var(--spacing-2px), 1.5vw, var(--spacing-6));
  }
  .ingrid figure {
    background: var(--color-light);
  }
</style>

<div class="ingrid">
  <div style="grid-column: span 6; align-self: flex-end">
    <?php snippet('img', ['image' => image('author.png')]) ?>
  </div>
  <div style="grid-column: span 6; align-self: flex-end">
    <?php snippet('img', ['image' => image('list.png')]) ?>
  </div>
  <div style="grid-column: span 12">
    <?php snippet('img', ['image' => image('images.png')]) ?>
  </div>
  <div style="grid-column: span 9">
    <?php snippet('img', ['image' => image('structure.png')]) ?>
  </div>
  <div style="grid-column: span 6">
    <?php snippet('img', ['image' => image('albums.png')]) ?>
  </div>
</div>
