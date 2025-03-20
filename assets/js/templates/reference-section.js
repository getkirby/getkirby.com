window.addEventListener("DOMContentLoaded", () => {
	const filter = document.querySelector(".reference-section-filter");
	const input = filter.querySelector("input");
	const empty = filter.querySelector(".empty");
	const section = document.querySelector(".reference-section");
	const entries = section.querySelectorAll("li");

	// handle input for reference section filter
	input.addEventListener("input", function () {
		const query = this.value.toLowerCase().trim();

		let hasVisibleItems = false;

		for (const entry of entries) {
			const slug = entry.getAttribute("data-slug") || "";
			const keywords = entry.getAttribute("data-keywords") || "";
			const text = (slug + "," + keywords).toLowerCase();

			if (text.includes(query)) {
				entry.style.removeProperty("display");
				hasVisibleItems = true;
			} else {
				entry.style.display = "none";
			}
		}

		if (hasVisibleItems) {
			section.style.removeProperty("display");
			empty.style.display = "none";
		} else {
			section.style.display = "none";
			empty.style.display = "block";
		}
	});

	input.addEventListener("keydown", function (e) {
		if (e.key === "Escape") {
			this.value = "";
			this.dispatchEvent(new Event("input", { bubbles: true }));
			this.blur();
		}
	});
});
