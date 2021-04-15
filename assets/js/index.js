// ENV

const ALGOLIA_APP = "S7OGBIAJTV";
const ALGOLIA_KEY = "d161a2f4cd2d69247c529a3371ad3050";
const ALGOLIA_INDEX = "getkirby-3";
const PADDLE_VENDOR_ID = 1129;
const PADDLE_SCRIPT_URL = "https://cdn.paddle.com/paddle/paddle.js";


/** Helpers */

window.debounce = (callback, delay) => {
  let timeout;
  return () => {
      clearTimeout(timeout);
      timeout = setTimeout(callback, delay);
  }
}


/** AFFILIATES */
class Affiliates {

  constructor() {
    this.init();
  }

  async init() {
    // don’t do anything further, if the current page already contains
    // the Paddle.js script.
    if (
      "Paddle" in window ||
      document.querySelector(`script[src="${PADDLE_SCRIPT_URL}"]`) !== null
    ) {
      return;
    }

    const p = new URLSearchParams(window.location.search);

    // load paddle.js and set vendor id, if coming from an affiliate
    // link, so the script can store affiliate tracking information
    // in a cookie.
    if (
      p.has("status") &&
      p.has("expires") &&
      p.has("seller") &&
      p.has("affiliate") &&
      p.has("link") &&
      p.has("p_tok")
    ) {
      this.load();
    }
  }

  load() {
    // create script tag for external paddle.js
    const script = document.createElement("script");
    script.src = PADDLE_SCRIPT_URL;

    // set callback for when script is loaded
    script.onload = () => {
      Paddle.Setup({ vendor: PADDLE_VENDOR_ID });
    };

    // insert in DOM
    const at = document.getElementsByTagName("script")[0];
    at.parentNode.insertBefore(script, at);
  }
}


/** CODE */
class Code {

  constructor() {
    this.init();
  }

  async init() {
    await import("./libraries/prism.js");
    this.setClass();
    this.setLanguages();
    this.setToolbar();
    Prism.highlightAll();
  }

  setClass() {
    Prism.plugins.customClass.prefix("code-");
  }

  setLanguages() {
    Prism.languages.kirbytext = Prism.languages.extend("markdown", {});

    Prism.languages.insertBefore("kirbytext", "prolog", {
      "kirbytag": {
        pattern: /\([a-z0-9_-]+:.*?\)/i,
        inside: {
          "kirbytag-bracket": /^\(|\)$/,
          "kirbytag-name": {
            pattern: /^[a-z0-9_-]+:/i,
          },
          "kirbytag-attr": {
            pattern: /([^:]\s+)[a-z0-9_-]+:/i,
            lookbehind: true,
          },
        }
      },
    });

    Prism.languages.kirbycontent = {
      "delimiter": /\n----\s*\n*/,
      "property": {
        pattern: /(^\n*|\n----\s*\n*)[a-zA-Z0-9_\-\u0020]+:/,
        lookbehind: true,
      }
    };
  }

  setToolbar() {
    Prism.plugins.toolbar.registerButton('select-code', (env) => {
      const button = document.createElement('button');
      button.insertAdjacentHTML("beforeend", '<svg viewBox="0 0 16 16" width="12" height="12" class="icon"><path d="M10,4H2C1.4,4,1,4.4,1,5v10c0,0.6,0.4,1,1,1h8c0.6,0,1-0.4,1-1V5C11,4.4,10.6,4,10,4z"></path> <path data-color="color-2" d="M14,0H4v2h9v11h2V1C15,0.4,14.6,0,14,0z"></path></svg>');

      const text = document.createElement("span");
      text.textContent = "Copy";
      button.appendChild(text);

      button.addEventListener("click", async () => {
        const { default: clipboard } = await import("./libraries/clipboard.js");
        try {
          await clipboard(env.code);
          text.textContent = "Copied!";
        } catch (error) {
          text.textContent = "Press Ctrl+C/⌘+C to copy";
        } finally {
          setTimeout(() => { text.textContent = "Copy" }, 5000);
        }
      });

      return button;
    });
  }
}


/** LIGHTBOX */
class Lightbox {

  constructor() {
    this.$thumbs = document.querySelectorAll("[data-lightbox]");
    this.$group  = [];
    this.$dialog = null;
    this.current = null;

    [...this.$thumbs].forEach(thumb => {
      thumb.addEventListener('touchmove', {});
      thumb.addEventListener("click", e => {
        e.preventDefault();
        this.open(thumb);
      });
    });
  }

  create() {
    this.$dialog = document.createElement("dialog");
    this.$dialog.classList.add("lightbox");
    this.$dialog.classList.add("overlay");

    // Polyfill for all browsers that don't support <dialog> yet
    // (see `/assets/js/polyfills/dialog.js`)
    polyfillDialog(this.$dialog);

    // Navigation buttons
    const prev = document.createElement("button");
    prev.innerHTML = "&larr;"
    prev.addEventListener("click", (e) => {
      e.stopPropagation();
      this.prev();
    });
    this.$dialog.appendChild(prev);

    const next = document.createElement("button");
    next.innerHTML = "&rarr;"
    next.addEventListener("click", (e) => {
      e.stopPropagation();
      this.next();
    });
    this.$dialog.appendChild(next);

    // Content wrapper
    const content = document.createElement("div");
    this.$dialog.appendChild(content);

    document.body.appendChild(this.$dialog);

    // Close dialog when clicking on backdrop
    this.$dialog.addEventListener("click", (e) => {
      const content = this.$dialog.lastElementChild.firstElementChild;
      if (content.contains(e.target) === false) {
        this.close();
      }
    });

    document.addEventListener("keyup", (e) => {
      if (this.current !== null) {
        // Close dialog when hitting ESC
        if (e.key === "Escape") {
          return this.close();
        }

        // Keyboard navigation
        if (e.key === "ArrowRight") {
           return this.next();
        }

        if (e.key === "ArrowLeft") {
          return this.prev();
        }
      }
    })
  }

  open(element) {
    if (this.$dialog === null) {
      this.create();
    }

    this.current = element;

    const group = this.current.dataset.lightbox;

    if (group) {
      this.$group = [...this.$thumbs].filter(thumb => thumb.dataset.lightbox === group);
    } else {
      this.$group = [];
    }

    if (this.hasPrev() === true) {
      this.$dialog.dataset.hasPrev = group;
    } else {
      delete this.$dialog.dataset.hasPrev;
    }

    if (this.hasNext() === true) {
      this.$dialog.dataset.hasNext = group;
    } else {
      delete this.$dialog.dataset.hasNext;
    }

    // Add image to the dialog
    this.$dialog.lastElementChild.innerHTML = `<img loading="lazy" src="${element.href}" srcset="${element.href} 2x">`;

    // Open dialog and lock body scroll
    this.$dialog.show();
    document.documentElement.style.overflow = "hidden";

    // Slightly delay adding data-visible to trigger CSS transition
    setTimeout(() => {
      this.$dialog.dataset.visible = true;
    }, 50);
  }

  close() {
    this.current = null;

    // Remove data-visible
    delete this.$dialog.dataset.visible;

    // Delay closing dialog until fade-out transition has finished
    setTimeout(() => {
      this.$dialog.close();
      document.documentElement.style.overflow = null;
    }, 400);
  }

  currentIndex() {
    return this.$group.findIndex(x => x === this.current);
  }

  hasPrev() {
    return this.currentIndex() > 0;
  }

  hasNext() {
    return this.currentIndex() < (this.$group.length - 1);
  }

  prev() {
    if (this.hasPrev() === true) {
      this.open(this.$group[this.currentIndex() - 1]);
    }
  }

  next() {
    if (this.hasNext() === true) {
      this.open(this.$group[this.currentIndex() + 1]);
    }
  }
}


/** MENU */
class Menu {

  constructor() {
    this.$el = document.querySelector(".menu-toggle")

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


/** SEARCH */
class Search {

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
    // `/` if no focus
    // `Alt + /` always
    // `Cmd + k` or `Ctrl + k` always
    document.addEventListener("keydown", (e) => {
      const withSlash = e.key === "/" || e.code === "Slash";
      const withMeta  = e.ctrlKey === true || e.metaKey === true;

      if (
        (e.target === document.body && withSlash) ||
        (e.altKey === true && withSlash) ||
        (withMeta && e.key === "k")
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
      label.innerText = this.results[i].title;
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
      clearTimeout(this.fetchingTimeout);

      this.fetchingTimeout = setTimeout(function () {
       this.$form.setAttribute("data-fetching", true);
      }, 100);

      this.results = await this.fetch(this.q);
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


/** SETUP */
new Affiliates();
new Code();
new Lightbox();
new Menu();
new Search();


/** DIALOG POLYFILL */
window.polyfillDialog = (dialog) => {
  if (typeof HTMLDialogElement !== "function") {
    dialog.show  = () => dialog.setAttribute("open", "");
    dialog.close = () => dialog.removeAttribute("open");
  }
};

const dialogs = document.querySelectorAll("dialog");
[...dialogs].forEach(dialog => polyfillDialog(dialog));
