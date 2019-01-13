import { $, $$ } from "../utils/selector.js";
import highlight from "../components/code.js";

const cheatsheet = $(".cheatsheet");

const buttons = () => {

  $$('.cheatsheet-panel-header button').forEach((button) => {

    button.addEventListener("click", (e) => {
      const show = button.getAttribute("data-show");
      cheatsheet.setAttribute("data-show", show);
    });

  });

};

const load = (link) => {

  // start loading
  cheatsheet.classList.add("is-loading");

  fetch(link.href + "?plain=true")
    .then((response) => {
      return response.text();
    })
    .then((html) => {
      $(".cheatsheet-article").innerHTML = html;
      $(".cheatsheet-entries a[aria-current]").removeAttribute("aria-current");

      // change the currently active link
      link.setAttribute("aria-current", "page");

      // stop loading
      cheatsheet.classList.remove("is-loading");

      // stop showing the menu or overview
      cheatsheet.removeAttribute("data-show");

      // get the title
      const title = link.getAttribute("data-title");

      document.title = title + " | Kirby";

      // highlight all code blocks
      Prism.highlightAll();

      // link header buttons
      buttons();

    });

};

window.addEventListener("popstate", (e) => {
  if (e.state && e.state.slug) {
    const link = $("a[data-slug='" + e.state.slug + "']");

    if (link) {
      load(link);
    }
  }
});

$$('.cheatsheet-entries a').forEach((link) => {

  link.addEventListener("click", (e) => {
    e.preventDefault();
    load(link);

    // change the browser history
    history.pushState({
      link: link.href,
      slug: link.getAttribute("data-slug")
    }, "", link.href);

  }, true);

});

buttons();

const currentSection = $('.cheatsheet-sections a[aria-current]');
const currentEntry   = $('.cheatsheet-entries a[aria-current]');

if (currentSection && currentSection.scrollIntoView) {
  currentSection.scrollIntoView();
}

if (currentEntry && currentEntry.scrollIntoView) {
  currentEntry.scrollIntoView();
}
