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
	font-size: var(--text-xs);
	font-family: var(--font-mono);
	color: var(--color-gray-800);
}
.v4-design-features :where(li, a) {
	display: flex;
	align-items: center;
	flex-direction: column;
	gap: .5rem;
	justify-content: center;
	text-align: center;
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
	<?= img($section->image('company.png'), [
		'src' => [
			'width' => 1248
		],
		'lazy' => false,
		// sizes generated with https://ausi.github.io/respimagelint/
		'sizes' => '(min-width: 1540px) 1248px, (min-width: 1160px) calc(77.78vw + 66px), (min-width: 480px) calc(100vw - 96px), 90vw',
		'srcset' => [
			200,
			400,
			800,
			1248,
			2496,
		]
	]) ?>
</figure>

<ul class="v4-design-features">
	<li>
		<a href="/docs/reference/system/options/panel#panel-menu" class="py-6 px-3">
			<?= icon('menu') ?>
			New menu
		</a>
	</li>
	<li class="py-6 px-3">
		<?= icon('artboard') ?>
		Full-width layout
	</li>
	<li class="py-6 px-3">
		<?= icon('keyboard') ?>
		A11y improvements
	</li>
	<li>
		<a href="https://lab.getkirby.com/public/lab/components/buttons" class="py-6 px-3">
			<?= icon('fingerprint') ?>
			New button design
		</a>
	</li>
	<li>
		<a href="https://lab.getkirby.com/public/lab/basics/design/colors" class="py-6 px-3">
			<?= icon('palette') ?>
			New color scheme
		</a>
	</li>
	<li>
		<a href="/docs/reference/panel/icons" class="py-6 px-3">
			<?= icon('pencil-ruler') ?>
			New icons
		</a>
	</li>
	<li class="py-6 px-3">
		<?= icon('save') ?>
		Redesigned save bar
	</li>
	<li class="py-6 px-3">
		<?= icon('window') ?>
		Better responsiveness
	</li>
	<li>
		<a href="https://lab.getkirby.com/public/lab" class="py-6 px-3">
			<?= icon('paint-brush') ?>
			Refreshed UI components
		</a>
	</li>
	<li>
		<a href="https://lab.getkirby.com/public/lab/internals/panel" class="py-6 px-3">
			<?= icon('plugin') ?>
			New UI plugin options
		</a>
	</li>
</ul>

<figure class="release-box bg-light grid place-items-center">
	<video controls autoplay muted class="rounded shadow-xl" style="width: 100%; --span: 2">
		<source src="<?= $section->file('panel.mp4')->url() ?>" type="video/mp4">
	</video>
</figure>
