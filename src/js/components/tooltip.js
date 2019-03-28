import ready from "../utils/ready";

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
    trigger: "click", // Useful for layout debugging, as the tooltip will not fade away if this is active.
  }
}

ready().then(() => {

  const tooltips = document.querySelectorAll("[data-tooltip]");

  if(!tooltips.length) {
    // stop here if page does not contain any tooltips
    return;
  }

  Promise.all([
    import(
      /* webpackChunkName: "tooltip" */
      /* webpackMode: "lazy" */
      "tippy.js"
    ),
  ]).then(([{ default: tippy }]) => {

    for(let i = 0, l = tooltips.length; i < l; i++) {
      const tooltip   = tooltips[i];
      const htmlTitle = tooltip.getAttribute("data-tooltip");
      const htmlContent = `<div class="tippy-inner | text text-small -background:black">${htmlTitle}</div>`;

      // tooltip.setAttribute("title", htmlContent);

      const options = getTippyOptions();

      options.content = htmlContent;

      tippy(tooltip, options);

    }

  });

});
