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

function init() {
	new Code();
	new Lightbox();
	new Menu();
	new Search();
}

if (document.readyState === "loading") {
  // loading hasn't finished yet
  document.addEventListener("DOMContentLoaded", init);
} else {
  // `DOMContentLoaded` has already fired
  init();
}
