export default class {

  constructor() {
    this.init();
  }

  async init() {
    await import("../libraries/prism.js");

    this.initPrism();
    this.initClipboard();

    // The MutationObserver listend to all DOM changes and
    // triggers auto-update, if new code blocks have been added,
    // e.g. using AJAX/fetch().
    new MutationObserver(this.highlight).observe(
      document.documentElement, {
        childList: true,
        subtree: true,
        attributes: false,
        characterData: false
      }
    );

    this.highlight();
  }

  initPrism() {
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

    Prism.plugins.customClass.prefix("code-");
  }

  initClipboard() {
    Prism.plugins.toolbar.registerButton("copy-to-clipboard", function(env) {

      var linkCopy = document.createElement("a");
      linkCopy.classList.add("link-reset");
      linkCopy.insertAdjacentHTML("beforeend", '<svg viewBox="0 0 16 16" width="16" height="16" class="icon"><path d="M10,4H2C1.4,4,1,4.4,1,5v10c0,0.6,0.4,1,1,1h8c0.6,0,1-0.4,1-1V5C11,4.4,10.6,4,10,4z"></path> <path data-color="color-2" d="M14,0H4v2h9v11h2V1C15,0.4,14.6,0,14,0z"></path></svg>');

      var linkText = document.createElement("span");
      linkText.textContent = "Copy";
      linkCopy.appendChild(linkText);

      linkCopy.addEventListener("click", async function (e) {
        const { default: clipboard } = await import("../libraries/clipboard.js");
        try {
          await clipboard(env.code);
          linkText.textContent = "Copied!";
        } catch (error) {
          linkText.textContent = "Press Ctrl+C/⌘+C to copy";
        } finally{
          setTimeout(() => {
            linkText.textContent = "Copy";
          }, 5000);
        }
      });

      return linkCopy;

    });
  }

  highlight() {
    // switch all blocks to plaintext if no language class present
    const elements = document.querySelectorAll('pre code[class^="language-"], pre code[class*=" language-"], pre.code > code');
    const languages = /(?:^| )language(-[a-z])( |$)*/i;

    for (let code, i = 0, l = elements.length; i < l && (code = elements[i]); i++) {
      if (!languages.test(code.className)) {
        code.classList.add("language-plaintext");
      }
    }

    // highlight all code blocks
    const blocks = document.getElementsByTagName("code");

    for (let i = 0, l = blocks.length; i < l; i++) {
      const block  = blocks[i];
      const parent = block.parentElement;

      // exclude all inline code (=not inside <pre> element)
      if (parent.tagName !== "PRE") {
        continue;
      }

      // skip if code element does not have a language defined
      // for highlighting. This is checked by searching the parent
      // node for a "language-*"-class, which gets added by
      // Prism after highlighting.
      if (parent.className.match(/(^|\b)language-([^\b]|$)/)) {
        continue;
      }

      Prism.highlightElement(block);
    }
  }
}
