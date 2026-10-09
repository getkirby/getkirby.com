<style>
.v6-foundation {
	display: grid;
	gap: var(--spacing-3);
}
@media screen and (min-width: 60rem) {
	.v6-foundation {
		grid-template-columns: repeat(2, 1fr);
	}
}
@media screen and (min-width: 80rem) {
	.v6-foundation {
		grid-template-columns: repeat(3, 1fr);
	}
	.v6-foundation > .release-text-box {
		grid-row: span 2;
	}
}

.v6-foundation-item {
	background: var(--color-light);
	border-radius: var(--spacing-2);
	font-size: var(--text-sm);
	color: var(--color-gray-800);
	padding: var(--spacing-6);
}
.v6-foundation-item,
.v6-foundation-item a {
	display: flex;
	flex-direction: column;
	gap: var(--spacing-3);
}
.v6-foundation-item h3 {
	font-weight: var(--font-bold);
	color: var(--color-black);
}
.v6-foundation-item svg {
	width: 24px;
	height: 24px;
	color: var(--color-black);
}
</style>

<div class="v6-foundation">
	<div class="release-text-box">
		<?php snippet('templates/release-4/teaser', ['section' => $section]) ?>
	</div>

	<?php foreach ($section->highlights()->toStructure() as $item): ?>
	<div class="v6-foundation-item">
		<?php if ($link = $item->link()->toUrl()): ?>
		<a href="<?= $link ?>">
		<?php endif ?>

		<?= icon($item->icon()) ?>
		<h3><?= $item->headline()->kti() ?></h3>
		<p><?= $item->text()->kti() ?></p>

		<?php if ($link): ?>
		</a>
		<?php endif ?>
	</div>
	<?php endforeach ?>
</div>
