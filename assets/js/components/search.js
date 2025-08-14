export default class {
	constructor() {
		this.$btn = document.querySelectorAll(".search-button");
		this.$dialog = document.querySelector(".search-dialog");

		if (!this.$dialog) {
			return;
		}

		this.$form = this.$dialog.querySelector("form");
		this.$area = new AreaSelector(this);
		this.$input = this.$form.querySelector("input[name=q]");
		this.$results = this.$form.querySelector(".search-results ul");
		this.$result = this.$form.querySelector(".search-results template");
		this.$more = this.$form.querySelector(".search-more a");

		this.q = "";
		this.fetchingTimeout = null;
		this.results = [];
		this.total = 0;

		// Register event for all search buttons
		for (const btn of this.$btn) {
			btn.addEventListener("click", () => this.open(btn));
		}

		this.$dialog.addEventListener("click", this.onBlur.bind(this));
		this.$input.addEventListener(
			"input",
			debounce(this.onInput.bind(this), 100)
		);
		this.$dialog.addEventListener("keydown", this.onKey.bind(this));

		// Keyboard shortcut:
		document.addEventListener("keydown", (e) => {
			if (
				// `/` if no focus
				(e.target === document.body && e.key === "/") ||
				// `Alt + /` always
				(e.altKey === true && e.key === "/") ||
				// `Cmd + k` or `Ctrl + k` always
				((e.ctrlKey === true || e.metaKey === true) && e.key === "k")
			) {
				this.open(this.$btn[0]);
				e.preventDefault();
			}
		});
	}

	open(btn) {
		this.$dialog.show();
		document.documentElement.style.overflow = "hidden";
		this.$area.select(btn.dataset.area);
		this.$input.focus();

		// make sure to close menu
		const menu = document.querySelector("#menu-check");
		if (menu) {
			menu.checked = false;
		}
	}

	close(e) {
		this.$dialog.close();
		document.documentElement.style.overflow = null;
		this.$input.value = "";
		this.q = "";
		this.results = [];
		this.total = 0;
		this.$area.value = "all";
		this.$area.update();
		this.render();
	}

	async fetch(q) {
		const params = {
			q,
			limit: 7,
		};

		if (this.$area.value !== "all") {
			params.area = this.$area.value;
		}

		// Call the Algolia API
		const response = await fetch(
			"/search.json?" + new URLSearchParams(params).toString(),
			{ method: "GET" }
		);
		const { results, pagination } = await response.json();

		// Show View all item if there are any hits and
		// there are more hits than those displayed in the popup.
		this.total = pagination?.total ?? 0;

		return results.data ?? [];
	}

	render() {
		// Clear results list in dialog
		this.$results.innerHTML = null;

		// Build a list entry for each result from HTML template
		// and append to results list
		for (const result of this.results) {
			const node = this.$result.content.cloneNode(true);
			const link = node.querySelector("a");
			link.href = "/" + result.objectID;

			const label = node.querySelector(".search-title");
			label.innerHTML = result.title;
			const byline = node.querySelector(".search-byline");
			byline.innerHTML = result.byline ?? result.intro;
			const info = node.querySelector(".search-link");
			info.innerText = result.objectID;

			if (result.area) {
				const area = node.querySelector(".search-area");
				area.dataset.area = result.area;
				area.innerText = result.area[0].toUpperCase() + result.area.slice(1);
			}

			this.$results.appendChild(node);
		}

		// Show/hide "View all" button
		if (this.total > 5) {
			this.$more.href = `/search?q=${this.q}&area=${this.$area.value}`;
			const count = this.$more.querySelector(".search-more-count");
			count.innerText = this.total;
			this.$more.classList.remove("hidden");
		} else {
			this.$more.classList.add("hidden");
		}
	}

	async search() {
		this.q = this.$input.value.trim();
		this.results = [];
		this.total = 0;

		if (this.q.length > 2) {
			this.fetchingTimeout = setTimeout(() => {
				this.$form.setAttribute("data-fetching", true);
			}, 100);

			this.results = await this.fetch(this.q);
			clearTimeout(this.fetchingTimeout);
			this.$form.removeAttribute("data-fetching");
		}

		this.render();
		this.$input.focus();
	}

	onBlur(e) {
		if (this.$area.$el.contains(e.target) === false) {
			this.$area.close();
		}
		if (this.$form.contains(e.target) === false) {
			this.close();
		}
	}

	onInput() {
		// If input value is same as previous search
		// don't do anything
		if (this.$input.value.trim() === this.q) {
			return;
		}

		this.search();
	}

	onKey(e) {
		if (e.key === "Escape") {
			return this.onEscape();
		}
		if (e.key === "ArrowDown") {
			return this.onArrowDown(e);
		}
		if (e.key === "ArrowUp") {
			return this.onArrowUp(e);
		}
	}

	onEscape() {
		// If input is empty, close dialog.
		// Otherwise first clear input.
		if (this.q === "") {
			this.close();
			return;
		}

		this.$input.value = "";
		this.$input.dispatchEvent(new Event("input"));
	}

	onArrowDown(e) {
		e.preventDefault();
		const current = document.activeElement;

		if (current === this.$input) {
			return this.$results.firstElementChild.firstElementChild.focus();
		}

		if (current.parentNode.nextElementSibling) {
			return current.parentNode.nextElementSibling.firstElementChild.focus();
		}

		this.$more.focus();
	}
	onArrowUp(e) {
		e.preventDefault();
		const current = document.activeElement;

		if (current === this.$results.firstElementChild.firstElementChild) {
			return this.$input.focus();
		}

		if (current === this.$more) {
			return this.$results.lastElementChild.firstElementChild.focus();
		}

		if (current.parentNode.previousElementSibling) {
			return current.parentNode.previousElementSibling.firstElementChild.focus();
		}
	}
}

/** AREA SELECTOR */
class AreaSelector {
	constructor(parent) {
		this.$parent = parent;
		this.$el = parent.$form.querySelector(".search-input > nav");
		this.$btn = parent.$form.querySelector(".search-input > nav > button");
		this.$label = this.$btn.querySelector("[data-area]");
		this.$dropdown = this.$el.querySelector("ul");
		this.$options = this.$dropdown.querySelectorAll("[data-area]");
		this.$input = this.$el.querySelector("input[name=area]");

		this.value = this.$input.value;

		this.$btn.addEventListener("click", this.toggle.bind(this));

		for (const option of this.$options) {
			option.addEventListener("click", (e) =>
				this.select(e.target.dataset.area)
			);
		}
	}

	close() {
		this.$dropdown.classList.add("hidden");
	}

	toggle() {
		this.$dropdown.classList.toggle("hidden");
	}

	select(area) {
		this.value = area;
		this.$input.value = area;
		this.update();
		this.close();
		this.$parent.search();
	}

	update() {
		this.$label.dataset.area = this.value;
		this.$label.innerText = [...this.$options].filter(
			(option) => option.dataset.area === this.value
		)[0].innerText;
	}
}
