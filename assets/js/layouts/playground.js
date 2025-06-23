export class Playground {
	constructor() {
		this.$el = document.querySelector(".playground");

		document.addEventListener("click", (e) => {
			const link = e.target.closest(".playground-header-menu a:not(.more)");

			if (link) {
				e.preventDefault();
				this.switchTo(link, e.target);
			}
		});
	}

	get image() {
		return this.$el.querySelector(".playground-header-figure-wrapper img");
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

	preload(target) {
		const newUrl = this.image.currentSrc.replace(
			this.wrapper.dataset.image,
			target.dataset.image
		);

		new Image().src = newUrl;
	}

	async switchTo(link, target) {
		// fade out the old image
		this.wrapper.classList.add("loading");

		// preload the new image
		this.preload(target);

		// since our CSS transition to fade out the image takes 200ms,
		// ensure that we wait that long, even if the fetch request is faster
		const [doc] = await Promise.all([
			this.loadHtml(link),
			new Promise((resolve) => setTimeout(resolve, 200)),
		]);

		// replace the playground
		this.$el.innerHTML = doc.querySelector(".playground").innerHTML;

		// fade in the image once loaded
		this.image.addEventListener("load", function () {
				// let the browser render the image first to reduce flickering issues
				setTimeout(() => this.parentNode.classList.remove("loading"), 10);
			});

		// reactivate code highlighting
		Prism.highlightAll();
	}

	get wrapper() {
		return this.$el.querySelector(".playground-header-figure-wrapper");
	}
}
