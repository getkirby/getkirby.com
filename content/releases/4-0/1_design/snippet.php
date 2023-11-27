<style>
.v4-design-features {
	display: grid;
	grid-template-columns: repeat(2, 1fr);
	gap: var(--spacing-1);
	margin-bottom: var(--spacing-6);
}
.v4-design-features li {
	background: var(--color-light);
	border-radius: var(--spacing-2);
	padding: var(--spacing-6) var(--spacing-3);
	display: flex;
	flex-direction: column;
	gap: .5rem;
	align-items: center;
	font-size: var(--text-xs);
	font-family: var(--font-mono);
	justify-content: center;
	text-align: center;
	color: var(--color-text-dimmed);
}
.v4-design-features svg {
	width: 24px;
	height: 24px;
	color: var(--color-black);
}

@media screen and (min-width: 80rem) {
	.v4-design-features {
		grid-template-columns: repeat(5, 1fr);
	}
}


</style>

<figure class="release-box bg-light mb-6">
	<?= $section->image('company.png')->resize(1600) ?>
</figure>

<ul class="v4-design-features">
	<li>
		<?= icon('menu') ?>
		New menu
	</li>
	<li>
		<?= icon('artboard') ?>
		Full-width layout
	</li>
	<li>
		<?= icon('keyboard') ?>
		A11y improvements
	</li>
	<li>
		<?= icon('fingerprint') ?>
		New button design
	</li>
	<li>
		<?= icon('palette') ?>
		New color scheme
	</li>
	<li>
		<?= icon('pencil-ruler') ?>
		New icons
	</li>
	<li>
		<?= icon('save') ?>
		Redesigned save bar
	</li>
	<li>
		<?= icon('window') ?>
		Better responsiveness
	</li>
	<li>
		<?= icon('paint-brush') ?>
		Refreshed UI components
	</li>
	<li>
		<?= icon('plugin') ?>
		New UI plugin options
	</li>
</ul>

<figure class="release-box bg-light grid place-items-center">
	<video controls autoplay class="rounded shadow-xl" style="width: 100%; --span: 2">
		<source src="<?= $section->file('panel.mp4')->url() ?>" type="video/mp4">
	</video>
</figure>

