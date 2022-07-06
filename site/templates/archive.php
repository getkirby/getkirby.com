<?php layout() ?>

<article>

  <header class="mb-24">
		<h1 class="h1">
			Travel back in time
		</h1>
  </header>

  <ul class="columns items-center" style="--columns-sm: 1; --columns-md: 1; --columns-lg: 3; --gap: var(--spacing-12)">
	<li>
	  <article>
		<header class="mb-3">
		  <p class="h6 mb-1">2012-2014</p>
		  <h2 class="h2 border-top pt-3">Kirby 1</h2>
		</header>
		<div class="color-gray-700 mb-12">
		  <p>Kirby 1 has reached its end of life and is no longer supported by us.</p>
		</div>
		<div class="columns" style="--columns: 2">
		  <a aria-label="Visit the Kirby 1 docs" href="https://k1.getkirby.com/docs" class="btn btn--outlined">
			<?= icon('book') ?>
			Docs
		  </a>
		  <a aria-label="The Kirby 1 repository on Github" href="https://github.com/getkirby-v1" class="btn btn--outlined">
			<?= icon('github') ?>
			Source
		  </a>
		</div>
	  </article>
	</li>
	<li>
	  <article>
		<header class="mb-3">
		  <p class="h6 mb-1">2014-2020</p>
		  <h2 class="h2 border-top pt-3">Kirby 2</h2>
		</header>
		<div class="color-gray-700 mb-12">
		  <p>Kirby 2 has reached its end of life and is no longer supported by us.</p>
		</div>
		<div class="columns" style="--columns: 2">
		  <a aria-label="Visit the Kirby 2 docs" href="https://k2.getkirby.com/docs" class="btn btn--outlined">
			<?= icon('book') ?>
			Docs
		  </a>
		  <a aria-label="The Kirby 2 repository on Github" href="https://github.com/getkirby-v2" class="btn btn--outlined">
			<?= icon('github') ?>
			Source
		  </a>
		</div>
	  </article>
	</li>
	<li>
	  <article class="p-6 bg-white shadow-2xl">
		<header class="mb-3">
		  <p class="h6 mb-1">Since 2019</p>
		  <h2 class="h2 border-top pt-3">Kirby 3</h2>
		</header>
		<div class="color-gray-700 mb-12">
		  <p>Kirby 3 is the latest version of Kirby. <br><strong class="color-black">Start new projects with Kirby 3!</strong></p>
		</div>
		<div class="columns" style="--columns: 2">
		  <a aria-label="Visit the Kirby 3 docs" href="/docs" class="btn btn--filled">
			<?= icon('book') ?>
			Docs
		  </a>
		  <a aria-label="The Kirby 3 repository on Github" href="https://github.com/getkirby" class="btn btn--filled">
			<?= icon('github') ?>
			Source
		  </a>
		</div>
	  </article>
	</li>
  </ul>

</article>
