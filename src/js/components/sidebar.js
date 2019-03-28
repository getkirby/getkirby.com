import { on } from "../utils/events";
import ready from "../utils/ready";

function enableSubmenuLinks(submenu) {
  for(let i = 0, items = submenu.querySelectorAll("a"), l = items.length; i < l; i++) {
    items[i].setAttribute("tabindex", "0");
  }
}

function disableSubmenuLinks(submenu) {
  for(let i = 0, items = submenu.querySelectorAll("a"), l = items.length; i < l; i++) {
    items[i].setAttribute("tabindex", "-1");
  }
}

function toggleSubmenu(item) {

  const toggle = item.querySelector("[aria-expanded]");

  if(!toggle) {
    return false;
  }

  const submenu = item.querySelector(".js-sidebar-submenu");
  const isOpen  = !submenu.hidden;

  if(!isOpen) {
    // show submenu
    toggle.setAttribute("aria-expanded", "true");
    submenu.hidden = false;
    enableSubmenuLinks(submenu);
  } else {
    // hide submenu
    submenu.hidden = true
    toggle.setAttribute("aria-expanded", "false");

    disableSubmenuLinks(submenu);
  }

  return true;

}

ready().then(() => {

  const sidebar = document.querySelector(".js-sidebar");

  if(!sidebar) {
    return;
  }

  on(sidebar, "keydown", "a.sidebar-item-link", function (e) {
    if ((e.key && (e.key === "ArrowRight" || e.key === "ArrowLeft")) || (e.keyCode === 39 || e.keyCode === 37)) {
      if (toggleSubmenu(this.parentNode)) {
        e.preventDefault();
      }
    }
  });

  on(sidebar, "click", ".js-sidebar-toggle", function (e) {
    e.preventDefault();
    toggleSubmenu(this.parentNode);
  });

});
