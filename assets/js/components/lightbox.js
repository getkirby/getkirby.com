import { create as createLightbox } from "../libraries/basic-lightbox.js";

export default class {
	constructor() {
		document.querySelectorAll("[data-lightbox]").forEach((element) => {
			element.addEventListener("click", this.click);
		});
	}

	click(e) {
		e.preventDefault();
		const box = createLightbox(`<img src="${e.currentTarget.href}">`);
		box.show();

		document.addEventListener("keydown", evt => {
			if (evt.key === "Escape") {
				box.close();
			}
		}, { once: true });
	}
}
