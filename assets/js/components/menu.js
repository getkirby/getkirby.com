export default class {
  constructor() {
    this.$el = document.querySelector(".menu-toggle");

    if (this.$el) {
      this.$el.addEventListener("keydown", this.onKey, true);
    }
  }

  onKey(e) {
    if (e.key === "Enter") {
      e.target.click();
    }
  }
}
