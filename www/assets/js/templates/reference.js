const reference = document.querySelector(".cheatsheet");

const buttons = () => {
  const buttons = document.querySelectorAll(".cheatsheet-panel-header button");
  buttons.forEach((button) => {
    button.addEventListener("click", () => {
      const show = button.getAttribute("data-show");
      reference.setAttribute("data-show", show);
    });
  });
};

const load = async (link) => {
  // start loading
  reference.classList.add("is-loading");

  const response = await fetch(link.href + "?plain=true");
  const html = await response.text();

  // Scroll locks need to be cleared before replacing parts of the page
  // using AJAX. Otherwise, the replaced content will become un-scrollable
  // in Mobile Safari (tested with iOS 12.2)
  // clearScrollLocks();

  document.querySelector(".cheatsheet-article").innerHTML = html;
  document
    .querySelector(".cheatsheet-entries a[aria-current]")
    .removeAttribute("aria-current");

  // change the currently active link
  link.setAttribute("aria-current", "page");

  // stop loading
  reference.classList.remove("is-loading");

  // stop showing the menu or overview
  reference.removeAttribute("data-show");

  // get the title
  const title = link.getAttribute("data-title");

  document.title = title + " | Kirby";

  // link header buttons
  buttons();

  // re-enable scroll locks
  //setScrollLocks();
};

window.addEventListener("popstate", (e) => {
  if (e.state && e.state.slug) {
    const link = document.querySelector("a[data-slug='" + e.state.slug + "']");

    if (link) {
      load(link);
    }
  }
});

document.querySelectorAll(".cheatsheet-entries a").forEach((link) => {
  link.addEventListener(
    "click",
    (e) => {
      e.preventDefault();
      load(link);

      // change the browser history
      history.pushState(
        {
          link: link.href,
          slug: link.getAttribute("data-slug"),
        },
        "",
        link.href
      );
    },
    true
  );
});

buttons();

const currentSections = document.querySelector(".cheatsheet-panel-scrollarea");
const currentSection = document.querySelector(
  ".cheatsheet-sections a[aria-current]"
);
const currentEntry = document.querySelector(
  ".cheatsheet-entries a[aria-current]"
);

function setScroll() {
  localStorage.setItem("getkirby$reference$scroll", currentSections.scrollTop);
}

function unsetScroll() {
  localStorage.removeItem("getkirby$reference$scroll");
}

if (currentSections) {
  const scroll = localStorage.getItem("getkirby$reference$scroll");

  if (scroll) {
    currentSections.scroll(0, scroll);
    unsetScroll();
  } else if (currentSection && currentSections.scrollIntoView) {
    const group = currentSection.parentNode.parentNode.parentNode;

    if (group.scrollIntoView) {
      const linkRect = currentSection.getBoundingClientRect();
      const sidebarRect = currentSections.getBoundingClientRect();
      group.scrollIntoView(linkRect.top < sidebarRect.top);
    }
  }

  // store current scroll position
  setScroll();

  // update scroll position dynamically
  currentSections.addEventListener("click", setScroll);
}

if (currentEntry && currentEntry.scrollIntoView) {
  currentEntry.scrollIntoView();
}
