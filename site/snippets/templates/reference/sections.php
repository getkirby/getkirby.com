<?php foreach ($sections as $section):

if ($section->intendedTemplate()->name() === 'reference-quicklink') {
	$section = $section->link()->toPage();
}

$children = $section->children()->listed();

if ($children->count() > 0): ?>
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
