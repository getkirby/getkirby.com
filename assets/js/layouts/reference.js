export class Menu {
  constructor() {
    this.$menu    = document.querySelector(".reference-menu");
    this.$toggles = this.$menu.querySelectorAll("button");
    this.$sidebar = document.querySelector(".reference-sidebar");
    this.$entries = document.querySelector(".reference-entries");
    this.$content = document.querySelector(".reference-content");

    this.menu = null;
    this.isOpen = false;
    this.hasEntries = !!this.$entries;

    for (let i = 0; i < this.$toggles.length - 1; i++) {
      this.$toggles[i].addEventListener("click", () => {
        this.menu = i === 0 ? this.$sidebar : this.$entries;
        this.open()
      });
    }

    this.$toggles[this.$toggles.length - 1].addEventListener("click", this.close.bind(this));
  }

  toggle() {
    this.isOpen = !this.isOpen;

    if (this.isOpen && this.menu === this.$entries) {
      this.$menu.style.justifyContent = "flex-end";
    } else {
      this.$menu.style.justifyContent = null;
    }

    [...this.$toggles].forEach(toggle => toggle.classList.toggle("hidden"));
  }

  open() {
    this.menu.style.display = "block";
    this.$content.style.display = "none";
    this.toggle();
  }

  close() {
    this.menu.style.display = null;
    this.$content.style.display = null;
    this.menu = null;
    this.toggle();
  }
}
