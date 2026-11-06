<?php
use Kirby\Http\Url;

/**
 * @var array $cases
 * @var int $columns
 */
?>
<ul class="cases columns mb-24" style="--columns-sm: 1; --columns-md: 2; --columns-lg: <?= $columns ?? 3 ?>; --gap: var(--container-padding)">
	<?php foreach ($cases as $case): ?>
	<li>
		<article class="leading-tight color-white">
			<a class="block" 	href="<?= $case['link'] ?>">
				<figure class="mb-3 shadow-2xl" style="--aspect-ratio: 3/4">
					<img src="<?= $case['cover'] ?>" alt="Screenshot of the <?= $case['title'] ?> website">
				</figure>
				<h2 class="font-bold mb-1"><?= $case['title'] ?></h2>
				<p class="font-mono text-xs color-gray-400">
					<?= Url::short($case['link']) ?>
				</p>
			</a>
		</article>
	</li>
	<?php endforeach ?>
</ul>
