<?php

use Kirby\Cms\App;
use Kirby\Reference\Reflectable\ReflectableClass;
use Kirby\Toolkit\Str;

$reflection = $page->reflection();
$since      = $page->since();
$alias      = $reflection?->alias();
$auth       = $page->auth()->value();
$read       = $page->read()->value();
$source     = $page->source();
?>

<!-- Meta list -->
<?php if (
	$since ||
	$reflection instanceof ReflectableClass ||
	$alias ||
	$auth ||
	$read ||
	$source
): ?>
<ul class="reference-meta">
	<?php if ($since): ?>
	<li class="since">Since <?= $since->toHtml() ?></li>
	<?php endif ?>

	<?php if ($reflection instanceof ReflectableClass): ?>
	<li>Full class name: <code><?= $reflection->name(short: false) ?></code></li>
	<?php endif ?>

	<?php if ($alias): ?>
	<li>Alias: <code><?= $alias ?></code></li>
	<?php endif ?>

	<?php if ($auth): ?>
	<li>
		<a href="<?= url('docs/guide/users/permissions') ?>">
			<?= icon('lock') ?>
			<?= $auth ?>
		</a>
	</li>
	<?php endif ?>

	<?php if ($read): ?>
	<li>
		<a href="<?= url($read) ?>">
			<?= icon('book') ?>
			Read more
		</a>
	</li>
	<?php endif ?>

	<?php if ($source): ?>
	<li>
		<a href="<?= $source ?>">
			<?= icon('code') ?>
			kirby/<?= Str::after($source, 'tree/' . App::version() . '/') ?>
		</a>
	</li>
	<?php endif ?>
</ul>
<?php endif ?>
<!-- Deprecation notice -->
<?php if ($deprecated = $page->deprecated()): ?>
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
<?php if ($page->isInternal() === true): ?>
<div class="prose">
	<div class="box box--warning">
		<?php snippet('kirbytext/box', [
			'type' => 'lab',
			'text' => '`' . $page->title() . '` has been <b>marked as internal</b>. It might be changed in a future Kirby major or minor release without being considered a breaking change. Use with caution.'
		]) ?>
	</div>
</div>
<?php endif ?>
