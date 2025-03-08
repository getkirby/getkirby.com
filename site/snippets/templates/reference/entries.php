<nav class="reference-entries reference-panel">
	<ul>
		<?php foreach ($entries->filterBy('isEntry', true) as $entry): ?>
			<li data-id="<?= $entry->id() ?>">
				<a
					<?= ariaCurrent($entry->isOpen(), 'page') ?>
					href="<?= $entry->url() ?>"
					class="flex items-center"
				>
					<?php snippet(
						'templates/reference/entry/decoration',
						['entry' => $entry]
					) ?>

					<div class="flex-grow">
						<h4 class="h6"><?= $entry->title() ?></h4>
						<div class="color-gray-700 text-xs">
							<?= strip_tags($entry->intro()->kti()) ?>
						</div>
					</div>
				</a>
			</li>
		<?php endforeach ?>
	</ul>
</nav>
