
import "./components/affiliates.js"
import "./components/lazyloading.js"
import "./components/search.js"

// Code highlighting
import Code from "./components/code.js";
new Code();

// Menu
const menu = document.querySelector(".menu");

if (menu) {
  import("./components/menu.js").then(({ default: Menu }) => new Menu(menu));
}

// Sidebar
const sidebar = document.querySelector(".js-sidebar");

if (sidebar) {
  import("./components/sidebar.js").then(
    ({ default: Sidebar }) => new Sidebar(sidebar)
  );
}

// Tooltips
import Tooltips from "./components/tooltips.js";
new Tooltips();

import "./libraries/focus-visible.js";
