<?php layout('reference') ?>

<?php foreach ($kirby->collection('reference') as $group): ?>
<section class="mb-24">
	<h2 class="h2 mb-12" id="<?= $group->slug() ?>"><?= $group->title() ?></h2>

	<?php
	foreach ($group->children()->listed() as $section):

	if ($section->intendedTemplate()->name() === 'reference-quicklink') {
		$section = $section->link()->toPage();
	}

	$children = $section->children()->listed();

	if ($children->count() > 0):
	?>
	<section>
		<h3 class="text-sm font-bold mb-3" id="<?= $section->slug() ?>">
			<a href="#<?= $section->slug() ?>">
				<?= $section->title() ?>
			</a>
		</h3>
		<?php snippet('templates/reference/section', $children) ?>
		</section>
	<?php endif ?>
	<?php endforeach ?>
</section>
<?php endforeach ?>
