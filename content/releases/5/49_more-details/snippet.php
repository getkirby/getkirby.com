<style>
.v5-design-features {
	display: grid;
	grid-template-columns: repeat(2, 1fr);
	gap: var(--spacing-1);
	margin-bottom: var(--spacing-6);
}
.v5-design-features li {
	background: var(--color-light);
	border-radius: var(--spacing-2);
	font-size: var(--text-xs);
	font-family: var(--font-mono);
	color: var(--color-gray-800);
}
.v5-design-features :where(li, a) {
	display: flex;
	align-items: center;
	flex-direction: column;
	gap: .5rem;
	justify-content: center;
	text-align: center;
}
.v5-design-features svg {
	width: 24px;
	height: 24px;
	color: var(--color-black);
}

@media screen and (min-width: 80rem) {
	.v5-design-features {
		grid-template-columns: repeat(5, 1fr);
	}
}
</style>

<ul class="v5-design-features">
	<li>
		<a href="/docs/reference/system/options/panel#panel-menu" class="py-6 px-3">
			<?= icon('menu') ?>
			Improved IDE support
		</a>
	</li>
	<li class="py-6 px-3">
		<?= icon('lock') ?>
		files.sort permission
	</li>
	<li class="py-6 px-3">
		<?= icon('calendar') ?>
		Choose first day of week
	</li>
	<li class="py-6 px-3">
		<?= icon('fingerprint') ?>
		Native Panel validation
	</li>
	<li class="py-6 px-3">
		<?= icon('globe') ?>
		Global site controller
	</li>
	<li class="py-6 px-3">
		<?= icon('pencil-ruler') ?>
		Improved section wrapping
	</li>
	<li class="py-6 px-3">
		<?= icon('save') ?>
		Duplicate page: updated UUIDs
	</li>
	<li class="py-6 px-3">
		<?= icon('image') ?>
		Thumbs: correcting rotation
	</li>
	<li class="py-6 px-3">
		<?= icon('plugin') ?>
		Hooks: modify model
	</li>
	<li class="py-6 px-3">
		<?= icon('plugin') ?>
		??
	</li>
</ul>
