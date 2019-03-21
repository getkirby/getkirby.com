const $ = (selector) => {
  return document.querySelector(selector);
};

const $$ = (selector) => {
  return [].slice.call(document.querySelectorAll(selector));
};

export { $, $$ };
