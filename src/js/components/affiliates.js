/* global Paddle */
import loadjs from "loadjs";

const PADDLE_SCRIPT_URL = "https://cdn.paddle.com/paddle/paddle.js";
// ?status=accepted&expires=1561800975&seller=1129&affiliate=35732&link=1546&p_tok=81a1ce11-bc60-4e82-a105-b004ec3d2e2d

function setAffiliate() {

  if ("Paddle" in window || document.querySelector(`script[src="${PADDLE_SCRIPT_URL}"]`) !== null) {
    // don’t do anything further, if the current page already contains
    // the Paddle.js script.
    return;
  }

  const p = new URLSearchParams(window.location.search);

  if (p.has("status") &&
      p.has("expires") &&
      p.has("seller") &&
      p.has("affiliate") &&
      p.has("link") &&
      p.has("p_tok")) {

    loadjs(PADDLE_SCRIPT_URL, () => {
      Paddle.Setup({
        vendor: 1129
      });
    });
  }
}

// Only execute after page was loaded and if browser
// supports `URLSearchParams` interface (i.e. not in IE 11)
if ("URLSearchParams" in window) {
  window.addEventListener("load", setAffiliate);
}
