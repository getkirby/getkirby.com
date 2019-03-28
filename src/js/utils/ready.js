/**
 * Executes an optional callback function and always returns a promise, which resolves
 * once the DOM is ready.
 *
 * @param {function} fn An optional callback function.
 * @return {Promice} A promise which resolves once the DOM is ready.
 */
export default function ready(fn = function() {}) { /* eslint-disable-line no-empty-function */
  return new Promise((resolve) => {
    if (document.readyState !== "loading") {
      fn();
      resolve();
    } else {
      document.addEventListener("DOMContentLoaded", () => {
        fn();
        resolve();
      });
    }
  });

}
