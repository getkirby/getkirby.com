<?php

use Kirby\Cms\App;
use Kirby\Content\Field;
use Kirby\Reference\Reflectable\ReflectableClass;
use Kirby\Reference\Reflectable\Tags\Since;
use Kirby\Toolkit\Str;

$reflection = $page->reflection();
$since      = $page->since();

// consider content field as since tag
if ($since instanceof Field && $version = $since->value()) {
	$since = new Since($version);
}

// prevent false positives from empty content fields
if ($reflection instanceof Field) {
	$reflection = null;
}
?>

<!-- Meta list -->
<ul class="reference-meta">
	<?php if ($since instanceof Since): ?>
	<li class="since">Since <?= $since->toHtml() ?></li>
	<?php endif ?>

	<?php if ($reflection instanceof ReflectableClass): ?>
	<li>Full class name: <code><?= $reflection->name(short: false) ?></code></li>
	<?php endif ?>

	<?php if ($alias = $reflection?->alias()): ?>
	<li>Alias: <code><?= ucfirst($alias) ?></code></li>
	<?php endif ?>

	<?php if ($page->auth()->isNotEmpty()): ?>
	<li>
		<a href='<?= url('docs/guide/users/permissions') ?>'>
			<?= icon('lock') ?>
		 <?= $page->auth() ?>
		</a>
	</li>
	<?php endif ?>

	<?php if ($page->guide()->isNotEmpty()): ?>
	<li>
		<a href="<?= url('docs/guide/' . $page->guide()) ?>">
			<?= icon('book') ?>
			Read the guide
		</a>
	</li>
	<?php endif ?>

	<?php if ($source = $reflection?->source()): ?>
	<li>
		<a href="<?= $source ?>">
			<?= icon('code') ?>
			kirby/<?= Str::after($source, 'tree/' . App::version() . '/') ?>
		</a>
	</li>
	<?php endif ?>
</ul>

<!-- Deprecation notice -->
<?php if ($deprecated = $reflection?->deprecated()): ?>
<div class="prose">
	<div class="box box--alert">
		<figure class="box-icon iconbox bg-black color-white">
			<?= icon('alert') ?>
		</figure>
		<div class="box-text">
			<div class="font-bold">
				Deprecated
				<?php if ($version = $deprecated->version()): ?>
				in <?= version($version, '%s') ?>
				<?php endif ?>
			</div>
			<?php if ($description = $deprecated->description()): ?>
			<?= kti($description) ?>
			<?php endif ?>
		</div>
	</div>
</div>
<?php endif ?>

<!-- Internal notice -->
<?php if ($reflection?->isInternal() === true): ?>
<div class="prose">
	<div class="box box--warning">
		<?php snippet('kirbytext/box', [
			'type' => 'alert',
			'text' => '`' . $page->title() . '` has been marked as internal. It might be changed in a future Kirby major or minor release without being considered a breaking change. Use with caution.'
		]) ?>
	</div>
</div>
<?php endif ?>
