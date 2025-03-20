<div class="reference-section-filter">
	<div class="filter-input">
		<label for="search-reference-input" class="grid place-items-center">
			<figure>
				<?= icon('search') ?>
			</figure>
		</label>

		<input
			type="search"
			id="search-reference-input"
			placeholder="Filter"
			autocomplete="off"
		>
	</div>

	<div class="empty bg-light p-3 rounded" style="display: none;">
		No results
	</div>
</div>

<?= js('assets/js/templates/reference-section.js') ?>

