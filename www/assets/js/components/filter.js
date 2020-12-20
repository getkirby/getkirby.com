
export default function (selector) {

  const container = document.querySelector(selector);
  const input     = container.querySelector("input.filter-search");
  const items     = container.querySelectorAll("[data-filter]");

  // listen to any changes on the search input
  input.addEventListener("input", function (e) {

    const q = e.target.value.toLowerCase();

    // add/remove class to container element
    if (q !== "") {
      container.classList.add("searching");
    } else {
      container.classList.remove("searching");
    }

    // loop through all elements and
    // show or hide if matching search term
    items.forEach(function (item) {
      const content = item.dataset.filter.toLowerCase();

      if (q === "" || content.includes(q)) {
        item.style.removeProperty("display");
      } else {
        item.style.display = "none";
      }
    });

  });
}
