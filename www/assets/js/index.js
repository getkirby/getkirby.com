
window.component = async (source, selector) => {
  // If no selector was passed, just load and invoke the element
  if (!selector) {
    const { default: Component } = await import(source);
    return new Component();
  }

  // If selector string was passed, query document for elements
  const elements = document.querySelectorAll(selector);

  if (elements.length > 0) {
    const { default: Component } = await import(source);
    for (let i = 0; i < elements.length; i++) {
      new Component(elements[i]);
    }
  }
}

component("./components/menu.js", ".menu");
component("./components/search.js", ".search");
component("./components/sidebar.js", ".js-sidebar");
component("./components/code.js");
component("./components/affiliates.js");

import "./components/lazyloading.js";
import "./libraries/focus-visible.js";
