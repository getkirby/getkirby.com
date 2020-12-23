// Load config package first, to set CDN path. The
// corresponding code has to be in its own package, otherwise
// it would not execute before any other imports are resolved.
import "./components/config";

/* -----  Components -------------------------------------------------------- */

import "./components/menu-search";
import "./components/tooltip";
