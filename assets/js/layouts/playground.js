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

	async switchTo(link) {
		// fade out the old image
		this.$el
			.querySelector(".playground-header-figure-wrapper")
			.classList.add("loading");

		const response = await fetch(link);
		const body = await response.text();
		const parser = new DOMParser();
		const doc = parser.parseFromString(body, "text/html");

		// hide the new image before it gets injected
		doc
			.querySelector(".playground-header-figure-wrapper")
			.classList.add("loading");

		// replace the playground
		this.$el.innerHTML = doc.querySelector(".playground").innerHTML;

		// fade in the image on load
		this.$el
			.querySelector(".playground-header-figure img")
			.addEventListener("load", async function () {
				await new Promise((resolve) => setTimeout(resolve, 100));
				this.parentNode.classList.remove("loading");
			});

		// reactivate code highlighting
		Prism.highlightAll();
	}
}
