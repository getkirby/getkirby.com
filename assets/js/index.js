window.debounce = (callback, delay) => {
	let timeout;
	return () => {
		clearTimeout(timeout);
		timeout = setTimeout(callback, delay);
	}
};

import "./polyfills/dialog.js";
import Code from "./components/code.js";
import Lightbox from "./components/lightbox.js";
import Menu from "./components/menu.js";
import Search from "./components/search.js";

document.addEventListener("DOMContentLoaded", () => {
	new Code();
	new Lightbox();
	new Menu();
	new Search();
});
