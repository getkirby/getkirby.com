<?php foreach ($items as $label => $target): ?>
	<?php if ($target instanceof \Kirby\Cms\Page): ?>
	<li><a href="<?= $target->menuUrl() ?>"><?= $label ?></a></li>
	<?php elseif (is_string($label) === true): ?>
	<li>
		<a href="<?= $target ?>">
			<?= $label ?>
			<span class="menu-external-icon"><?= icon('arrow-right-up') ?></span>
		</a>
	</li>
	<?php else: ?>
	<li><hr /></li>
	<?php endif ?>
<?php endforeach ?>
