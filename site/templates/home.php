<?php layout() ?>
<?= css('assets/css/layouts/home.css') ?>

<article>
	<div class="playground">
		<?php snippet('templates/home/playground/header') ?>
		<?php snippet('templates/home/playground/filesystem') ?>
		<?php snippet('templates/home/playground/backend') ?>
		<?php snippet('templates/home/playground/medium') ?>
		<?php snippet('templates/home/playground/audience') ?>
	</div>

	<div class="mb-56">
		<?php snippet('templates/home/brands') ?>
	</div>

	<div class="mb-56">
		<?php snippet('templates/home/voices') ?>
	</div>

	<div class="mb-24">
		<?php snippet('templates/home/updates') ?>
	</div>
</article>

<script type="module">
import { Playground } from "<?= url('/assets/js/layouts/playground.js') ?>";
new Playground();
</script>
