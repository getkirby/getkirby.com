
class Paddle {
  async load() {
    const PADDLE_SCRIPT_URL = "https://cdn.paddle.com/paddle/paddle.js";

    // don’t do anything further, if the current page already contains
    // the Paddle.js script.
    if (
      "Paddle" in window ||
      document.querySelector(`script[src="${PADDLE_SCRIPT_URL}"]`) !== null
    ) {
      return;
    }

    // create script tag for external paddle.js
    const script = document.createElement("script");
    script.src = PADDLE_SCRIPT_URL;

    // set callback for when script is loaded
    script.onload = () => {
      window.Paddle.Setup({ vendor: 1129 });
    };

    // insert in DOM
    const at = document.getElementsByTagName("script")[0];
    at.parentNode.insertBefore(script, at);
  }
}

export class Affiliates extends Paddle {
  constructor() {
    super();
    const p = new URLSearchParams(window.location.search);

    // load paddle.js and set vendor id, if coming from an affiliate
    // link, so the script can store affiliate tracking information
    // in a cookie.
    if (
      p.has("status") &&
      p.has("expires") &&
      p.has("seller") &&
      p.has("affiliate") &&
      p.has("link") &&
      p.has("p_tok")
    ) {
      this.load();
    }
  }
}
