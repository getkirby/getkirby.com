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
	padding-right: 1rem;
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
	<h2 class="h3 mb-12">9.99 years and counting …</h2>
	<div class="">
		<ul class="roadmap flex justify-between mb-6">
			<li style="flex-grow: 1">
				<p class="font-bold">beta</p>
				<p class="font-mono text-xs">early '11</p>
			</li>
			<li style="flex-grow: 2">
				<p class="font-bold">1.0</p>
				<p class="font-mono text-xs">Jan '12</p>
			</li>
			<li style="flex-grow: 5">
				<p class="font-bold">2.0</p>
				<p class="font-mono text-xs">Mid '14</p>
			</li>
			<li style="flex-grow: 3">
				<p class="font-bold">3.0</p>
				<p class="font-mono text-xs">Jan '19</p>
			</li>
			<li>
				<p class="font-bold" style="white-space: nowrap">10 years 🎉</p>
				<p class="font-mono text-xs">Jan '22</p>
			</li>
			<li></li>
		</ul>
	</div>
</section>

<section class="mb-24">
	<h2 class="h3 mb-6">Community</h2>

	<ul class="columns color-white mb-1" style="--columns-sm: 2; --columns-md: 3; --columns: 5; --gap: var(--spacing-1)">
		<li class="bg-dark p-6">
			<a class="block" href="https://forum.getkirby.com">
				<span class="block text-2xl" style="color: var(--color-yellow-500)">3,888</span>
				<span class="font-mono text-xs"> Forum users</span>
			</a>
		</li>
		<li class="bg-dark p-6">
			<a class="block" href="https://chat.getkirby.com">
				<span class="block text-2xl" style="color: var(--color-purple-400)">1,312</span>
				<span class="font-mono text-xs"> Discord users</span>
			</a>
		</li>
		<li class="bg-dark p-6">
			<div class="block">
				<span class="block text-2xl" style="color: var(--color-blue-400)">5,827</span>
				<span class="font-mono text-xs"> Twitter followers</span>
			</div>
		</li>
		<li class="bg-dark p-6">
			<a class="block" href="https://videos.getkirby.com">
				<span class="block text-2xl" style="color: var(--color-red-500)">1,100</span>
				<span class="font-mono text-xs"> Youtube subscribers</span>
			</a>
		</li>
		<li class="bg-dark p-6">
			<a class="block" href="/kosmos">
				<span class="block text-2xl" style="color: var(--color-green-400)">3,400</span>
				<span class="font-mono text-xs"> Newsletter recipients</span>
			</a>
		</li>
	</ul>
</section>

<section class="mb-24">
	<h2 class="h3 mb-6"><?= count($releases) ?> new releases in 2021</h2>

	<ul class="columns" style="--columns-sm: 2; --columns-md: 3; --columns: 5; --gap: var(--spacing-1)">
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
		<li class="bg-light p-6">
			<a class="block" href="<?= option('github.url') ?>/kirby">
				<span class="block text-2xl">612</span>
				<span class="font-mono text-xs"> stars</span>
			</a>
		</li>
	</ul>

	<ul class="mb-6 columns font-mono text-sm" style="--columns-sm: 2; --columns-md: 3; --columns: 5; --gap: var(--spacing-1)">
		<?php foreach ($releases as $release): ?>
		<li>
			<a class="block bg-white p-3" href="<?= option('github.url') ?>/kirby/releases/tag/<?= $release['name'] ?>">
				🚀 <?= $release['name'] ?>
			</a>
		</li>
		<?php endforeach ?>
	</ul>
</section>

<section class="mb-24">
	<h2 class="h3 mb-6"><?= count($contributors) ?> contributors in 2021</h2>
	<ul class="columns text-sm" style="--columns-sm: 2; --columns-md: 3; --columns: 5; --gap: var(--spacing-3)">
		<?php foreach ($contributors as $contributor): ?>
		<li>
			<a class="flex items-center" href="https://github.com/<?= $contributor ?>">
				<?php if ($image = $page->image($contributor . '.png')): ?>
				<img alt="" src="<?= $image->crop(64)->url() ?>" class="bg-black mr-3" style="width: 2rem; --aspect-ratio: 1/1">
				<?php endif ?>
				<?= $contributor ?>
			</a>
		</li>
		<?php endforeach ?>
	</ul>
</section>

<section class="mb-24">
	<h2 class="h3 mb-6">2 online events in 2021</h2>

	<div class="columns bg-dark highlight color-white" style="--columns-sm: 1; --columns-md: 1; --columns: 2; --gap: var(--spacing-12)">
		<article class="bg-black">
			<figure class="video" style="--aspect-ratio: 16/9">
				<?= video('https://www.youtube.com/watch?v=QgCMc89rdNY', $page->image('youtube-36.jpg'), [], [
					'loading' => 'lazy',
					'title' => 'YouTube video of the 3.6 release show'
				]) ?>
			</figure>
			<header class="p-3">
				<h3 class="h4">3.6 release show</h3>
				<p class="h6 color-gray-500">26th November 2021</p>
			</header>
		</article>
		<article class="bg-black">
			<figure class="video" style="--aspect-ratio: 16/9">
				<?= video('https://www.youtube-nocookie.com/watch?v=-zrgqExDS68', $page->image('youtube-lowa.jpg'), [], [
					'loading' => 'lazy',
					'title' => 'YouTube video of the Kirby in the Wild event'
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
	<h2 class="h3 mb-6"><?= $authors->count() ?> cookbook authors</h2>
	<ul class="columns text-sm" style="--columns-sm: 2; --columns-md: 3; --columns: 4; --gap: var(--spacing-3)">
		<?php foreach ($authors as $author): ?>
		<li>
			<a class="flex items-center" href="<?= $author->website() ?>">
				<?php if ($image = $author->image()): ?>
				<img alt="" src="<?= $image->crop(64)->url() ?>" class="bg-black mr-3" style="width: 2rem; --aspect-ratio: 1/1">
				<?php endif ?>
				<?= $author->title() ?>
			</a>
		</li>
		<?php endforeach ?>
	</ul>
</section>

<section class="mb-24">
	<h2 class="h3 mb-6"><?= $issues->count() ?> new Kosmos issues in 2021</h2>
	<div class="highlight bg-dark columns text-sm" style="--columns-sm: 1; --columns-md: 3; --columns: 4; --gap: var(--spacing-6)">
		<?php foreach ($issues as $issue): ?>
		<?php snippet('templates/kosmos/issue', compact('issue')) ?>
		<?php endforeach ?>
	</div>
</section>

<section class="mb-42">
	<h2 class="h3 mb-6"><?= $plugins->count() ?> new plugins in 2021</h2>
	<ul class="columns" style="--columns-sm: 2; --columns-md: 2; --columns: 4; --gap: var(--spacing-4)">
		<?php foreach ($plugins as $plugin): ?>
		<li>
			<a class="flex items-center" href="<?= $plugin->url() ?>">
				<div class="truncate">
					<h3 class="text-sm truncate"><?= $plugin->title() ?></h3>
				</div>
			</a>
		</li>
		<?php endforeach ?>
	</ul>
</section>

<footer class="h3 max-w-xl">
	Thank you for your support 💛<br>
	<br>
	The Kirby Team
</footer>
