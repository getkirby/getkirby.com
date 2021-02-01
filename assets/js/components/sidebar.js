
export default class {

  constructor() {
    const sidebar = this;
    this.$el      = document.querySelector(".js-sidebar");

    if (!this.$el) {
      return;
    }

    this.toggles  = this.$el.querySelectorAll(".js-sidebar-toggle");

    for(let i = 0; i < this.toggles.length; i++) {
      this.toggles[i].addEventListener("click", function (e) {
        e.preventDefault();
        sidebar.toggleSubmenu(this.parentNode);
      })
    }
  }

  toggleSubmenu(item) {
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
      this.enableSubmenuLinks(submenu);
    } else {
      // hide submenu
      submenu.hidden = true
      toggle.setAttribute("aria-expanded", "false");

      this.disableSubmenuLinks(submenu);
    }

    return true;
  }

  enableSubmenuLinks(submenu) {
    for(let i = 0, items = submenu.querySelectorAll("a"), l = items.length; i < l; i++) {
      items[i].setAttribute("tabindex", "0");
    }
  }

  disableSubmenuLinks(submenu) {
    for(let i = 0, items = submenu.querySelectorAll("a"), l = items.length; i < l; i++) {
      items[i].setAttribute("tabindex", "-1");
    }
  }

}
