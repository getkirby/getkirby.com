<?php layout() ?>

<style>
.roadmap {
  position: relative;
}
.roadmap::after,
.roadmap li::after {
  position: absolute;
  left: 1.5rem;
  right: 0;
  bottom: -.75rem;
  content: "";
  height: 2px;
  background: var(--color-black);
}
.roadmap li {
  position: relative;
}
.roadmap li::after {
  width: 2px;
  height: .75rem;
  right: auto;
}
.roadmap li:last-child::after {
  background: none;
  left: auto;
  right: 0;
  width: auto;
  height: auto;
  bottom: calc(-.75rem - 5px);
  border-top: 6px solid transparent;
  border-left: 6px solid var(--color-black);
  border-bottom: 6px solid transparent;
}
</style>

<header class="mb-24">
  <h1 class="h1">The state of Kirby</h1>
  <h2 class="h1 color-gray-400">December 2021</h2>
</header>

<section class="mb-24">
  <h2 class="h3 mb-6">The Kirby community</h2>

  <ul class="columns" style="--columns-sm: 4; --columns: 5; --gap: var(--spacing-1)">
    <li class="bg-white p-6">
      <span class="block text-2xl" style="color: var(--color-aqua-600)">3,888</span>
      <span class="font-mono text-xs"> forum users</span>
    </li>
    <li class="bg-white p-6">
      <span class="block text-2xl" style="color: var(--color-purple-500)">1,312</span>
      <span class="font-mono text-xs"> discord users</span>
    </li>
    <li class="bg-white p-6">
      <span class="block text-2xl" style="color: var(--color-blue-500)">5,827</span>
      <span class="font-mono text-xs"> Twitter followers</span>
    </li>
    <li class="bg-white p-6">
      <span class="block text-2xl" style="color: var(--color-red-500)">1,100</span>
      <span class="font-mono text-xs"> Youtube subscribers</span>
    </li>
    <li class="bg-white p-6">
      <span class="block text-2xl" style="color: var(--color-green-700)">30,350</span>
      <span class="font-mono text-xs"> Created demos</span>
    </li>
  </ul>
</section>

<section class="mb-24">
  <h2 class="h3 mb-6"><?= count($releases) ?> new releases in 2021</h2>

  <ul class="columns" style="--columns-sm: 4; --columns: 5; --gap: var(--spacing-1)">
    <li class="bg-light p-6">
      <span class="block text-2xl">1,939</span>
      <span class="font-mono text-xs"> commits</span>
    </li>
    <li class="bg-light p-6">
      <span class="block text-2xl">391</span>
      <span class="font-mono text-xs"> closed issues</span>
    </li>
    <li class="bg-light p-6">
      <span class="block text-2xl">544</span>
      <span class="font-mono text-xs"> merged PRs</span>
    </li>
    <li class="bg-light p-6">
      <span class="block text-2xl">20</span>
      <span class="font-mono text-xs"> contributors</span>
    </li>
  </ul>

  <ul class="mb-6 columns font-mono text-sm" style="--columns: 5; --gap: var(--spacing-1)">
    <?php foreach ($releases as $release): ?>
    <li>
      <a class="block bg-white p-3" href="https://github.com/getkirby/kirby/releases/tag/<?= $release['name'] ?>">
        🚀 <?= $release['name'] ?>
      </a>
    </li>
    <?php endforeach ?>
  </ul>
</section>

<section class="mb-24">
  <h2 class="h3 mb-6"><?= count($contributors) ?> contributors in 2021</h2>
  <ul class="columns text-sm" style="--columns: 5; --gap: var(--spacing-3)">
    <?php foreach ($contributors as $contributor): ?>
    <li>
      <a class="flex items-center" href="https://github.com/<?= $contributor ?>">
        <?php if ($image = $page->image($contributor . '.png')): ?>
        <img src="<?= $image->crop(64)->url() ?>" class="bg-black mr-3" style="width: 2rem; --aspect-ratio: 1/1">
        <?php endif ?>
        <?= $contributor ?>
      </a>
    </li>
    <?php endforeach ?>
  </ul>
</section>

<section class="mb-24">
  <h2 class="h3 mb-6">2 online events in 2021</h2>

  <div class="columns bg-dark highlight color-white" style="--columns: 2; --gap: var(--spacing-12)">
    <article class="bg-black">
      <figure class="video" style="--aspect-ratio: 16/9">
        <?= video('https://www.youtube.com/watch?v=QgCMc89rdNY', [
          'youtube' => [
            'controls'       => 0,
            'modestbranding' => 1,
            'showinfo'       => 0,
            'rel'            => 0,
          ]
        ], [
          'loading' => 'lazy'
        ]) ?>
      </figure>
      <header class="p-3">
        <h3 class="h4">3.6 release show</h3>
        <p class="h6 color-gray-500">26th November 2021</p>
      </header>
    </article>
    <article class="bg-black">
      <figure class="video" style="--aspect-ratio: 16/9">
        <?= video('https://www.youtube-nocookie.com/watch?v=-zrgqExDS68', [
          'youtube' => [
            'controls'       => 0,
            'modestbranding' => 1,
            'showinfo'       => 0,
            'rel'            => 0,
          ]
        ], [
          'loading' => 'lazy'
        ]) ?>
      </figure>
      <header class="p-3">
        <h3 class="h4">Kirby in the Wild: Content First at LOWA</h3>
        <p class="h6 color-gray-500">3rd June 2021</p>
      </header>
    </article>
  </div>

</section>

<section class="mb-24">
  <h2 class="h3 mb-6"><?= $recipes->count() ?> new cookbook articles in 2021</h2>
  <ul class="columns text-sm" style="--columns: 2; --gap: var(--spacing-1)">
    <?php foreach ($recipes as $recipe): ?>
    <li>
      <a class="block bg-white p-3 truncate" href="<?= $recipe->url() ?>">📔 <?= $recipe->title() ?></a>
    </li>
    <?php endforeach ?>
  </ul>
</section>

<section class="mb-24">
  <h2 class="h3 mb-6"><?= $issues->count() ?> new Kosmos issues in 2021</h2>
  <div class="highlight bg-dark columns text-sm" style="--columns: 4; --gap: var(--spacing-6)">
    <?php foreach ($issues as $issue): ?>
    <?php snippet('templates/kosmos/issue', compact('issue')) ?>
    <?php endforeach ?>
  </div>
</section>

<section class="mb-42">
  <h2 class="h3 mb-6"><?= $plugins2021->count() ?> new plugins in 2021</h2>
  <ul class="columns" style="--columns: 4; --gap: var(--spacing-6)">
    <?php foreach ($plugins2021 as $plugin): ?>
    <li>
      <a class="flex items-center" href="<?= $plugin->url() ?>">
        <figure class="iconbox bg-black color-white mr-3">
          <?= icon($plugin->icon()) ?>
        </figure>
        <div>
          <h3 class="text-sm"><?= $plugin->title() ?></h3>
          <p class="block font-mono text-xs color-gray-500">
            by <span class="color-black"><?= $plugin->parent()->title() ?></span>
          </p>
        </div>
      </a>
    </li>
    <?php endforeach ?>
  </ul>
</section>

<footer class="h3 max-w-xl">
  Thank you for a very successful year 💛
  <br><br>
  The Kirby Team
</footer>

