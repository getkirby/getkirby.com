import ready from "../utils/ready";
import throttle from "../utils/throttle";

function getTippyOptions() {
  return {
    animation: "shift-away",
    arrow: true,
    delay: [150, 300],
    distance: 10,
    duration: [200, 150],
    interactive: true,
    maxWidth: "25rem",
    theme: "kirby",
    // trigger: "click", // Useful for layout debugging, as the tooltip will not fade away if this is active.
  }
}

function checkTooltips(tippy) {
  const tooltips = document.querySelectorAll("[data-tooltip]");

  if(!tooltips.length) {
    // stop here if page does not contain any tooltips
    return;
  }

  for(let i = 0, l = tooltips.length; i < l; i++) {
    const tooltip   = tooltips[i];
    const htmlTitle = tooltip.getAttribute("data-tooltip");
    const htmlContent = `<div class="tippy-inner | text text-small -background:black">${htmlTitle}</div>`;

    // tooltip.setAttribute("title", htmlContent);

    const options = getTippyOptions();

    options.content = htmlContent;

    tippy(tooltip, options);
  }
}

ready().then(() => {
  Promise.all([
    import(
      /* webpackChunkName: "tooltip" */
      /* webpackMode: "lazy" */
      "tippy.js"
    ),
  ]).then(([{ default: tippy }]) => {
    initAutoUpdate(tippy);
  });
});

function initAutoUpdate(tippy) {
  // The MutationObserver listend to all DOM changes and
  // triggers auto-update, if new code blocks have been added,
  // e.g. using AJAX/fetch().

  const throttledCheckTooltips = throttle(() => {
    checkTooltips(tippy);
  }, 250);

  new MutationObserver(throttledCheckTooltips).observe(
    document.documentElement, {
      childList: true,
      subtree: true,
      attributes: false,
      characterData: false
    }
  );

  throttledCheckTooltips();
}
