
// Helpers

window.debounce = (callback, delay) => {
  let timeout;
  return () => {
      clearTimeout(timeout);
      timeout = setTimeout(callback, delay);
  }
}

// Components

import Affiliates from "./components/affiliates.js";
import Code from "./components/code.js";
import Lightbox from "./components/lightbox.js";
import Menu from "./components/menu.js";
import Search from "./components/search.js";

new Affiliates();
new Code();
new Lightbox();
new Menu();
new Search();

import "./polyfills/dialog.js";
