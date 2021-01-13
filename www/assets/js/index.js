import { component } from "./utils/load.js";

component("../components/menu.js", ".menu");
component("../components/search.js", ".js-menu-search");
component("../components/sidebar.js", ".js-sidebar");
component("../components/code.js");
component("../components/affiliates.js");

import "./components/lazyloading.js";
import "./libraries/focus-visible.js";
