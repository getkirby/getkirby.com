<!DOCTYPE html>
<html lang="en">
<head>
  <?php snippet('layouts/head') ?>
</head>
<body>
  <?php snippet('layouts/header') ?>

  <?php if ($icons = $page->file('icons.svg')): ?>
  <div class="hidden">
	<?= $icons->read() ?>
  </div>
  <?php endif ?>

  <main id="main" class="main">
	<div class="container">
	  <div class="with-sidebar">
		<article class="mb-24">
		  <?php slot('header') ?>
		  <header>
			<h1 class="h1 mb-12"><?php slot('h1') ?><?= $page->title() ?><?php endslot() ?></h1>
			<?php if ($page->intro()->isNotEmpty()): ?>
			<div class="prose mb-12">
			  <p class="intro">
				<?= $page->intro()->kti() ?>
			  </p>
			</div>
			<?php endif ?>
		  </header>
		  <?php endslot() ?>
		  <?php slot('toc') ?>
		  <?php snippet('toc') ?>
		  <?php endslot() ?>
		  <div class="prose mb-24">
			<?php slot() ?>
			<?= $page->text()->kt() ?>
			<?php endslot() ?>
		  </div>
		  <?php slot('footer') ?>
		  <footer>
			<?php snippet('layouts/github-edit') ?>
		  </footer>
		  <?php endslot() ?>
		</article>
		<?php slot('sidebar') ?>
		  <?php snippet('sidebar', [
			'title' => 'Kirby',
			'menu'  => collection('kirby')
		  ]) ?>
		<?php endslot() ?>
	  </div>
	</div>
  </main>
  <?php snippet('layouts/footer') ?>
</body>
</html>
