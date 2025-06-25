export class Playground {
	constructor() {
		this.$el = document.querySelector(".playground");
		this.theme = "light";
		this.isUpdating = false;
		this.pendingUpdates = [];

		// event listeners for menu items
		const links = this.$el.querySelectorAll(
			".playground-header-menu a:not(.more)"
		);

		for (const link of links) {
			link.addEventListener("click", (e) => {
				e.preventDefault();
				this.switchTo(e.target, link);
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
				const current = this.$el.querySelector(
					".playground-header-menu a[aria-current]"
				);
				this.switchTo(current);
			});
		}
	}
	get figure() {
		return this.$el.querySelector(".playground-header-figure");
	}

	async loadHtml(link) {
		const response = await fetch(link);
		const body = await response.text();
		const parser = new DOMParser();
		return parser.parseFromString(body, "text/html");
	}

	replaceContent(doc) {
		const oldBackend = this.$el.querySelector(".playground-backend");
		const oldFilesystem = this.$el.querySelector(".playground-filesystem");
		const oldMedium = this.$el.querySelector(".playground-medium");

		const newBackend = doc.querySelector(".playground-backend");
		const newFilesystem = doc.querySelector(".playground-filesystem");
		const newMedium = doc.querySelector(".playground-medium");

		oldBackend.innerHTML = newBackend.innerHTML;
		oldFilesystem.innerHTML = newFilesystem.innerHTML;
		oldMedium.innerHTML = newMedium.innerHTML;

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
					resolve();
				}, 700);
			};

			// append new image behind current image
			this.wrapper.appendChild(newImage);
		});
	}

	async switchTo(target, link) {
		if (this.isUpdating) {
			this.pendingUpdates.push({ target, link });
			return;
		}

		console.log(this.isUpdating, this.pendingUpdates);

		// start loader animation
		this.isUpdating = true;
		this.figure.classList.add("loading");

		// update active menu item
		for (const link of this.$el.querySelectorAll(".playground-header-menu a")) {
			link.removeAttribute("aria-current");
		}

		target.setAttribute("aria-current", "true");

		const [doc] = await Promise.all([
			// load the playground content
			link ? this.loadHtml(link) : null,
			// replace the playground image
			this.replaceImage(target),
		]);

		// replace the playground content
		// (if no link was provided, we only replace the image)
		if (doc) {
			this.replaceContent(doc);
		}

		// update figure data-theme to show/hide correct theme toggle
		// and stop loader animation
		this.figure.dataset.theme = this.theme;
		this.figure.classList.remove("loading");
		this.isUpdating = false;

		if (this.pendingUpdates.length > 0) {
			const { target, link } = this.pendingUpdates.shift();
			this.switchTo(target, link);
		}
	}

	get wrapper() {
		return this.$el.querySelector(".playground-header-figure-wrapper");
	}
}
