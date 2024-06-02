<?php foreach ($items as $label => $target): ?>
	<?php if ($target instanceof \Kirby\Cms\Page): ?>
	<li><a href="<?= $target->menuUrl() ?>"><?= $label ?></a></li>
	<?php elseif (is_string($label) === true): ?>
	<li><a <?php if ($externalClass ?? null): ?>class="<?= $externalClass ?>" <?php endif ?>href="<?= $target ?>"><?= $label ?></a></li>
	<?php else: ?>
	<li><hr /></li>
	<?php endif ?>
<?php endforeach ?>
