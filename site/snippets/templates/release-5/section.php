<?php if (($snippet = $section->root() . '/section.php') && file_exists($snippet)): ?>
		<?php require_once $snippet ?>

<?php elseif (($snippet = $section->root() . '/snippet.php') && file_exists($snippet)): ?>
	<section id="<?= $section->slug() ?>" class="mb-42">
		<header class="max-w-xl mb-<?= $mb ?? 6 ?>">
			<div class="flex items-center" style="gap: var(--spacing-3)">
				<h2 class="h2"><?= widont($section->title()) ?></h2>

				<?php if ($section->upcoming()->toBool()): ?>
				<span class="text-xs bg-yellow rounded p-1">Coming soon</span>
				<?php endif ?>
			</div>

			<?php if ($subtitle = $section->subtitle()->value()): ?>
			<p class="h2 color-gray-600"><?= widont($subtitle) ?></p>
			<?php endif ?>

		</header>

		<?php require_once $snippet ?>
	</section>
<?php endif ?>
