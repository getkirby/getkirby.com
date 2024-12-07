<section id="contributors" class="mb-42 text-center">
	<h2 class="h2 mb-6">Contributors</h2>

	<div class="place-items-center">
		<ul class="max-w-xl flex flex-wrap justify-center">
			<?php foreach ([
				'adamkiss',
				'afbora',
				'bastianallgeier',
				'distantnative',
				'hariom147',
				'lukasbestle',
			] as $contributor): ?>
			<li class="inline-flex p-1">
				<a href="https://github.com/<?= $contributor ?>" class="p-3 text-sm font-mono shadow bg-white rounded flex items-center">
					<img alt="" src="https://github.com/<?= $contributor ?>.png?size=64" style="border-radius: 100%; width: 32px" class="mr-3" width="32" height="32" loading="lazy"> @<?= $contributor ?>
				</a>
			</li>
			<?php endforeach ?>
		</ul>
	</div>
</section>
