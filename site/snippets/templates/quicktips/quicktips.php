<style>
.quicktips li {
	background: var(--color-white);
	border-radius: var(--rounded);
	box-shadow: var(--shadow);
}
.quicktips li + li {
	margin-top: 2px;
}
.quicktips article {
	display: flex;
	justify-content: space-between;
}
.quicktip-title {
	padding: var(--spacing-2) var(--spacing-3);
	flex-grow: 1;
	font-size: var(--text-base);
}
.quicktip-tags {
	padding: var(--spacing-2);
	display: flex;
	gap: var(--spacing-2);
	font-size: var(--text-xs);
}
.quicktip-tags a {
	display: inline-flex;
	align-items: center;
	border-radius: var(--rounded-sm);
	background: var(--color-gray-200);
	padding: 0 .5rem;
}
</style>

<ul class="quicktips">
	<?php foreach ($quicktips as $tip): ?>
	<li>
		<article>
			<a class="quicktip-title" href="<?= $tip->url() ?>">
				<h2 class="link">
					<?= $tip->title() ?>
				</h2>
			</a>
			<p class="quicktip-tags">
				<?= implode('',
					array_map(
						fn ($tag) => Html::a(page('docs/quicktips')->url() . '/tags/' . Str::slug($tag), Str::ucfirst($tag)),
						$tip->tags()->split(',')
					)
				); ?>
			</p>
		</article>
	</li>
	<?php endforeach ?>
</ul>
