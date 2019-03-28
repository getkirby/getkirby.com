export default function debounce(func, wait, scope) {

  let timeout = null;

  return function () {
    const context = scope || this;
    const args    = arguments; /* eslint-disable-line prefer-rest-params */

    const later = function () {
      timeout = null;
      func.apply(context, args);
    };

    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
  };
}
