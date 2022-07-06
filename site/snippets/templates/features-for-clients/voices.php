<section id="voices" class="mb-42">
  <h2 class="sr-only">Voices</span></h2>
  <ul class="columns" style="--columns: 3; --gap: var(--spacing-24)">
	<?php foreach(page('voices')->find(['diesdas-digital', 'grand-public', 'edenspiekermann']) as $voice): ?>
	<li>
	  <?php snippet('voice', ['voice' => $voice]) ?>
	</li>
	<?php endforeach ?>
  </ul>
</section>
