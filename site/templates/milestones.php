<?php layout() ?>

<h1 class="h1 mb-24">Milestones</h1>

<ul>
  <?php foreach ($page->children()->flip() as $milestone): ?>
  <li class="mb-6">
    <a href="<?= $milestone->link()->toUrl() ?>">
      <h2 class="h2"><?= $milestone->title() ?></h2>
      <p class="font-mono text-sm mb-3"><?= date('d.m.Y', strtotime($milestone->num())) ?></p>
      <?php if ($image = $milestone->image()): ?>
        <img style="width: 10rem; aspect-ratio: 1/1; object-fit: cover" src="<?= $image->url() ?>">
      <?php endif ?>
    </a>
  </li>
  <?php endforeach ?>
</ul>
