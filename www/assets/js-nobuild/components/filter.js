export default function () {
  return {
    q: "",
    init: function () {
      // get all filterable elements
      const items = this.$el.querySelectorAll("[data-filter]");

      // on change of the query terms, loop through all
      // elements and show or hide if matching searh term
      this.$watch("q", function (q) {
        items.forEach(function (item) {
          if (q === "" || item.dataset.filter.toLowerCase().includes(q.toLowerCase())) {
            item.style.display = "block";
          } else {
            item.style.display = "none";
          }
        })
      });
    }
  }
}
