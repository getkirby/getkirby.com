
import "./components/affiliates.js"
import "./components/lazyloading.js"

// Menu
import Menu from "./components/menu.js"
const menu = document.querySelector(".menu");

if (menu) {
  new Menu(menu);
}

// Sidebar
import Sidebar from "./components/sidebar.js"
const sidebar = document.querySelector(".js-sidebar");

if (sidebar) {
  new Sidebar(sidebar);
}

import "./libraries/focus-visible.js";
