<?php if ($entry->intendedTemplate()->name() === 'reference-icon'): ?>
<figure class="p-3 mr-3 bg-light rounded">
	<svg>
		<use xlink:href="#icon-<?=  $entry->slug() ?>" />
	</svg>
</figure>
<?php endif ?>
