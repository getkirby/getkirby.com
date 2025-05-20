<style>
.v5-design-features {
	display: grid;
	grid-template-columns: 1fr;
	gap: var(--spacing-1);
}
@media screen and (min-width: 60rem) {
	.v5-design-features {
		grid-template-columns: repeat(2, 1fr);
	}
}
@media screen and (min-width: 80rem) {
	.v5-design-features {
		grid-template-columns: repeat(3, 1fr);
	}
}

.v5-design-features li {
	background: var(--color-light);
	border-radius: var(--spacing-2);
	font-size: var(--text-xs);
	color: var(--color-gray-800);
	padding: var(--spacing-6);
}
.v5-design-features :where(li, a) {
	display: flex;
	flex-direction: column;
	gap: var(--spacing-3);
}
.v5-design-features h3 {
	font-family: var(--font-mono);
}

.v5-design-features svg {
	width: 24px;
	height: 24px;
	color: var(--color-black);
}
</style>

<ul class="v5-design-features mb-12">
  <?php foreach ($section->features()->toStructure() as $feature): ?>
  <li>
	<?php if ($link = $feature->link()->toUrl()): ?>
	<a href="<?= $link ?>">
	<?php endif ?>

    <?= icon($feature->icon()) ?>
    <h3><?= $feature->headline()->kti() ?></h3>
    <p>
		<?= $feature->text()->kti() ?>
		<?= e($link, '&rarr;') ?>
	</p>

	<?php if ($link): ?>
	</a>
	<?php endif ?>
  </li>
  <?php endforeach ?>
</ul>

<p class="text-center color-gray-700 text-md mb-3">
	Curious about all enhancements, fixes and breaking changes?
</p>
<?php snippet('cta', [
	'buttons' => [
		[
			'text' => 'Changelog',
			'link' => '/releases/5/changelog',
			'icon' => 'list-numbers',
			'style' => 'outlined'
		]
	],
	[
		'center' => true
	]
]) ?>
