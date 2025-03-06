<?php
extract([
	'since'    => $page->since(),
	'alias'    => $page->alias(),
	'auth'     => $page->auth(),
	'guide'    => $page->guide(),
	'source'   => $source ?? $page->onGitHub(),
	'hasClass' => $page instanceof ReferenceClassPage || (
		$page instanceof ReferenceClassmethodPage &&
		$page->name() === '__construct'
	),
]);
?>

<?php if(
	$since->isNotEmpty() ||
	$hasClass ||
	$alias->isNotEmpty() ||
	$auth->isNotEmpty() ||
	$guide->isNotEmpty() ||
	$source->isNotEmpty()
): ?>
<ul class="reference-meta">
	<?php if ($since->isNotEmpty()): ?>
	<li class="since">Since <?= version($since) ?></li>
	<?php endif ?>

	<?php if ($hasClass): ?>
	<li>Full class name: <code><?= $page->class() ?></code></li>
	<?php endif ?>

	<?php if ($alias->isNotEmpty()): ?>
	<li>Alias: <code><?= ucfirst($alias) ?></code></li>
	<?php endif ?>

	<?php if ($auth->isNotEmpty()): ?>
	<li>
		<a href="<?= url('docs/guide/users/permissions') ?>">
			<?= icon('lock') ?>
			<?= $auth ?>
		</a>
	</li>
	<?php endif ?>

	<?php if ($guide->isNotEmpty()): ?>
	<li>
		<a href="<?= url('docs/guide/' . $guide) ?>">
			<?= icon('book') ?>
			Read the guide
		</a>
	</li>
	<?php endif ?>

	<?php if ($source->isNotEmpty()): ?>
	<li>
		<a href="<?= $source ?>">
			<?= icon('code') ?>
			kirby/<?= Str::after($source, 'tree/' . Kirby::version() . '/') ?>
		</a>
	</li>
	<?php endif ?>
</ul>
<?php endif ?>

<?php if ($page->deprecated()->isNotEmpty()): ?>
<?php $deprecated = $page->deprecated()->split('|') ?>
<div class="prose">
	<div class="box box--alert">
		<figure class="box-icon iconbox bg-black color-white">
			<?= icon('alert') ?>
		</figure>
		<div class="box-text">
			<div class="font-bold">
				Deprecated
				<?php if ($version = $deprecated[0] ?? null): ?>
				in <?= version($version, '%s') ?>
				<?php endif ?>
			</div>
			<?php if (count($deprecated) > 1): ?>
			<?= kti($deprecated[1]) ?>
			<?php endif ?>
		</div>
	</div>
</div>
<?php endif ?>
