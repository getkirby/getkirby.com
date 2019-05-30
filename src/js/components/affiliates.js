/* global Paddle */
import loadjs from "loadjs";

const PADDLE_VENDOR_ID = 1129;
const PADDLE_SCRIPT_URL = "https://cdn.paddle.com/paddle/paddle.js";

function setAffiliate() {

  if ("Paddle" in window || document.querySelector(`script[src="${PADDLE_SCRIPT_URL}"]`) !== null) {
    // don’t do anything further, if the current page already contains
    // the Paddle.js script.
    return;
  }

  const p = new URLSearchParams(window.location.search);

  if (p.has("status") && p.has("expires") &&
      p.has("seller") && p.has("affiliate") &&
      p.has("link") && p.has("p_tok")) {
    // load paddle.js and set vendor id, if coming from an affiliate
    // link, so the script can store affiliate tracking information
    // in a cookie.
    loadjs(PADDLE_SCRIPT_URL, () => {
      Paddle.Setup({
        vendor: PADDLE_VENDOR_ID,
      });
    });
  }
}

// Only execute after page was loaded and if browser
// supports `URLSearchParams` interface (i.e. not in IE 11)
if ("URLSearchParams" in window) {
  window.addEventListener("load", setAffiliate);
}
