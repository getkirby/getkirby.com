// if browser does not support `:focus-within`
// pseudo-selector, inits a polyfill (IE/Edge)
const focusWithin = (function () {

  try {
    // if `document.querySelector()` does not throw an error,
    // an empty function is returned, because the browser
    // supports the `:focus-within` pseudo-selector and thus
    // does not need a polyfill.
    document.querySelector(":focus-within");
    return function() {}; /* eslint-disable-line no-empty-function */
  } catch (err) {

    return function (node) {

      if(document.activeElement && node.contains(document.activeElement)) {
        node.classList.add("is-focus-within");
      }

      node.addEventListener("focus", function () {
        node.classList.add("is-focus-within");
      }, true);

      node.addEventListener("blur", function () {
        if(!node.contains(document.activeElement)) {
          node.classList.remove("is-focus-within");
        }
      }, true);

    };
  }
})();

export { focusWithin };

