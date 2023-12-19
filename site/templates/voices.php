<?php layout() ?>

<?php snippet('voices') ?>

<section id="voices" class="mb-42">
	<h2 class="h2 mb-12">Voices</span></h2>
	<ul class="masonry" style="--gap: 3rem">
		<?php foreach($page->children()->listed() as $voice): ?>
		<li>
			<?php snippet('voice', ['voice' => $voice]) ?>
		</li>
		<?php endforeach ?>
	</ul>
</section>
