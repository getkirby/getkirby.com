<?php layout() ?>

<style>
.partners-header {
	display: grid;
	grid-template-areas:
		"title"
		"ctas"
		"filters"
		"results"
}
.partners-title {
	grid-area: title;
	margin-bottom: var(--spacing-8);
}

.partners-ctas {
	display: flex;
	flex-wrap: wrap;
	align-items: center;
	justify-content: end;
	gap: var(--spacing-3);
	grid-area: ctas;
	margin-bottom: var(--spacing-12);
}
.partners-ctas .btn {
	flex-grow: 1;
	padding-left: 1rem;
	padding-right: 1rem;
}

.partners-filters {
	grid-area: filters;
}
.partners-filters-title {
	margin-bottom: var(--spacing-2);
	font-size: var(--text-sm);
	font-weight: var(--font-bold);
}
.partners-filter-selects {
	display: flex;
	flex-wrap: wrap;
	gap: var(--spacing-3);
}
.partners-filters .select {
	width: 100%;
}
.partners-filters .select select {
	cursor: pointer;
}

.partners-results {
	grid-area: results;
	padding-top: var(--spacing-2);
}

.partners, .partners-certified {
	--columns: 2;
}

@media screen and (max-width: 35rem) {
	.partners {
		--columns: 1;
	}
}

@media screen and (min-width: 60rem) {
	.partners-certified {
		--columns: 3;
	}
	.partners {
		--columns: 3;
	}
}

@media screen and (min-width: 40rem) {
	.partners-filters .select {
		width: auto;
		flex-grow: 1;
	}
}

@media screen and (min-width: 65rem) {
	.partners-header {
		grid-template-columns: max-content 1fr max-content;
		grid-template-areas:
			"title title title"
			"filters gap ctas"
			"results results results"
	}
	.partners-ctas {
		margin-bottom: 0;
	}
	.partners-filters-title {
		display: none;
	}
}

</style>

<article>

	<header class="partners-header mb-24">
		<div class="partners-title max-w-xl">
			<h1 class="h1 mb-6">Find a Kirby partner to trust with your next project</h1>
			<p class="text-xl leading-snug color-gray-700">
				<?= $page->description() ?>
			</p>
		</div>

		<nav class="partners-ctas">
			<a class="btn btn--filled" href="https://airtable.com/shrfCqUxq5L3GyhIb">
				<?= icon('email') ?>
				Post your project
			</a>
			<a class="btn btn--filled" href="<?= url('partners/join') ?>">
				<?= icon('verified') ?>
				Become a partner
			</a>
		</nav>

		<nav class="partners-filters">
			<h2 class="partners-filters-title">Filter partners</h2>

			<div class="partners-filter-selects auto-fit items-center">
				<?php foreach ($filters as $field => $config): ?>
				<div class="select">
					<select
						data-field="<?= Escape::attr($field) ?>"
						data-multiple="<?= $config['multiple'] ? 'true' : 'false' ?>"
						aria-label="<?= Escape::attr($config['label']) ?>"
					>
						<option value="_all"><?= Escape::html($config['default']) ?></option>

						<?php foreach ($config['options'] as $option): ?>
						<option value="<?= Escape::attr($option) ?>">
							<?php if (isset($config['text']) === true): ?>
								<?= Escape::html($config['text']($option)) ?>
							<?php else: ?>
								<?= Escape::html($option) ?>
							<?php endif ?>
						</option>
						<?php endforeach ?>
					</select>
				</div>
				<?php endforeach ?>
			</div>
		</nav>

		<p class="partners-results text-xs color-gray-700">
			Displaying <span class="partners-results-count"><?= $partners->count() ?></span> result<span class="partners-results-plural">s</span>
		</p>
	</header>

	<section class="partners-section partners-certified columns mb-24" style="--gap: var(--spacing-20)">
		<?php foreach ($certified as $partner): ?>
			<?php snippet('templates/partners/partner.certified', ['partner' => $partner, 'lazy' => $certified->indexOf($partner) > 2]) ?>
		<?php endforeach ?>
	</section>

	<section class="partners-section partners columns"
					 style="--column-gap: var(--spacing-20); --row-gap: var(--spacing-12)">
		<?php foreach ($regular as $partner): ?>
			<?php snippet('templates/partners/partner', ['partner' => $partner]) ?>
		<?php endforeach ?>
	</section>

	<p class="partners-no-results text-lg" style="display: none">
		We could not find matching partners for your query at this time. 😔<br>
		Please try again with different filters.
	</p>
</article>

<script>
document.querySelectorAll('.partners-filters select').forEach((select) => {
	// field in the dataset of each partner this select filters by
	const field = select.dataset.field;

	// whether this filter can match any of multiple comma-separated values
	const multiple = select.dataset.multiple === 'true';

	select.addEventListener('input', (event) => {
		let numVisible = 0;

		// filter all nodes that have the data attribute we are filtering by
		document.querySelectorAll('article [data-' + field + ']').forEach((partner) => {
			// keep an object of all filter fields that *don't* match this partner
			partner.partnerFilters ||= {};

			// check if the partner matches the filter (depending on the filter type)
			let matches = null;
			if (multiple === true) {
				const options = partner.dataset[field].split(',');

				matches = options.includes(select.value) === true;
			} else {
				matches = partner.dataset[field] === select.value;
			}

			// update the object of filter fields accordingly
			if (matches === true || select.value === '_all') {
				delete partner.partnerFilters[field];
			} else {
				partner.partnerFilters[field] = false;
			}

			// if there is at least one list entry, at least one of the filters
			// doesn't match this partner, so hide it from the list
			if (Object.keys(partner.partnerFilters).length > 0) {
				partner.style.display = 'none';
			} else {
				partner.style.display = null;
				numVisible++;
			}
		});

		// display number of results
		document.querySelector('.partners-results-count').textContent = numVisible;
		document.querySelector('.partners-results-plural').style.display = numVisible === 1 ? 'none' : null;
		document.querySelector('.partners-no-results').style.display = numVisible > 0 ? 'none' : null;

		// hide sections that have no visible children with the current filters
		// (hides the duplicated margins)
		document.querySelectorAll('.partners-section').forEach((section) => {
			// first make it visible if it was hidden before so we can measure its height
			section.style.display = null;

			// check if there is content within the section; otherwise hide it (again)
			if (section.offsetHeight === 0) {
				section.style.display = 'none';
			}
		});
	});
});
</script>

<?php snippet('templates/partners/info-dialog') ?>
