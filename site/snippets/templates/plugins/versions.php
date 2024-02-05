<ul class="flex font-mono text-xs" style="gap: .5rem">
	<?php foreach($plugin->versions()->split() as $version): ?>
	<li class="px-1 rounded bg-<?= $version === '4' ? 'yellow' : $bg ?? 'light' ?>" title="This plugin supports Kirby <?= $version ?>">K<?= $version ?></li>
	<?php endforeach ?>
</ul>
