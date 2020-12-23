
import "./components/affiliates.js"
import "./components/lazyloading.js"
import "./components/search.js"

// Code highlighting
import Code from "./components/code.js";
new Code();

// Menu
import Menu from "./components/menu.js"
const menu = document.querySelector(".menu");

if (menu) {
  new Menu(menu);
}

// Guide sidebar
import Sidebar from "./components/sidebar.js"
const sidebar = document.querySelector(".js-sidebar");

if (sidebar) {
  new Sidebar(sidebar);
}

// Tooltips
import Tooltips from "./components/tooltips.js"
new Tooltips();

import "./libraries/focus-visible.js";
