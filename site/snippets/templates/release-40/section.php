<section id="<?= $section->slug() ?>" class="mb-42">
  <?php snippet('hgroup', [
    'title'    => $section->title(),
    'subtitle' => $section->subtitle(),
    'mb'       => 12
  ]) ?>

	<?php if (($snippet = $section->root() . '/snippet.php') && file_exists($snippet)): ?>
		<?php require_once $snippet ?>
	<?php else: ?>
		<a href="<?= $section->url() ?>">Read more …</a>
	<?php endif ?>

</section>
