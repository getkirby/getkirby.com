<?php layout() ?>

<style>
  .vignette {
    position: relative;
  }

  .vignette:after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    box-shadow: inset 0px 0px 150px rgba(0,0,0, .75);
  }
</style>


<h1 class="h1 mb-12">Memory lane</h1>

<ul class="columns" style="--columns: 4">
  <?php foreach ($page->children()->flip() as $milestone) : ?>
    <li>
      <a class="block bg-white p-3 shadow-xl" href="<?= $milestone->link()->toUrl() ?>">
        <p class="bg-dark mb-3 vignette" style="--aspect-ratio: 1/1">
          <?php if ($image = $milestone->image()) : ?>
            <img style="object-fit: cover" src="<?= $image->url() ?>">
          <?php endif ?>
        </p>
        <h2 class="font-bold"><?= $milestone->title() ?></h2>
        <p class="font-mono text-sm color-gray-600"><?= date('d.m.Y', strtotime($milestone->num())) ?></p>
      </a>
    </li>
  <?php endforeach ?>
</ul>
