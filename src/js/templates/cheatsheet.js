/* global Prism */
import { $, $$ } from "../utils/selector.js";
import throttle from "../utils/throttle";
import "../components/code.js";
import { /* enableBodyScroll,*/ disableBodyScroll, clearAllBodyScrollLocks } from "body-scroll-lock";

const cheatsheet = $(".cheatsheet");

const buttons = () => {
  $$(".cheatsheet-panel-header button").forEach((button) => {
    button.addEventListener("click", () => {
      const show = button.getAttribute("data-show");
      cheatsheet.setAttribute("data-show", show);
    });
  });
};

const load = (link) => {
  // start loading
  cheatsheet.classList.add("is-loading");

  fetch(link.href + "?plain=true").
    then((response) => {
      return response.text();
    }).
    then((html) => {
      // Scroll locks need to be cleared before replacing parts of the page
      // using AJAX. Otherwise, the replaced content will become un-scrollable
      // in Mobile Safari (tested with iOS 12.2)
      clearScrollLocks();

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

      // link header buttons
      buttons();

      // re-enable scroll locks
      setScrollLocks();
    });

};

function setScrollLocks() {
  // Disable page scrolling, except for the designated scrolling areas. This
  // also ensures, that iOS does not accidently scroll the whole viewport
  // and hides parts of the page.
  disableBodyScroll($(".cheatsheet-main-scrollarea"));
  disableBodyScroll($(".cheatsheet-sections .cheatsheet-panel-scrollarea"));

  const entriesScrollarea = $(".cheatsheet-entries-scrollarea");

  if (entriesScrollarea !== null) {
    disableBodyScroll(entriesScrollarea);
  }
}

function clearScrollLocks() {
  clearAllBodyScrollLocks();
}


window.addEventListener("popstate", (e) => {
  if (e.state && e.state.slug) {
    const link = $("a[data-slug='" + e.state.slug + "']");

    if (link) {
      load(link);
    }
  }
});

$$(".cheatsheet-entries a").forEach((link) => {

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

const currentSections = $(".cheatsheet-panel-scrollarea");
const currentSection  = $(".cheatsheet-sections a[aria-current]");
const currentEntry    = $(".cheatsheet-entries a[aria-current]");

function setScroll() {
  localStorage.setItem('getkirby$reference$scroll', currentSections.scrollTop);
}

if (currentSections && currentSections.scrollIntoView) {
  const scroll = localStorage.getItem('getkirby$reference$scroll');

  if (scroll) {
    currentSections.scroll(0, scroll);
  }

  if (currentSection) {
    const linkRect    = currentSection.getBoundingClientRect();
    const sidebarRect = currentSections.getBoundingClientRect();
    if (linkRect.top < sidebarRect.top) {
      currentSection.parentNode.parentNode.parentNode.scrollIntoView(true);
    } else if (linkRect.bottom > sidebarRect.bottom) {
      currentSection.parentNode.parentNode.parentNode.scrollIntoView(false);
    }
  }

  // store current scroll position
  setScroll();

  // update scroll position dynamically
  currentSections.addEventListener('scroll', throttle(setScroll, 100));
}

if (currentEntry && currentEntry.scrollIntoView) {
  currentEntry.scrollIntoView();
}

// Fix for Mobil Safari on iOS/iPad (tested with v10.3), because its
// scrolls the whole body when using scrollIntoView on a nested scrolling
// container.
document.body.scrollTo(0, 0);

setScrollLocks();
