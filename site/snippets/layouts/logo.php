<a class="logo" href="<?= $link ?? '/' ?>">
	<?= icon('icon') ?>
</a>

<?php if (
	option('archived') === true ||
	$page->is('docs/reference') ||
	$page->parents()->has('docs/reference') === true
): ?>
<p class="version <?php e(option('archived') === true, 'archived') ?>">
	<a class="font-bold" href="<?= page('/releases/' . $kirby->version())?->url() ?? option('github.url') . '/kirby/releases/' . $kirby->version() ?>">
		Kirby <span class="link tabular-nums"><?= $kirby->version() ?></span>
	</a>
</p>
<?php endif ?>
