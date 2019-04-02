if ("kirbyConfig" in window && window.kirbyConfig.assetsPath) {
  // Overrides the public path for lazy-loaded/dynamic imports,
  // so they load from the correct CDN location.
  __webpack_public_path__ = window.kirbyConfig.assetsPath; // eslint-disable-line
}

/* -----  Polyfills  -------------------------------------------------------- */

// Displays focus ring when user tabs, but not when user
// clicks in sth.
import "focus-visible";

/* -----  Components -------------------------------------------------------- */

import "./components/menu-search";
import "./components/sidebar";
import "./components/tooltip";


/* ----- Code Highlighting -------------------------------------------------------- */
import highlight from "./components/code";

highlight();
