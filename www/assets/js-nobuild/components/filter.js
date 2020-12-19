export default function () {
  return {
    q: "",
    init: function () {
      // get all filterable elements
      const items     = this.$el.querySelectorAll("[data-filter]");
      const container = this.$el;

      // on change of the query terms
      this.$watch("q", function (q) {

        // add/remove class to container element
        if (q !== "") {
          container.classList.add("searching");
        } else {
          container.classList.remove("searching");
        }

        // loop through all elements and
        // show or hide if matching searh term
        items.forEach(function (item) {
          if (q === "" || item.dataset.filter.toLowerCase().includes(q.toLowerCase())) {
            item.style.removeProperty("display");
          } else {
            item.style.display = "none";
          }
        })
      });
    }
  }
}
