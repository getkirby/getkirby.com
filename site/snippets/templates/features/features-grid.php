<ul class="columns" style="--columns: 2; --column-gap: var(--spacing-12)">
  <?php foreach ($features as $feature): ?>
  <li class="text-sm">
	<?php snippet('templates/features/feature', ['feature' => $feature]) ?>
  </li>
  <?php endforeach ?>
</ul>
