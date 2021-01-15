const ALGOLIA_APP = "S7OGBIAJTV";
const ALGOLIA_KEY = "d161a2f4cd2d69247c529a3371ad3050";
const ALGOLIA_INDEX = "getkirby-3";

export default class {

  constructor(element) {
    this.$el = element;
    this.input = this.$el.querySelector("input");
    this.list = null;

    this.q = "";
    this.results = [];
    this.selected = null;

    this.$el.addEventListener("keydown", this.onKey.bind(this));
    this.input.addEventListener("input", this.onInput.bind(this));
    this.input.addEventListener("focus", this.onFocus.bind(this));
    document.addEventListener("click", this.onBlur.bind(this));
  }

  build() {
    this.remove();

    if (this.results.length === 0) {
      return;
    }

    this.list = document.createElement("ul");

    for (let i = 0; i < this.results.length; i++) {
      const entry = this.item(this.results[i]);
      this.list.appendChild(entry);
    }

    this.input.after(this.list);
  }

  item(entry) {
    const item = document.createElement("li");
    const link = document.createElement("a");
    link.href = "/" + entry.value;

    // View all link
    if (entry.label === "VIEW_ALL_RESULTS") {
      link.classList.add("view-all");
      link.innerHTML = `<strong>View all results</strong><svg viewBox="0 0 5 11" width="5" height="11" aria-hidden="true"><path d="M2.96153846,5.41538462 L0,9.13846154 L1.35384615,10.1538462 L4.73846154,5.92307692 C4.82307692,5.75384615 4.90769231,5.58461538 4.90769231,5.41538462 C4.90769231,5.24615385 4.82307692,5.07692308 4.73846154,4.90769231 L1.35384615,0.676923077 L0,1.69230769 L2.96153846,5.41538462 Z"/></svg>`;
    } else {
      link.innerHTML = `<strong>${entry.label}</strong> <small>${entry.value}</small>`;
    }

    item.appendChild(link);
    return item;
  }

  remove() {
    this.selected = null;

    if (this.list) {
      this.list.remove();
    }
  }

  async search(value) {
    const results = [];

    // Gather params for Algolia API call
    const params = {
      query: value,
      hitsPerPage: 5,
    };

    const filters = this.input.getAttribute("data-filters");

    if (filters) {
      params.filters = filters;
    }

    // Call the Algolia API
    const response = await fetch(
      `https://${ALGOLIA_APP}-dsn.algolia.net/1/indexes/${ALGOLIA_INDEX}/query`,
      {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-Algolia-Application-Id": ALGOLIA_APP,
          "X-Algolia-API-Key": ALGOLIA_KEY,
        },
        body: JSON.stringify(params),
      }
    );
    const { hits, nbHits, hitsPerPage } = await response.json();

    // Create a result entry per hit
    for (var i = 0, l = hits.length; i < l; i++) {
      results.push({
        label: hits[i].title,
        value: hits[i].objectID,
      });
    }

    // Show View all item if there are any hits and
    // there are more hits than those displayed in the popup.
    if (nbHits > 0 && nbHits > hitsPerPage) {
      results.push({
        label: "VIEW_ALL_RESULTS",
        value: "search?q=" + value,
      });
    }

    return results;
  }

  select() {
    if (this.list) {
      // clear previous selection
      const previous = this.list.querySelector("[aria-selected=true]");
      if (previous) {
        previous.setAttribute("aria-selected", false);
      }

      // set new selection
      if (this.selected !== null) {
        this.list.childNodes[this.selected].setAttribute("aria-selected", true);
      }
    }
  }

  onArrowDown() {
    if (this.selected === null) {
      this.selected = 0;
    } else if (this.selected < this.results.length - 1) {
      this.selected++;
    }

    this.select();
  }

  onArrowUp() {
    this.selected--;

    if (this.selected < 0) {
      this.selected = null;
    }

    this.select();
  }

  onBlur(e) {
    if (this.$el.contains(e.target) === false) {
      document.documentElement.classList.remove("is-menu-search-open");
      this.remove();
    }
  }

  onEnter(e) {
    // If a result entry is currently selected,
    // navigate to result page
    if (this.selected !== null) {
      e.preventDefault();
      window.location = "/" + this.results[this.selected].value;
      return;
    }

    // otherwise submit form to search result page
    this.$el.submit();
  }

  onFocus() {
    // helper class used by the reference templates’ CSS
    document.documentElement.classList.add("is-menu-search-open");
    this.build();
  }

  async onInput() {
    const value = this.input.value.trim();

    if (value === this.q) {
      return;
    }

    this.q = value;
    this.results = [];

    if (value !== "" && value.length > 2) {
      this.results = await this.search(value);
    }

    this.build();
  }

  onKey(e) {
    if ((e.key && e.key === "Enter") || e.keyCode === 13) {
      this.onEnter(e);
    } else if (e.keyCode == "38") {
      this.onArrowUp();
    } else if (e.keyCode == "40") {
      this.onArrowDown();
    }
  }
}
