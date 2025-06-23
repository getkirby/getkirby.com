export class Playground {
	constructor() {
		this.$el = document.querySelector(".playground");
		this.theme = "light";

		// event listeners for menu items
		const links = this.$el.querySelectorAll(
			".playground-header-menu a:not(.more)"
		);

		for (const link of links) {
			link.addEventListener("click", (e) => {
				e.preventDefault();
				this.switchTo(link, e.target);
			});
		}

		// event listeners for theme toggles
		const toggles = this.$el.querySelectorAll(
			".playground-theme-toggle button"
		);

		for (const toggle of toggles) {
			toggle.addEventListener("click", (e) => {
				e.preventDefault();

				// update theme
				this.theme = e.target.closest("button").dataset.theme;

				// reload current menu item with updated theme
				const link = this.$el.querySelector(
					".playground-header-menu a[aria-current]"
				);
				this.switchTo(link.href, link);
			});
		}
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

	async replaceContent(link) {
		const doc = await this.loadHtml(link);

		this.$el.querySelector(".playground-backend").innerHTML = doc.querySelector(
			".playground-backend"
		).innerHTML;
		this.$el.querySelector(".playground-filesystem").innerHTML =
			doc.querySelector(".playground-filesystem").innerHTML;
		this.$el.querySelector(".playground-medium").innerHTML =
			doc.querySelector(".playground-medium").innerHTML;

		// reactivate code highlighting
		Prism.highlightAll();
	}

	async replaceImage(target) {
		return new Promise((resolve) => {
			const theme = this.theme.charAt(0).toUpperCase() + this.theme.slice(1);
			const oldImage = this.wrapper.querySelector("img:last-child");

			// clone image, replace src and srcset
			// and add it to the wrapper
			const newImage = oldImage.cloneNode(true);
			newImage.src = target.dataset[`image${theme}Src`];
			newImage.srcset = target.dataset[`image${theme}Srcset`];

			// when new image is loaded…
			newImage.onload = async () => {
				// wait briefly to prevent flickering
				await new Promise((resolve) => {
					setTimeout(() => {
						resolve();
					}, 50);
				});

				// fade out old image
				oldImage.style.opacity = 0;

				// remove old image after fade out is complete
				setTimeout(() => {
					oldImage.remove();
				}, 700);

				resolve();
			};

			// append new image behind current image
			this.wrapper.appendChild(newImage);
		});
	}

	async switchTo(link, target) {
		// start loader animation
		this.figure.classList.add("loading");

		// update active menu item
		const links = this.$el.querySelectorAll(".playground-header-menu a");

		for (const link of links) {
			link.removeAttribute("aria-current");
		}

		target.setAttribute("aria-current", "true");

		// replace the playground content
		await this.replaceContent(link);

		// replace the playground image
		await this.replaceImage(target);

		// update figure data-theme to show/hide correct theme toggle
		// and stop loader animation
		this.figure.dataset.theme = this.theme;
		this.figure.classList.remove("loading");
	}

	get wrapper() {
		return this.$el.querySelector(".playground-header-figure-wrapper");
	}
}
