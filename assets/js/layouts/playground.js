export class Playground {
	constructor() {
		this.$el = document.querySelector(".playground");

		document.addEventListener("click", (e) => {
			const link = e.target.closest(".playground-header-menu a:not(.more)");

			if (link) {
				e.preventDefault();
				this.switchTo(link);
			}
		});
	}

	async loadHtml(link) {
		const response = await fetch(link);
		const body = await response.text();
		const parser = new DOMParser();
		const doc = parser.parseFromString(body, "text/html");

		// load the new image as hidden before it gets injected
		doc
			.querySelector(".playground-header-figure-wrapper")
			.classList.add("loading");

		return doc;
	}

	async switchTo(link) {
		// fade out the old image
		this.$el
			.querySelector(".playground-header-figure-wrapper")
			.classList.add("loading");

		// since our CSS transition to fade out the image takes 200ms,
		// ensure that we wait that long, even if the fetch request is faster
		const [doc] = await Promise.all([
			this.loadHtml(link),
			new Promise((resolve) => setTimeout(resolve, 200)),
		]);

		// replace the playground
		this.$el.innerHTML = doc.querySelector(".playground").innerHTML;

		// fade in the image once loaded
		this.$el
			.querySelector(".playground-header-figure img")
			.addEventListener("load", function () {
				// use next tick to avoid flickering issues
				setTimeout(() => this.parentNode.classList.remove("loading"), 0);
			});

		// reactivate code highlighting
		Prism.highlightAll();
	}
}
