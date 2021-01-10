<nav class="cheatsheet-sections cheatsheet-panel">
  <header class="cheatsheet-sections-header cheatsheet-panel-header">
    <button data-show="main">
      <svg viewBox="0 0 12 12" width="12" height="12"><title>e remove</title><g fill="#111111"><path d="M10.707,1.293a1,1,0,0,0-1.414,0L6,4.586,2.707,1.293A1,1,0,0,0,1.293,2.707L4.586,6,1.293,9.293a1,1,0,1,0,1.414,1.414L6,7.414l3.293,3.293a1,1,0,0,0,1.414-1.414L7.414,6l3.293-3.293A1,1,0,0,0,10.707,1.293Z" fill="#111111"></path></g></svg>
      Close
    </button>
  </header>
  <div class="cheatsheet-panel-scrollarea">
    <?php foreach ($kirby->collection('cheatsheet') as $group): ?>
    <section>
      <h2><a href="<?= $group->url() ?>"><?= $group->title() ?></a></h2>
      <ul>
        <?php foreach ($group->children()->listed() as $section): ?>
        <li>
          <a href="<?= $section->url() ?>"<?php e($section->isOpen(), ' aria-current="section"') ?>>
            <?= $section->title() ?>
          </a>
        </li>
        <?php endforeach ?>
      </ul>
    </section>
    <?php endforeach ?>
  </div>
</nav>
