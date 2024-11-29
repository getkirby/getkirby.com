<style>
.v5-design-features {
	display: grid;
	grid-template-columns: 1fr;
	gap: var(--spacing-1);
	margin-bottom: var(--spacing-6);
}
@media screen and (min-width: 80rem) {
	.v5-design-features {
		grid-template-columns: repeat(3, 1fr);
	}
}

.v5-design-features li {
	display: flex;
	flex-direction: column;
	gap: var(--spacing-3);
	background: var(--color-light);
	border-radius: var(--spacing-2);
	font-size: var(--text-xs);
	color: var(--color-gray-800);
	padding: var(--spacing-6);
}
.v5-design-features h4 {
	font-family: var(--font-mono);
}

.v5-design-features svg {
	width: 24px;
	height: 24px;
	color: var(--color-black);
}
</style>

<ul class="v5-design-features">
	<li>
		<?= icon('menu') ?>
		<h4>Improved IDE support</h4>
		<p>Your editor now understands Kirby a whole lot better, enabling it to make smarter autocomplete suggestions and provide type hints for collections.</p>
	</li>
	<li>
		<?= icon('calendar') ?>
		<h4>Choose first day of week</h4>
		<p>Set Sunday to be the first day of the week in the Panel dropdown calendar – a much requested featured for all our international users. &rarr;</p>
	</li>
	<li>
		<?= icon('globe') ?>
		<h4>Site controller</h4>
		<p>Define a global controller for your site that gets merged into all page-specific controllers. Great for shared data. &rarr;</p>
	</li>
	<li>
		<?= icon('image') ?>
		<h4>Improved rotation detection</h4>
		<p>Thumbnails work better with photos from smartphones, adapting to the EXIF rotation data.</p>
	</li>
	<li>
		<?= icon('database') ?>
		<h4>Redis cache</h4>
		<p>A brand new cache driver for one of the most used cache types: connect to your Redis server out of the box. &rarr;</p>
	</li>
	<li>
		<?= icon('lock') ?>
		files.sort permission
	</li>
	<li>
		<?= icon('fingerprint') ?>
		Native Panel validation
	</li>
	<li>
		<?= icon('pencil-ruler') ?>
		Improved section wrapping
	</li>
	<li>
		<?= icon('save') ?>
		Duplicate page: updated UUIDs
	</li>
	<li>
		<?= icon('plugin') ?>
		Hooks: modify model
	</li>
	<li>
		<?= icon('plugin') ?>
		??
	</li>
</ul>
