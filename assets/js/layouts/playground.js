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

	async switchTo(link, target) {
		// fade out the old image
		this.currentWrapper()
			.classList.add("loading");

		// preload the new image
		const imgSource = this.currentImg()
			.currentSrc
			.replace(this.currentWrapper().dataset.image, target.dataset.image);
		new Image().src = imgSource;

		// since our CSS transition to fade out the image takes 200ms,
		// ensure that we wait that long, even if the fetch request is faster
		const [doc] = await Promise.all([
			this.loadHtml(link),
			new Promise((resolve) => setTimeout(resolve, 200)),
		]);

		// replace the playground
		this.$el.innerHTML = doc.querySelector(".playground").innerHTML;

		// fade in the image once loaded
		this.currentImg()
			.addEventListener("load", function () {
				// let the browser render the image first to reduce flickering issues
				setTimeout(() => this.parentNode.classList.remove("loading"), 10);
			});

		// reactivate code highlighting
		Prism.highlightAll();
	}

	currentWrapper() {
		return this.$el.querySelector(".playground-header-figure-wrapper");
	}

	currentImg() {
		return this.$el.querySelector(".playground-header-figure-wrapper img");
	}
}
