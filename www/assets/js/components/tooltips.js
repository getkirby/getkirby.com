
export default class {

  constructor() {
    this.tooltips = [];

    // The MutationObserver listend to all DOM changes and
    // triggers auto-update, if new tooltips have been added,
    // e.g. using AJAX/fetch().

    new MutationObserver(this.init.bind(this)).observe(
      document.documentElement, {
        childList: true,
        subtree: true,
        attributes: false,
        characterData: false
      }
    );

    this.init();
  }

  async init() {
    const tooltips = document.querySelectorAll("[data-tooltip]");

    // stop here if page does not contain any tooltips
    if(!tooltips.length) {
      return;
    }

    await import("../libraries/popper.min.js");
    await import("../libraries/tippy.min.js");

    for(let i = 0, l = tooltips.length; i < l; i++) {

      // Make sure to only initalize the same tooltip once
      if (this.tooltips.includes(tooltips[i])) {
        continue;
      }

      this.tooltips.push(tooltips[i]);

      tippy(tooltips[i], {
        arrow: true,
        allowHTML: true,
        interactive: true,
        delay: [150, 300],
        offset: [0, 10],
        duration: [200, 150],
        maxWidth: "25rem",
        theme: "kirby",
        appendTo: document.body,
        content: (reference) => {
          return `<div class="tippy-inner | text text-small -background:black">${reference.getAttribute("data-tooltip")}</div>`;
        }
      });
    }
  }

}
