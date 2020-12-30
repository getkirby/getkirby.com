
window.addEventListener("load", async function() {

  const PADDLE_VENDOR_ID  = 1129;
  const PADDLE_SCRIPT_URL = "https://cdn.paddle.com/paddle/paddle.js";

  // don’t do anything further, if the current page already contains
  // the Paddle.js script.
  if ("Paddle" in window || document.querySelector(`script[src="${PADDLE_SCRIPT_URL}"]`) !== null) {
    return;
  }

  const p = new URLSearchParams(window.location.search);

  // load paddle.js and set vendor id, if coming from an affiliate
  // link, so the script can store affiliate tracking information
  // in a cookie.
  if (p.has("status") && p.has("expires") &&
      p.has("seller") && p.has("affiliate") &&
      p.has("link") && p.has("p_tok")) {

    const { default: loadjs } = await import("../utils/loadjs.js");

    loadjs(PADDLE_SCRIPT_URL, () => {
      Paddle.Setup({
        vendor: PADDLE_VENDOR_ID,
      });
    });
  }
});
