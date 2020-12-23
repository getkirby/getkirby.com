
import "./components/affiliates.js"
import "./components/lazyloading.js"

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

import "./libraries/focus-visible.js";
