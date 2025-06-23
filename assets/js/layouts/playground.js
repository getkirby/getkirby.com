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

		document.addEventListener("submit", async (e) => {
			const form = e.target.closest(".playground-header-figure form");

			if (!form) {
				return;
			}

			e.preventDefault();

			const theme = form.querySelector("button").value;
			const link  = this.$el.querySelector(".playground-header-menu a[aria-current]");
			const url   = new URL(link.href);
			url.searchParams.set("theme", theme);

			await this.switchTo(url.toString(), link);

		});
	}

	get image() {
		return this.$el.querySelector(".playground-header-figure-wrapper img");
	}

	get figure() {
		return this.$el.querySelector(".playground-header-figure");
	}

	async loadHtml(link) {
		const response = await fetch(link, {
			cache: "no-store",
		});
		const body = await response.text();
		const parser = new DOMParser();
		const doc = parser.parseFromString(body, "text/html");

		// load the new image as hidden before it gets injected
		this.figure.classList.add("loading");

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
		this.figure.classList.add("loading");

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
				setTimeout(() => this.figure.classList.remove("loading"), 10);
			});

		// reactivate code highlighting
		Prism.highlightAll();
	}

	get wrapper() {
		return this.$el.querySelector(".playground-header-figure-wrapper");
	}
}
