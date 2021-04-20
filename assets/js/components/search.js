const ALGOLIA_APP = "S7OGBIAJTV";
const ALGOLIA_KEY = "d161a2f4cd2d69247c529a3371ad3050";
const ALGOLIA_INDEX = "getkirby-3";

export default class {

  constructor() {
    this.$btn     = document.querySelectorAll(".search-button");
    this.$dialog  = document.querySelector(".search-dialog");

    if (!this.$dialog) {
      return;
    }

    this.$form    = this.$dialog.querySelector("form");
    this.$area    = new AreaSelector(this);
    this.$input   = this.$form.querySelector("input[name=q]");
    this.$results = this.$form.querySelector(".search-results ul");
    this.$result  = this.$form.querySelector(".search-results template");
    this.$more    = this.$form.querySelector(".search-more a");

    this.q = "";
    this.fetchingTimeout = null;
    this.results = [];
    this.total = 0;

    // Register event for all search buttons
    [...this.$btn].forEach(btn => {
      btn.addEventListener("click", () => this.open(btn));
    });

    this.$dialog.addEventListener("click", this.onBlur.bind(this));
    this.$input.addEventListener("input", debounce(this.onInput.bind(this), 100));
    this.$dialog.addEventListener("keydown", this.onKey.bind(this));

    // Keyboard shortcut:
    document.addEventListener("keydown", (e) => {
      if (
        // `/` if no focus
        (e.target === document.body && e.key === "/") ||
        // `Alt + /` always
        (e.altKey === true && e.key === "/") ||
        // `Cmd + k` or `Ctrl + k` always
        ((e.ctrlKey === true || e.metaKey === true) && e.key === "k")
      ) {
        this.open(this.$btn[0])
        e.preventDefault();
      }
    });
  }

  open(btn) {
    this.$dialog.show();
    document.documentElement.style.overflow = "hidden";
    this.$area.select(btn.dataset.area);
    this.$input.focus();
  }

  close(e) {
    this.$dialog.close();
    document.documentElement.style.overflow = null;
    this.$input.value = ""
    this.q = "";
    this.results = [];
    this.total = 0;
    this.$area.value = "all";
    this.$area.update();
    this.render();
  }

  async fetch(q) {

    const params = {
      query: q,
      hitsPerPage: 5
    };

    if (this.$area.value !== "all") {
      params.filters = "area:" + this.$area.value;
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
    const { hits, nbHits } = await response.json();

    // Show View all item if there are any hits and
    // there are more hits than those displayed in the popup.
    this.total = nbHits;

    return hits;
  }

  render() {
    // Clear results list in dialog
    this.$results.innerHTML = null;

    // Build a list entry for each result from HTML template
    // and append to results list
    for (let i = 0; i < this.results.length; i++) {
      const result = this.$result.content.cloneNode(true);
      const link = result.querySelector("a");
      link.href = "/" + this.results[i].objectID;

      const label = result.querySelector(".search-title");
      label.innerHTML = this.results[i].title;
      const info = result.querySelector(".search-link");
      info.innerText = this.results[i].objectID;

      if (this.results[i].area) {
        const area = result.querySelector(".search-area");
        area.dataset.area = this.results[i].area;
        area.innerText = this.results[i].area[0].toUpperCase() + this.results[i].area.slice(1);
      }

      this.$results.appendChild(result);
    }

    // Show/hide "View all" button
    if (this.total > 5) {
      this.$more.href = `/search?q=${this.q}&area=${this.$area.value}`;
      const count = this.$more.querySelector(".search-more-count");
      count.innerText = this.total;
      this.$more.classList.remove("hidden");
    } else {
      this.$more.classList.add("hidden");
    }
  }

  async search() {
    this.q = this.$input.value.trim();
    this.results = [];
    this.total = 0;

    if (this.q.length > 2) {
      this.fetchingTimeout = setTimeout(() => {
       this.$form.setAttribute("data-fetching", true);
      }, 100);

      this.results = await this.fetch(this.q);
      clearTimeout(this.fetchingTimeout);
      this.$form.removeAttribute("data-fetching");
    }

    this.render();
    this.$input.focus();
  }

  onBlur(e) {
    if (this.$area.$el.contains(e.target) === false) {
      this.$area.close();
    }
    if (this.$form.contains(e.target) === false) {
      this.close();
    }
  }

  onInput() {
    // If input value is same as previous search
    // don't do anything
    if (this.$input.value.trim() === this.q) {
      return;
    }

    this.search();
  }

  onKey(e) {
    if (e.key === "Escape") {
      this.onEscape();
    } else if (e.key === "ArrowDown") {
      this.onArrowDown(e);
    } else if (e.key === "ArrowUp") {
      this.onArrowUp(e);
    }
  }

  onEscape() {
    // If input is empty, close dialog.
    // Otherwise first clear input.
    if (this.q === "") {
      this.close();
    } else {
      this.$input.value = "";
      this.$input.dispatchEvent(new Event('input'));
    }
  }

  onArrowDown(e) {
    e.preventDefault();
    const current = document.activeElement;

    if (current === this.$input) {
      this.$results.firstElementChild.firstElementChild.focus();
    } else if (current.parentNode.nextElementSibling) {
      current.parentNode.nextElementSibling.firstElementChild.focus();
    } else {
      this.$more.focus();
    }
  }
  onArrowUp(e) {
    e.preventDefault();
    const current = document.activeElement;

    if (current === this.$results.firstElementChild.firstElementChild) {
      this.$input.focus();
    } else if (current === this.$more) {
      this.$results.lastElementChild.firstElementChild.focus();
    } else if (current.parentNode.previousElementSibling) {
      current.parentNode.previousElementSibling.firstElementChild.focus();
    }
  }
}


/** AREA SELECTOR */
class AreaSelector {

  constructor(parent) {
    this.$parent = parent;
    this.$el = parent.$form.querySelector(".search-input > nav");
    this.$btn = parent.$form.querySelector(".search-input > nav > button");
    this.$label =  this.$btn.querySelector("[data-area]");
    this.$dropdown = this.$el.querySelector("ul");
    this.$options = this.$dropdown.querySelectorAll("[data-area]");
    this.$input = this.$el.querySelector("input[name=area]");

    this.value = this.$input.value;

    this.$btn.addEventListener("click", this.toggle.bind(this));

    [...this.$options].forEach(option => {
      option.addEventListener("click", (e) => this.select(e.target.dataset.area));
    });
  }

  close() {
    this.$dropdown.classList.add("hidden");
  }

  toggle() {
    this.$dropdown.classList.toggle("hidden");
  }

  select(area) {
    this.value = area;
    this.$input.value = area;
    this.update();
    this.close();
    this.$parent.search();
  }

  update() {
    this.$label.dataset.area = this.value;
    this.$label.innerText = [...this.$options].filter(option => option.dataset.area === this.value)[0].innerText;
  }

}
