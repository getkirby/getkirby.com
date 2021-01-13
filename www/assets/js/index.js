import "./components/affiliates.js";
import "./components/lazyloading.js";

// Code highlighting
import Code from "./components/code.js";
new Code();

// Components
const component = async (selector, source) => {
  const element = document.querySelector(selector);

  if (element) {
    const { default: Component } = await import(source);
    new Component(element);
  }
};

component(".menu", "./components/menu.js");
component(".js-menu-search", "./components/search.js");
component(".js-sidebar", "./components/sidebar.js");

import "./libraries/focus-visible.js";
