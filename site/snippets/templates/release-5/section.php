<?php if (($snippet = $section->root() . '/section.php') && file_exists($snippet)): ?>
		<?php require_once $snippet ?>

<?php elseif (($snippet = $section->root() . '/snippet.php') && file_exists($snippet)): ?>
	<section id="<?= $section->slug() ?>" class="mb-42">
		<?php snippet('hgroup', [
			'title'    => $section->title(),
			'subtitle' => $section->subtitle(),
			'mb'       => 6
		]) ?>

		<?php require_once $snippet ?>
	</section>
<?php endif ?>
