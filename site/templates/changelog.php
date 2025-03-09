<?php layout('article') ?>

<?php slot('sidebar') ?>
<nav aria-label="Changelog menu">
	<div class="sidebar sticky" style="--top: var(--spacing-6)">
		<p class="h1 color-gray-400 mb-12"><a href="/changelog">Changelog</a>
		</p>
		<ul class="filters">
			<?php foreach ($releases as $release): ?>
				<li>
					<a
						href="<?= 'changelog#version-' . $release->versionField()->slug() ?>" <?= ariaCurrent($release->slug() === 'changelog') ?>>
						<?= $release->title() ?>
					</a>
				</li>
			<?php endforeach ?>

		</ul>
	</div>
</nav>
<?php endslot() ?>

<?php slot() ?>
<section>
	<?php foreach ($releases as $release): ?>
		<article class="mb-12" style="--span: 12">
			<header class="mb-6">
				<h2 class="h2" id="<?= 'version-' . $release->versionField()->slug() ?>"
						class="h2">Kirby <?= $release->versionField() ?></h2>
			</header>

			<?php if ($release->changelogBreaking()->isNotEmpty()): ?>
			<div class="mb-12">
				<h3 class="h3 mb-6">Breaking</h3>
				<div class="prose text-sm">
					<?= $release->changelogBreaking()->kt() ?>
				</div>
			</div>
			<?php endif ?>

			<?php if ($release->changelogDeprecated()->isNotEmpty()): ?>
			<div class="mb-12">
				<h3 class="h3 mb-6">Deprecated</h3>
				<div class="prose text-sm">
					<?= $release->changelogDeprecated()->kt() ?>
				</div>
			</div>
			<?php endif ?>

			<?php if ($release->migrationGuides()->isNotEmpty()): ?>
			<div class="mb-12">
				<h3 class="h3 mb-6">Migration Guides</h3>
				<ul>
					<?php foreach ($release->migrationGuides()->toPages() as $link): ?>
					<li><a href="<?= $link->url() ?>"><?= $link->title() ?></a></li>
					<?php endforeach ?>
				</ul>
			</div>
			<?php endif ?>
		</article>
	<?php endforeach ?>
</section>
<?php endslot() ?>

<?php slot('footer') ?>
<footer class="h2 max-w-xl">
	Full list of features of <a href="/releases"><span class="link">all releases</span> &rarr;</a>
</footer>
<?php endslot() ?>
