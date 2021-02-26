export default class {

  constructor(selector) {
    this.$el   = document.querySelector(selector);
    this.input = this.$el.querySelector("input.filter-search");
    this.items = this.$el.querySelectorAll("[data-filter]");

    // listen to any changes on the search input
    this.input.addEventListener("input", this.onInput.bind(this));
  }

  onInput(e) {
    const q = e.target.value.toLowerCase();

    // add/remove class to container element
    this.$el.classList[this.q !== "" ? "add" : "remove"]("searching");

    // loop through all elements and
    // show or hide if matching search term
    this.items.forEach(function (item) {
      const content = item.dataset.filter.toLowerCase();

      if (q === "" || content.includes(q)) {
        item.style.removeProperty("display");
      } else {
        item.style.display = "none";
      }
    });
  }
}
