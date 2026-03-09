<?php layout('article') ?>

<?php snippet('kosmos/sidebar') ?>
<?php snippet('kosmos/header') ?>

<?php slot('toc') ?>
<?php snippet(
	'toc',
	[
		'title' => 'In this episode',
		'items' => $page->layouts()->toBlocks()->filterBy('type', 'heading')
	]) ?>
<?php endslot() ?>

<?php slot() ?>
<?php foreach ($page->layouts()->toLayouts() as $layout): ?>
	<section class="prose mb-24" id="<?= $layout->id() ?>">
		<?php foreach ($layout->columns() as $column): ?>
			<div class="column" style="--span:<?= $column->span() ?>">
				<div class="blocks">
					<?= $column->blocks() ?>
				</div>
			</div>
		<?php endforeach ?>
	</section>
<?php endforeach ?>
<?php endslot() ?>

<?php snippet('kosmos/footer') ?>

