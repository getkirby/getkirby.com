window.debounce = (callback, delay) => {
	let timeout;
	return () => {
		clearTimeout(timeout);
		timeout = setTimeout(callback, delay);
	}
};

import "./polyfills/dialog.js";
import "./components/lightbox.js";
import Code from "./components/code.js";
import Menu from "./components/menu.js";
import Search from "./components/search.js";

new Code();
new Menu();
new Search();
