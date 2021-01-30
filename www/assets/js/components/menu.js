
export default class {

  constructor() {
    this.$el       = document.querySelector(".menu");

    if (!this.$el) {
      return;
    }

    this.mobile    = document.querySelector("button[aria-controls]");
    this.isOpen    = false;
    this.dropdowns = this.$el.querySelectorAll(".menu-item.has-dropdown");
    this.current   = null;

    this.handleGlobalClickForMobileMenuBound = this.handleGlobalClickForMobileMenu.bind(this);
    this.handleGlobalEventForSubmenusBound = this.handleGlobalEventForSubmenus.bind(this);


    this.media = matchMedia("(min-width: 56em)");
    this.media.addListener(this.toggleDesktopAndMobileMenu.bind(this));
    this.init();
  }

  init() {
    this.mobile.addEventListener("click", (e) => {
      e.preventDefault();
      this.toggleMobilePopup();
    });

    for (let i = 0, l = this.dropdowns.length; i < l; i++) {
      const item = this.dropdowns[i];
      const link = item.querySelector("a");

      link.addEventListener("touchend", (e) => {
          if (!this.isDesktop()) {
            return;
          }

          e.preventDefault();
          this.toggleDropdown(item);
      });

      link.addEventListener("mouseenter", (e) => {
        if (!this.isDesktop()) {
          return;
        }
        this.toggleDropdown(item, true);
      });

      link.addEventListener("focus", (e) => {
        if (!this.isDesktop()) {
          return;
        }
        this.toggleDropdown(item, true);
      });

      item.addEventListener("mouseleave", (e) => {
        if (!this.isDesktop()) {
          return;
        }
        this.toggleDropdown(item, false);
      });
    }

    this.toggleDesktopAndMobileMenu();
  }

  handleGlobalEventForSubmenus(e) {
    if (this.current === null) {
      return;
    }

    if (this.current.contains(e.target) === false) {
      this.toggleDropdown(this.current, false);
    }
  }

  toggleDesktopAndMobileMenu() {
    if(this.isDesktop()) {
      this.mobile.setAttribute("aria-hidden", "true");
      this.mobile.hidden = true;
    } else {
      this.mobile.removeAttribute("aria-hidden");
      this.mobile.hidden = false;
    }
  }

  isDesktop() {
    return this.media.matches;
  }

  closeAllSubmenus() {
    for (let i = 0, l = this.dropdowns.length; i < l; i++) {
      const subItem = this.dropdowns[i];
      this.toggleDropdown(subItem, false);
    }
  }

  toggleDropdown(item, force) {

    let newState = !item.classList.contains("is-open");

    if (typeof force !== "undefined") {
      if (force !== newState) {
        return;
      }
      newState = force;
    }

    if (newState === true) {
      for (let i = 0, l = this.dropdowns.length; i < l; i++) {
        const subItem = this.dropdowns[i];
        this.toggleDropdown(subItem, false);
      }
    }

    item.classList.toggle("is-open", newState);

    if (this.current === null) {
      window.addEventListener("focusin", this.handleGlobalEventForSubmenusBound);
      document.body.addEventListener("click", this.handleGlobalEventForSubmenusBound);
      document.body.addEventListener("touchstart", this.handleGlobalEventForSubmenusBound);
    }

    this.current = newState ? item : null;

    if (this.current === null) {
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

    this.mobile.setAttribute("aria-expanded", newState ? "true" : "false");
    this.mobile.setAttribute("aria-label", newState ? "Close menu" : "Open menu");

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
    if (!this.$el.contains(e.target)) {
      e.preventDefault();
      this.toggleMobilePopup(false);
    }
  }
}
