const ALGOLIA_APP = "S7OGBIAJTV";
const ALGOLIA_KEY = "d161a2f4cd2d69247c529a3371ad3050";
const ALGOLIA_INDEX = "getkirby-3";

// Placeholder string used to distinguish the "view all" preudo-result
// from regular search results
const VIEW_ALL_RESULTS_LABEL = "VIEW_ALL_RESULTS_UXfpeDFlmye9rXkXP5wd";
const SEARCH_ERROR_LABEL = "SEARCH_ERROR_UXfpeDFlmye9rXkXP5wd";
const CHEVRON_RIGHT_SVG =
  '<svg viewBox="0 0 5 11" width="5" height="11" aria-hidden="true"><path d="M2.96153846,5.41538462 L0,9.13846154 L1.35384615,10.1538462 L4.73846154,5.92307692 C4.82307692,5.75384615 4.90769231,5.58461538 4.90769231,5.41538462 C4.90769231,5.24615385 4.82307692,5.07692308 4.73846154,4.90769231 L1.35384615,0.676923077 L0,1.69230769 L2.96153846,5.41538462 Z"/></svg>';

document.addEventListener("DOMContentLoaded", async function () {
  const form = document.querySelector(".js-menu-search");

  // abort initialization if there’s no search form
  if (!form) {
    return;
  }

  await import("../libraries/algoliasearch.js");
  await import("../libraries/awesomplete.js");

  const input = document.querySelector(".js-menu-search-input");
  const client = algoliasearch(ALGOLIA_APP, ALGOLIA_KEY);
  const index = client.initIndex(ALGOLIA_INDEX);

  let lastValue = "";
  let list = [];

  const awesome = new Awesomplete(input, {
    list: [],
    filter: () => true,
    sort: false,
    item: (text /*, input */) => {
      const item = document.createElement("li");

      if (text.label === VIEW_ALL_RESULTS_LABEL) {
        // view all link
        item.classList.add("menu-search-view-all");
        item.innerHTML = `<strong>View all results</strong>${CHEVRON_RIGHT_SVG}`;
      } else if (text.label === SEARCH_ERROR_LABEL) {
        // error message link
        item.classList.add("menu-search-error");
        item.innerHTML = `<strong>Sorry, an error occured. Please try advanced search instead.</strong>${CHEVRON_RIGHT_SVG}`;
      } else {
        // regular result
        item.innerHTML = `<strong>${text.label}</strong> <small>${text.value}</small>`;
      }

      return item;
    },
  });

  input.addEventListener("focus", () => {
    // helper class used by the reference templates’ CSS
    document.documentElement.classList.add("is-menu-search-open");
  });

  input.addEventListener("blur", () => {
    document.documentElement.classList.remove("is-menu-search-open");
  });

  input.addEventListener("keypress", (e) => {
    if ((e.key && e.key === "Enter") || e.keyCode === 13) {
      form.submit();
    }
  });

  input.addEventListener(
    "keyup",
    () => {
      const value = input.value.trim();

      if (value === lastValue) {
        return true;
      } else if (value === "") {
        lastValue = "";
        list = [];
        awesome.list = list;
        awesome.evaluate();
        return true;
      }

      lastValue = value;

      if (value.length <= 2) {
        // don't search for very short words
        return true;
      }

      setTimeout(function () {
        const params = {
          hitsPerPage: 5,
        };

        const filters = input.getAttribute("data-filters");

        if (filters) {
          params.filters = filters;
        }

        /* eslint-disable handle-callback-err */
        index.search(value, params, (err, content) => {
          list = [];

          if (err) {
            /* eslint-disable no-console */
            if ("console" in window) {
              console.error("Quicksearch error", err);
            }
            /* eslint-enable no-console */

            list.push({
              label: SEARCH_ERROR_LABEL,
              value: 0,
            });

            awesome.list = list;
            awesome.evaluate();
            awesome.open();

            return;
          }

          for (var i = 0, l = content.hits.length; i < l; i++) {
            const item = content.hits[i];
            list.push({
              label: item.title,
              value: item.objectID,
            });
          }

          if (content.nbHits > 0 && content.nbHits > content.hitsPerPage) {
            // Show View all item if there are any hits and
            // there are more hits than those displayed in the popup.
            list.push({
              label: VIEW_ALL_RESULTS_LABEL,
              value: content.nbHits,
            });
          }

          awesome.list = list;
          awesome.evaluate();
          awesome.open();
        });
      });
    },
    250
  );

  input.addEventListener("awesomplete-select", (e /*, item */) => {
    e.preventDefault();

    // When the "view all results" or "error" entry was clicked/selected,
    // submit the form to go to the regular search results page.
    if (
      e.text.label === VIEW_ALL_RESULTS_LABEL ||
      e.text.label === SEARCH_ERROR_LABEL
    ) {
      form.submit();

      // Regular search result selected.
    } else {
      window.location.href = `/${e.text.value}`;
    }
  });
});
