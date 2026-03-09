<?php slot('header') ?>
	<header class="mb-12">
		<h1 class="h1 mb-1">Episode <?= $page->slug() ?></h1>
		<date><?= $page->date()->toDate('d M Y') ?></date>
	</header>
<?php endslot() ?>
