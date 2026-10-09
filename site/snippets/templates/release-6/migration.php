<?php
$guides = [
	[
		'title' => 'For editors',
		'text'  => 'What changes in your daily work with the Panel and what to tell your team.',
		'link'  => 'releases/6/migration/editors',
		'icon'  => 'edit'
	],
	[
		'title' => 'For site developers',
		'text'  => 'Requirements, breaking changes and step-by-step instructions to upgrade your site.',
		'link'  => 'releases/6/migration/site-developers',
		'icon'  => 'code'
	],
	[
		'title' => 'For plugin developers',
		'text'  => 'Vue 3, fields as PHP classes and everything else to get your plugin ready.',
		'link'  => 'releases/6/migration/plugin-developers',
		'icon'  => 'plugin'
	],
];
?>
<style>
.v6-migration-guides {
	display: grid;
	gap: var(--spacing-3);
}
@media screen and (min-width: 60rem) {
	.v6-migration-guides {
		grid-template-columns: repeat(3, 1fr);
	}
}
.v6-migration-guides a {
	display: flex;
	flex-direction: column;
	gap: var(--spacing-3);
	height: 100%;
	padding: var(--spacing-6);
	background: var(--color-light);
	border-radius: var(--rounded);
}
.v6-migration-guides h3 {
	font-weight: var(--font-bold);
}
.v6-migration-guides p {
	color: var(--color-gray-800);
}
.v6-migration-guides svg {
	width: 24px;
	height: 24px;
}
</style>

<section id="migration" class="mb-42">

	<?php snippet('hgroup', [
		'title' => 'Migration from Kirby 5',
		'mb'    => 6
	]) ?>

	<div class="prose max-w-2xl mb-6">
		<?= kirbytext(
			'Before you start, read the (link: releases/6/migration text: migration overview) for requirements and how to install the beta. ' .
			'If you are not updating from Kirby 5 but an older version, please perform each major update step by step. ' .
			'Refer to the changelogs of (link: releases/4 text: v4) and (link: releases/5 text: v5) for details.'
		) ?>
	</div>

	<ul class="v6-migration-guides">
		<?php foreach ($guides as $guide): ?>
		<li>
			<a href="<?= url($guide['link']) ?>">
				<?= icon($guide['icon']) ?>
				<h3><?= $guide['title'] ?></h3>
				<p><?= $guide['text'] ?> &rarr;</p>
			</a>
		</li>
		<?php endforeach ?>
	</ul>

</section>
