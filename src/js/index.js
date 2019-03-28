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
