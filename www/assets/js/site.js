
// Lazy loading
import "./components/lazyloading.js"

// Menu
import Menu from "./components/menu.js"
const menu = document.querySelector(".menu");

if (menu) {
  new Menu(menu);
}
