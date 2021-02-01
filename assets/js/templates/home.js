
/**
 *  Update main screenshot of gallery
 */

const screenshot = document.querySelector(".home-panel-gallery .screenshot");
const links      = document.querySelectorAll(".home-panel-gallery-links a");

links.forEach(function (link) {
  link.addEventListener("click", function (e) {
    e.preventDefault();

    const current = document.querySelector(".home-panel-gallery-links a[aria-current]")
    current.removeAttribute("aria-current");

    while (screenshot.firstChild) {
      screenshot.removeChild(screenshot.firstChild);
    }

    screenshot.appendChild(this.querySelector(".intrinsic").cloneNode(true));

    link.setAttribute("aria-current", "true");
  }, true);
});
