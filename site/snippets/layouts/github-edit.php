<?php if ($kirby->option('archived') !== true): ?>
	<hr class="hr mb-6">

	<p class="prose text-sm mb-6 max-w-xs">
		Did you find an error? Help us improve our docs and edit this page on GitHub. Make sure to check out
		<a href="/styleguide">
			our styleguide
			<span aria-hidden="true">&rarr;</span>
		</a>
	</p>

	<?php if (F::exists($page->root() . '/' . $page->intendedTemplate() . '.txt')): ?>
	<a href="<?= option('github.url') ?>/getkirby.com/edit/main/content/<?= $page->diruri() ?>/<?= $page->intendedTemplate() ?>.txt" class="btn btn--outlined mb-3">
		<?= icon('github') ?> Edit this page <span class="sr-only">on GitHub</span>
	</a>
	<?php else: ?>
	<a href="<?= option('github.url') ?>/getkirby.com/issues/new?template=reference.md" class="btn btn--outlined mb-3">
		<?= icon('github') ?> Report an issue on this page <span class="sr-only">on GitHub</span>
	</a>
	<?php endif ?>
<?php endif ?>
