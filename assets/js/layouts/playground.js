export class Playground {
	isUpdating = false;
	pendingUpdates = [];
	theme = "light";

	constructor() {
		// event listeners for menu links
		for (const link of this.links) {
			link.addEventListener("click", (e) => {
				e.preventDefault();
				this.switchTo(e.target, link);
			});
		}

		// event listeners for theme toggles
		for (const toggle of this.toggles) {
			toggle.addEventListener("click", (e) => {
				e.preventDefault();

				// update theme
				this.theme = e.target.closest("button").dataset.theme;

				// reload current menu item with updated theme
				this.switchTo(
					[...this.links].find((link) => link.hasAttribute("aria-current"))
				);
			});
		}
	}

	get $el() {
		return document.querySelector(".playground");
	}

	get figure() {
		return this.$el.querySelector(".playground-header-figure");
	}

	get links() {
		return this.$el.querySelectorAll(".playground-header-menu a:not(.more)");
	}

	async loadHtml(link) {
		const response = await fetch(link);
		const body = await response.text();
		const parser = new DOMParser();
		return parser.parseFromString(body, "text/html");
	}

	async loadImage(target) {
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
				await new Promise((resolve) => setTimeout(resolve, 50));

				resolve(oldImage);
			};

			// append new image behind current image
			this.wrapper.appendChild(newImage);
		});
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

	async switchTo(target, link) {
		// if we're already updating, add the update to the queue
		if (this.isUpdating) {
			return this.pendingUpdates.push({ target, link });
		}

		// start loader animation
		this.isUpdating = true;
		this.figure.classList.add("loading");

		// update active menu item
		this.links.forEach((link) => link.removeAttribute("aria-current"));
		target.setAttribute("aria-current", "true");

		const [doc, oldImage] = await Promise.all([
			// load the playground content
			link ? this.loadHtml(link) : null,
			// load and insert the playground image
			this.loadImage(target),
		]);

		// replace the playground content
		// (if no link was provided, we only replace the image)
		if (doc) {
			this.replaceContent(doc);
		}

		// fade out old image
		oldImage.style.opacity = 0;

		// wait until fade out is complete
		await new Promise((resolve) => setTimeout(resolve, 600));

		// remove old image
		oldImage.remove();

		// update figure data-theme to show/hide correct theme toggle
		// and stop loader animation
		this.figure.dataset.theme = this.theme;
		this.figure.classList.remove("loading");
		this.isUpdating = false;

		// run any pending update
		if (this.pendingUpdates.length > 0) {
			const { target, link } = this.pendingUpdates.shift();
			this.switchTo(target, link);
		}
	}

	get toggles() {
		return this.$el.querySelectorAll(".playground-theme-toggle button");
	}

	get wrapper() {
		return this.$el.querySelector(".playground-header-figure-wrapper");
	}
}
