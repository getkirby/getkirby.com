/* global Prism */
import throttle from "../utils/throttle";

// Auto-Update

const POSSIBLE_CODEBLOCKS = document.getElementsByTagName("code");

async function checkCodeBlocks() {
  for (let i = 0, l = POSSIBLE_CODEBLOCKS.length; i < l; i++) {
    // console.log(POSSIBLE_CODEBLOCKS[i]);
    const block = POSSIBLE_CODEBLOCKS[i];
    const parent = block.parentElement;

    if (parent.tagName !== "PRE") {
      // exclude all inline code (=not inside <pre> element)
      continue;
    }

    if (parent.className.match(/(^|\b)language-([^\b]|$)/)) {
      // skip if code element does not have a language defined
      // for highlighting. This is checked by searching the parent
      // node for a "language-*"-class, which gets added by
      // Prism after highlighting.
      continue;
    }

    Prism.highlightElement(block);
  }
}

function initAutoUpdate() {
  // The MutationObserver listend to all DOM changes and
  // triggers auto-update, if new code blocks have been added,
  // e.g. using AJAX/fetch().

  const throttledCheckCodeBlocks = throttle(checkCodeBlocks, 250);

  new MutationObserver(throttledCheckCodeBlocks).observe(
    document.documentElement, {
      childList: true,
      subtree: true,
      attributes: false,
      characterData: false
    }
  );

  throttledCheckCodeBlocks();
}

// Init

const initPrismLanguages = ([, ClipboardJS]) => {

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

  Prism.plugins.toolbar.registerButton("copy-to-clipboard", function(env) {

    var linkCopy = document.createElement("a");
    linkCopy.classList.add("link-reset");
    linkCopy.insertAdjacentHTML("beforeend", '<svg viewBox="0 0 16 16" width="16" height="16" class="icon"><path d="M10,4H2C1.4,4,1,4.4,1,5v10c0,0.6,0.4,1,1,1h8c0.6,0,1-0.4,1-1V5C11,4.4,10.6,4,10,4z"></path> <path data-color="color-2" d="M14,0H4v2h9v11h2V1C15,0.4,14.6,0,14,0z"></path></svg>');

    var linkText = document.createElement("span");
    linkText.textContent = "Copy";
    linkCopy.appendChild(linkText);

    function registerClipboard() {

      var clip = new ClipboardJS(linkCopy, {
        "text": function () {
          return env.code;
        }
      });

      clip.on("success", () => {
        linkText.textContent = "Copied!";
        resetText();
      });

      clip.on("error", () => {
        linkText.textContent = "Press Ctrl+C/⌘+C to copy";
        resetText();
      });
    }

    function resetText() {
      setTimeout(() => {
        linkText.textContent = "Copy";
      }, 5000);
    }

    registerClipboard();

    return linkCopy;

  });
}

export default () => {

  const codeBlocks = document.querySelectorAll('pre code[class^="language-"], pre code[class*=" language-"], pre.code > code');
  const languageClassPattern = /(?:^| )language(-[a-z])( |$)*/i;

  for (let code, i = 0, l = codeBlocks.length; i < l && (code = codeBlocks[i]); i++) {
    if (!languageClassPattern.test(code.className)) {
      code.classList.add("language-plaintext");
    }
  }

  Promise.all([
    import(
      /* webpackChunkName: "code" */
      /* webpackMode: "lazy" */
      "../vendor/prism"
    ),
    import(
      /* webpackChunkName: "code" */
      /* webpackMode: "lazy" */
      "clipboard"
    ),
  ]).then(initPrismLanguages)
    .then(initAutoUpdate);

};
