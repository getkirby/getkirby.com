export default class {

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
