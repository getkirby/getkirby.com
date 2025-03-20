window.addEventListener('DOMContentLoaded', () => {
	let searchInput = document.getElementById("search-reference-input");
	let searchToggleButton = document.getElementById("search-filter-toggle");
	let searchWrapper = document.getElementById("search-reference");

	// search filter process
	searchInput.addEventListener('input', function () {
		let searchValue = this.value.toLowerCase().trim();
		let list = document.querySelector('.reference-section');
		let items = list.querySelectorAll('li');
		let emptyResults = document.getElementById('empty-results');

		let hasVisibleItems = false;

		items.forEach(item => {
			let slug = item.getAttribute('data-slug') || '';
			let keywords = item.getAttribute('data-keywords') || '';
			let fullText = (slug + ',' + keywords).toLowerCase();

			if (fullText.includes(searchValue)) {
				item.style.removeProperty('display');
				hasVisibleItems = true;
			} else {
				item.style.display = 'none';
			}
		});

		if (hasVisibleItems) {
			list.style.removeProperty('display');
			emptyResults.style.display = 'none';
		} else {
			list.style.display = 'none';
			emptyResults.style.display = 'block'
		}
	});

	// toggle search filter
	searchToggleButton.addEventListener("click", function () {
		searchWrapper.classList.toggle("show");
		
		if (searchWrapper.classList.contains("show")) {
			searchInput.focus();
		} else {
			// clear the search input when the search filter is closed
			searchInput.value = "";
			let event = new Event("input");
			searchInput.dispatchEvent(event);
		}
	});
});
