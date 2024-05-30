<h3 class="font-bold">
	<?php if ($feature['link'] ?? null): ?>
	<a href="<?= $feature['link'] ?>"><?= $feature['title'] ?> &rarr;</a>
	<?php else: ?>
	<?= $feature['title'] ?>
	<?php endif ?>
</h3>
<p class="color-gray-800">
	<?= kti($feature['text']) ?>
</p>
