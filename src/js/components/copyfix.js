/**
 * This script is intended to remove invisible characters
 * from from selected text, before copying it to the clipboard.
 * It was included with the ZERO-WIDTH SPACE and SOFT HYPHEN
 * characters in mind, that are used at some places in the
 * reference.
 */

// Removal function based on Hyphenator 5.2.0(devel)
// Copyright (C) 2015  Mathias Nater, Zürich (mathiasnater at gmail dot com)
// https://github.com/mnater/Hyphenator
//  Released under the MIT license
// http://mnater.github.io/Hyphenator/LICENSE.txt

const HYPHEN     = String.fromCharCode(173);
const URL_HYPHEN = String.fromCharCode(8203);

function removeHyphenationFromElement(el) {
  var h, u, i = 0, n;
  switch (HYPHEN) {
  case "|":
      h = "\\|";
      break;
  case "+":
      h = "\\+";
      break;
  case "*":
      h = "\\*";
      break;
  default:
      h = HYPHEN;
  }
  switch (URL_HYPHEN) {
  case "|":
      u = "\\|";
      break;
  case "+":
      u = "\\+";
      break;
  case "*":
      u = "\\*";
      break;
  default:
      u = URL_HYPHEN;
  }
  n = el.childNodes[i];
  while (n) {
      if (n.nodeType === 3) {
          n.data = n.data.replace(new RegExp(h, "g"), "");
          n.data = n.data.replace(new RegExp(u, "g"), "");
      } else if (n.nodeType === 1) {
          removeHyphenationFromElement(n);
      }
      i += 1;
      n = el.childNodes[i];
  }
}

// Based on: http://bavotasan.com/2010/add-a-copyright-notice-to-copied-text/
function fixBeforeCopy(e) {
  e.stopPropagation();

  var selection = window.getSelection(),
      range = selection.getRangeAt(0),
      dummy = document.createElement("div");

  dummy.style.cssText =
    "position: absolute;" +
    "left: -1000px;" +
    "width: 900px;" +
    "overflow: hidden;";

  document.body.appendChild(dummy);

  dummy.appendChild(range.cloneContents());

  removeHyphenationFromElement(dummy);
  selection.selectAllChildren(dummy);

  window.setTimeout(function () {
    dummy.parentNode.removeChild(dummy);
    selection.removeAllRanges(); // IE9 needs that
    selection.addRange(range);
  }, 0);
}

if ("getSelection" in window) {
  document.addEventListener("copy", fixBeforeCopy);
}
