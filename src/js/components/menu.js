import { $, $$ } from "../utils/selector";
import ready from "../utils/ready";

class Menu {

  constructor(el) {
    this.el     = el;
    this.mobileToggleButton = $("button[aria-controls]");
    this.menu   = $("#menu");
    this.isOpen = false;
    this.submenuItems = this.menu.querySelectorAll(".menu-item.has-dropdown");
    this.handleGlobalClickForMobileMenuBound = this.handleGlobalClickForMobileMenu.bind(this);
    this.handleGlobalEventForSubmenusBound = this.handleGlobalEventForSubmenus.bind(this);

    this.currentSubmenu = null;

    this.mediaQuery = matchMedia("(min-width: 56em)");
    this.mediaQuery.addListener(this.toggleDesktopAndMobileMenu.bind(this));
    this.init();
  }

  init() {
    this.mobileToggleButton.addEventListener("click", (e) => {
      e.preventDefault();
      this.toggleMobilePopup();
    });

    for (let i = 0, l = this.submenuItems.length; i < l; i++) {
      const item = this.submenuItems[i];
      const link = item.querySelector("a");

      link.addEventListener("touchend", (e) => {
          if (!this.isDesktop()) {
            return;
          }

          e.preventDefault();
          this.toggleSubmenu(item);
      });

      link.addEventListener("mouseenter", (e) => {
        if (!this.isDesktop()) {
          return;
        }
        this.toggleSubmenu(item, true);
      });

      link.addEventListener("focus", (e) => {
        if (!this.isDesktop()) {
          return;
        }
        this.toggleSubmenu(item, true);
      });

      item.addEventListener("mouseleave", (e) => {
        if (!this.isDesktop()) {
          return;
        }
        this.toggleSubmenu(item, false);
      });
    }

    this.toggleDesktopAndMobileMenu();
  }

  handleGlobalEventForSubmenus(e) {
    if (this.currentSubmenu === null) {
      return;
    }

    if (this.currentSubmenu.contains(e.target) === false) {
      this.toggleSubmenu(this.currentSubmenu, false);
    }
  }

  toggleDesktopAndMobileMenu() {
    if(this.isDesktop()) {
      this.mobileToggleButton.setAttribute("aria-hidden", "true");
      this.mobileToggleButton.hidden = true;
    } else {
      this.mobileToggleButton.removeAttribute("aria-hidden");
      this.mobileToggleButton.hidden = false;
    }
  }

  isDesktop() {
    return this.mediaQuery.matches;
  }

  closeAllSubmenus() {
    for (let i = 0, l = this.submenuItems.length; i < l; i++) {
      const subItem = this.submenuItems[i];
      this.toggleSubmenu(subItem, false);
    }
  }

  toggleSubmenu(item, force) {

    let newState = !item.classList.contains("is-open");

    if (typeof force !== "undefined") {
      if (force !== newState) {
        return;
      }
      newState = force;
    }

    if (newState === true) {
      for (let i = 0, l = this.submenuItems.length; i < l; i++) {
        const subItem = this.submenuItems[i];
        this.toggleSubmenu(subItem, false);
      }
    }

    item.classList.toggle("is-open", newState);

    if (this.currentSubmenu === null) {
      window.addEventListener("focusin", this.handleGlobalEventForSubmenusBound);
      document.body.addEventListener("click", this.handleGlobalEventForSubmenusBound);
      document.body.addEventListener("touchstart", this.handleGlobalEventForSubmenusBound);
    }

    this.currentSubmenu = newState ? item : null;

    if (this.currentSubmenu === null) {
      window.removeEventListener("focusin", this.handleGlobalEventForSubmenusBound);
      document.body.removeEventListener("click", this.handleGlobalEventForSubmenusBound);
      document.body.removeEventListener("touchstart", this.handleGlobalEventForSubmenusBound);
    }
  }

  toggleMobilePopup(force) {

    let newState = !this.isOpen;

    if (typeof force !== "undefined") {
      if (force === this.isOpen) {
        return;
      }
      newState = force;
    }

    this.mobileToggleButton.setAttribute("aria-expanded", newState ? "true" : "false");
    this.mobileToggleButton.setAttribute("aria-label", newState ? "Close menu" : "Open menu");

    setTimeout(() => {
      if (newState) {
        window.addEventListener("click", this.handleGlobalClickForMobileMenuBound);
      } else {
        window.removeEventListener("click", this.handleGlobalClickForMobileMenuBound);
      }
    }, 0);

    this.isOpen = newState;
  }

  handleGlobalClickForMobileMenu(e) {
    if (!this.menu.contains(e.target)) {
      e.preventDefault();
      this.toggleMobilePopup(false);
    }
  }

}

ready(() => {

  const menu = $(".menu");

  if (menu) {
    new Menu(menu);
  }

});
