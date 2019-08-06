// Load config package first, to set CDN path. The
// corresponding code has to be in its own package, otherwise
// it would not execute before any other imports are resolved.
import "./components/config";

/* -----  Polyfills  -------------------------------------------------------- */

// Displays focus ring when user tabs, but not when user
// clicks in sth.
import "focus-visible";

/* -----  Components -------------------------------------------------------- */

import "./components/affiliates";
import "./components/copyfix";
import "./components/lazyloading";
import "./components/menu";
import "./components/menu-search";
import "./components/sidebar";
import "./components/tooltip";


/* ----- Code Highlighting -------------------------------------------------------- */

import highlight from "./components/code";

highlight();
