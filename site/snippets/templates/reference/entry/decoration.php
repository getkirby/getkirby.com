<?php if ($entry->intendedTemplate()->name() === 'reference-icon'): ?>
<figure class="p-3 mr-3 bg-light rounded">
	<?= icon($entry->slug()) ?>
</figure>
<?php endif ?>
