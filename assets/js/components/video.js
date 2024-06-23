export default class {
	constructor() {
		document.querySelectorAll(".video-embed a").forEach((element) => {
			element.addEventListener("click", this.click);
		});
	}

	click(e) {
		e.preventDefault();
		e.currentTarget.parentElement.outerHTML = e.currentTarget.dataset.iframe;
	}
}
