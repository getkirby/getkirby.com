const ALGOLIA_APP = "S7OGBIAJTV";
const ALGOLIA_KEY = "d161a2f4cd2d69247c529a3371ad3050";
const ALGOLIA_INDEX = "getkirby-3";

// Placeholder string used to distinguish the "view all" preudo-result
// from regular search results
const VIEW_ALL_RESULTS_LABEL = "VIEW_ALL_RESULTS_UXfpeDFlmye9rXkXP5wd";
const SEARCH_ERROR_LABEL = "SEARCH_ERROR_UXfpeDFlmye9rXkXP5wd";
const CHEVRON_RIGHT_SVG =
  '<svg viewBox="0 0 5 11" width="5" height="11" aria-hidden="true"><path d="M2.96153846,5.41538462 L0,9.13846154 L1.35384615,10.1538462 L4.73846154,5.92307692 C4.82307692,5.75384615 4.90769231,5.58461538 4.90769231,5.41538462 C4.90769231,5.24615385 4.82307692,5.07692308 4.73846154,4.90769231 L1.35384615,0.676923077 L0,1.69230769 L2.96153846,5.41538462 Z"/></svg>';

export default class {
  constructor(element) {
    this.init(element);
  }

  async init(element) {
    this.$el = element;

    await import("../libraries/algoliasearch.js");
    await import("../libraries/awesomplete.js");

    this.input = this.$el.querySelector(".js-menu-search-input");
    this.client = algoliasearch(ALGOLIA_APP, ALGOLIA_KEY);
    this.index = this.client.initIndex(ALGOLIA_INDEX);
    this.recent = "";
    this.list = [];
    this.awesome = new Awesomplete(this.input, {
      list: [],
      filter: () => true,
      sort: false,
      item: this.item,
    });

    this.input.addEventListener("focus", this.onFocus.bind(this));
    this.input.addEventListener("blur", this.onBlur.bind(this));
    this.input.addEventListener("keypress", this.onKeypress.bind(this));
    this.input.addEventListener("keyup", this.onKeyup.bind(this), 250);
    this.input.addEventListener("awesomplete-select", this.onSelect.bind(this));
  }

  item(text) {
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
  }

  onBlur() {
    document.documentElement.classList.remove("is-menu-search-open");
  }

  onFocus() {
    // helper class used by the reference templates’ CSS
    document.documentElement.classList.add("is-menu-search-open");
  }

  onKeypress(e) {
    if ((e.key && e.key === "Enter") || e.keyCode === 13) {
      this.$el.submit();
    }
  }

  async onKeyup() {
    const value = this.input.value.trim();

    if (value === this.recent) {
      return true;
    }

    this.recent = value;
    this.list = [];

    if (value === "") {
      this.awesome.list = this.list;
      this.awesome.evaluate();
      return true;
    }

    // don't search for very short words
    if (value.length <= 2) {
      return true;
    }

    const params = {
      hitsPerPage: 5,
    };

    const filters = this.input.getAttribute("data-filters");

    if (filters) {
      params.filters = filters;
    }

    const { hits, nbHits, hitsPerPage } = await this.index.search(
      value,
      params
    );

    for (var i = 0, l = hits.length; i < l; i++) {
      const item = hits[i];
      this.list.push({
        label: item.title,
        value: item.objectID,
      });
    }

    // Show View all item if there are any hits and
    // there are more hits than those displayed in the popup.
    if (nbHits > 0 && nbHits > hitsPerPage) {
      this.list.push({
        label: VIEW_ALL_RESULTS_LABEL,
        value: nbHits,
      });
    }

    this.awesome.list = this.list;
    this.awesome.evaluate();
    this.awesome.open();
  }

  onSelect(e) {
    e.preventDefault();

    // When the "view all results" or "error" entry was clicked/selected,
    // submit the form to go to the regular search results page.
    if (
      e.text.label === VIEW_ALL_RESULTS_LABEL ||
      e.text.label === SEARCH_ERROR_LABEL
    ) {
      this.$el.submit();

      // Regular search result selected.
    } else {
      window.location.href = `/${e.text.value}`;
    }
  }
}
