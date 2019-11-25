/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/assets/";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 5);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./src/js/templates/home.js":
/***/ (function(module, exports, __webpack_require__) {

"use strict";
eval("\n\nvar _ready = __webpack_require__(\"./src/js/utils/ready.js\");\n\nvar _ready2 = _interopRequireDefault(_ready);\n\nvar _selector = __webpack_require__(\"./src/js/utils/selector.js\");\n\nfunction _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }\n\n(0, _ready2.default)(function () {\n\n  var galleryImage = (0, _selector.$)(\".home-panel-gallery .screenshot\");\n  var galleryLinks = (0, _selector.$$)(\".home-panel-gallery-links a\");\n\n  galleryLinks.forEach(function (galleryLink) {\n    galleryLink.addEventListener(\"click\", function (e) {\n      e.preventDefault();\n      (0, _selector.$)(\".home-panel-gallery-links a[aria-current]\").removeAttribute(\"aria-current\");\n\n      while (galleryImage.firstChild) {\n        galleryImage.removeChild(galleryImage.firstChild);\n      }\n\n      galleryImage.appendChild(this.querySelector(\".intrinsic\").cloneNode(true));\n\n      galleryLink.setAttribute(\"aria-current\", \"true\");\n    }, true);\n  });\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9zcmMvanMvdGVtcGxhdGVzL2hvbWUuanM/YTg2YSJdLCJuYW1lcyI6WyJnYWxsZXJ5SW1hZ2UiLCJnYWxsZXJ5TGlua3MiLCJmb3JFYWNoIiwiZ2FsbGVyeUxpbmsiLCJhZGRFdmVudExpc3RlbmVyIiwiZSIsInByZXZlbnREZWZhdWx0IiwicmVtb3ZlQXR0cmlidXRlIiwiZmlyc3RDaGlsZCIsInJlbW92ZUNoaWxkIiwiYXBwZW5kQ2hpbGQiLCJxdWVyeVNlbGVjdG9yIiwiY2xvbmVOb2RlIiwic2V0QXR0cmlidXRlIl0sIm1hcHBpbmdzIjoiOztBQUFBOzs7O0FBQ0E7Ozs7QUFFQSxxQkFBTSxZQUFNOztBQUVWLE1BQU1BLGVBQWUsaUJBQUUsaUNBQUYsQ0FBckI7QUFDQSxNQUFNQyxlQUFlLGtCQUFHLDZCQUFILENBQXJCOztBQUVBQSxlQUFhQyxPQUFiLENBQXFCLFVBQVVDLFdBQVYsRUFBdUI7QUFDMUNBLGdCQUFZQyxnQkFBWixDQUE2QixPQUE3QixFQUFzQyxVQUFVQyxDQUFWLEVBQWE7QUFDakRBLFFBQUVDLGNBQUY7QUFDQSx1QkFBRSwyQ0FBRixFQUErQ0MsZUFBL0MsQ0FBK0QsY0FBL0Q7O0FBRUEsYUFBT1AsYUFBYVEsVUFBcEIsRUFBZ0M7QUFDOUJSLHFCQUFhUyxXQUFiLENBQXlCVCxhQUFhUSxVQUF0QztBQUNEOztBQUVEUixtQkFBYVUsV0FBYixDQUF5QixLQUFLQyxhQUFMLENBQW1CLFlBQW5CLEVBQWlDQyxTQUFqQyxDQUEyQyxJQUEzQyxDQUF6Qjs7QUFFQVQsa0JBQVlVLFlBQVosQ0FBeUIsY0FBekIsRUFBeUMsTUFBekM7QUFDRCxLQVhELEVBV0csSUFYSDtBQVlELEdBYkQ7QUFlRCxDQXBCRCIsImZpbGUiOiIuL3NyYy9qcy90ZW1wbGF0ZXMvaG9tZS5qcy5qcyIsInNvdXJjZXNDb250ZW50IjpbImltcG9ydCByZWFkeSBmcm9tIFwiLi4vdXRpbHMvcmVhZHlcIjtcbmltcG9ydCB7ICQsICQkIH0gZnJvbSBcIi4uL3V0aWxzL3NlbGVjdG9yXCI7XG5cbnJlYWR5KCgpID0+IHtcblxuICBjb25zdCBnYWxsZXJ5SW1hZ2UgPSAkKFwiLmhvbWUtcGFuZWwtZ2FsbGVyeSAuc2NyZWVuc2hvdFwiKTtcbiAgY29uc3QgZ2FsbGVyeUxpbmtzID0gJCQoXCIuaG9tZS1wYW5lbC1nYWxsZXJ5LWxpbmtzIGFcIik7XG5cbiAgZ2FsbGVyeUxpbmtzLmZvckVhY2goZnVuY3Rpb24gKGdhbGxlcnlMaW5rKSB7XG4gICAgZ2FsbGVyeUxpbmsuYWRkRXZlbnRMaXN0ZW5lcihcImNsaWNrXCIsIGZ1bmN0aW9uIChlKSB7XG4gICAgICBlLnByZXZlbnREZWZhdWx0KCk7XG4gICAgICAkKFwiLmhvbWUtcGFuZWwtZ2FsbGVyeS1saW5rcyBhW2FyaWEtY3VycmVudF1cIikucmVtb3ZlQXR0cmlidXRlKFwiYXJpYS1jdXJyZW50XCIpO1xuXG4gICAgICB3aGlsZSAoZ2FsbGVyeUltYWdlLmZpcnN0Q2hpbGQpIHtcbiAgICAgICAgZ2FsbGVyeUltYWdlLnJlbW92ZUNoaWxkKGdhbGxlcnlJbWFnZS5maXJzdENoaWxkKTtcbiAgICAgIH1cblxuICAgICAgZ2FsbGVyeUltYWdlLmFwcGVuZENoaWxkKHRoaXMucXVlcnlTZWxlY3RvcihcIi5pbnRyaW5zaWNcIikuY2xvbmVOb2RlKHRydWUpKTtcblxuICAgICAgZ2FsbGVyeUxpbmsuc2V0QXR0cmlidXRlKFwiYXJpYS1jdXJyZW50XCIsIFwidHJ1ZVwiKTtcbiAgICB9LCB0cnVlKTtcbiAgfSk7XG5cbn0pO1xuXG5cblxuLy8gV0VCUEFDSyBGT09URVIgLy9cbi8vIC4vc3JjL2pzL3RlbXBsYXRlcy9ob21lLmpzIl0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./src/js/templates/home.js\n");

/***/ }),

/***/ "./src/js/utils/ready.js":
/***/ (function(module, exports, __webpack_require__) {

"use strict";
eval("\n\nObject.defineProperty(exports, \"__esModule\", {\n  value: true\n});\nexports.default = ready;\n/**\n * Executes an optional callback function and always returns a promise, which resolves\n * once the DOM is ready.\n *\n * @param {function} fn An optional callback function.\n * @return {Promice} A promise which resolves once the DOM is ready.\n */\nfunction ready() {\n  var fn = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : function () {};\n  /* eslint-disable-line no-empty-function */\n  return new Promise(function (resolve) {\n    if (document.readyState !== \"loading\") {\n      fn();\n      resolve();\n    } else {\n      document.addEventListener(\"DOMContentLoaded\", function () {\n        fn();\n        resolve();\n      });\n    }\n  });\n}//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9zcmMvanMvdXRpbHMvcmVhZHkuanM/YjA1NSJdLCJuYW1lcyI6WyJyZWFkeSIsImZuIiwiUHJvbWlzZSIsInJlc29sdmUiLCJkb2N1bWVudCIsInJlYWR5U3RhdGUiLCJhZGRFdmVudExpc3RlbmVyIl0sIm1hcHBpbmdzIjoiOzs7OztrQkFPd0JBLEs7QUFQeEI7Ozs7Ozs7QUFPZSxTQUFTQSxLQUFULEdBQW1DO0FBQUEsTUFBcEJDLEVBQW9CLHVFQUFmLFlBQVcsQ0FBRSxDQUFFO0FBQUU7QUFDbEQsU0FBTyxJQUFJQyxPQUFKLENBQVksVUFBQ0MsT0FBRCxFQUFhO0FBQzlCLFFBQUlDLFNBQVNDLFVBQVQsS0FBd0IsU0FBNUIsRUFBdUM7QUFDckNKO0FBQ0FFO0FBQ0QsS0FIRCxNQUdPO0FBQ0xDLGVBQVNFLGdCQUFULENBQTBCLGtCQUExQixFQUE4QyxZQUFNO0FBQ2xETDtBQUNBRTtBQUNELE9BSEQ7QUFJRDtBQUNGLEdBVk0sQ0FBUDtBQVlEIiwiZmlsZSI6Ii4vc3JjL2pzL3V0aWxzL3JlYWR5LmpzLmpzIiwic291cmNlc0NvbnRlbnQiOlsiLyoqXG4gKiBFeGVjdXRlcyBhbiBvcHRpb25hbCBjYWxsYmFjayBmdW5jdGlvbiBhbmQgYWx3YXlzIHJldHVybnMgYSBwcm9taXNlLCB3aGljaCByZXNvbHZlc1xuICogb25jZSB0aGUgRE9NIGlzIHJlYWR5LlxuICpcbiAqIEBwYXJhbSB7ZnVuY3Rpb259IGZuIEFuIG9wdGlvbmFsIGNhbGxiYWNrIGZ1bmN0aW9uLlxuICogQHJldHVybiB7UHJvbWljZX0gQSBwcm9taXNlIHdoaWNoIHJlc29sdmVzIG9uY2UgdGhlIERPTSBpcyByZWFkeS5cbiAqL1xuZXhwb3J0IGRlZmF1bHQgZnVuY3Rpb24gcmVhZHkoZm4gPSBmdW5jdGlvbigpIHt9KSB7IC8qIGVzbGludC1kaXNhYmxlLWxpbmUgbm8tZW1wdHktZnVuY3Rpb24gKi9cbiAgcmV0dXJuIG5ldyBQcm9taXNlKChyZXNvbHZlKSA9PiB7XG4gICAgaWYgKGRvY3VtZW50LnJlYWR5U3RhdGUgIT09IFwibG9hZGluZ1wiKSB7XG4gICAgICBmbigpO1xuICAgICAgcmVzb2x2ZSgpO1xuICAgIH0gZWxzZSB7XG4gICAgICBkb2N1bWVudC5hZGRFdmVudExpc3RlbmVyKFwiRE9NQ29udGVudExvYWRlZFwiLCAoKSA9PiB7XG4gICAgICAgIGZuKCk7XG4gICAgICAgIHJlc29sdmUoKTtcbiAgICAgIH0pO1xuICAgIH1cbiAgfSk7XG5cbn1cblxuXG5cbi8vIFdFQlBBQ0sgRk9PVEVSIC8vXG4vLyAuL3NyYy9qcy91dGlscy9yZWFkeS5qcyJdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./src/js/utils/ready.js\n");

/***/ }),

/***/ "./src/js/utils/selector.js":
/***/ (function(module, exports, __webpack_require__) {

"use strict";
eval("\n\nObject.defineProperty(exports, \"__esModule\", {\n  value: true\n});\nvar $ = function $(selector) {\n  return document.querySelector(selector);\n};\n\nvar $$ = function $$(selector) {\n  return [].slice.call(document.querySelectorAll(selector));\n};\n\nexports.$ = $;\nexports.$$ = $$;//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9zcmMvanMvdXRpbHMvc2VsZWN0b3IuanM/N2ZhZiJdLCJuYW1lcyI6WyIkIiwic2VsZWN0b3IiLCJkb2N1bWVudCIsInF1ZXJ5U2VsZWN0b3IiLCIkJCIsInNsaWNlIiwiY2FsbCIsInF1ZXJ5U2VsZWN0b3JBbGwiXSwibWFwcGluZ3MiOiI7Ozs7O0FBQUEsSUFBTUEsSUFBSSxTQUFKQSxDQUFJLENBQUNDLFFBQUQsRUFBYztBQUN0QixTQUFPQyxTQUFTQyxhQUFULENBQXVCRixRQUF2QixDQUFQO0FBQ0QsQ0FGRDs7QUFJQSxJQUFNRyxLQUFLLFNBQUxBLEVBQUssQ0FBQ0gsUUFBRCxFQUFjO0FBQ3ZCLFNBQU8sR0FBR0ksS0FBSCxDQUFTQyxJQUFULENBQWNKLFNBQVNLLGdCQUFULENBQTBCTixRQUExQixDQUFkLENBQVA7QUFDRCxDQUZEOztRQUlTRCxDLEdBQUFBLEM7UUFBR0ksRSxHQUFBQSxFIiwiZmlsZSI6Ii4vc3JjL2pzL3V0aWxzL3NlbGVjdG9yLmpzLmpzIiwic291cmNlc0NvbnRlbnQiOlsiY29uc3QgJCA9IChzZWxlY3RvcikgPT4ge1xuICByZXR1cm4gZG9jdW1lbnQucXVlcnlTZWxlY3RvcihzZWxlY3Rvcik7XG59O1xuXG5jb25zdCAkJCA9IChzZWxlY3RvcikgPT4ge1xuICByZXR1cm4gW10uc2xpY2UuY2FsbChkb2N1bWVudC5xdWVyeVNlbGVjdG9yQWxsKHNlbGVjdG9yKSk7XG59O1xuXG5leHBvcnQgeyAkLCAkJCB9O1xuXG5cblxuLy8gV0VCUEFDSyBGT09URVIgLy9cbi8vIC4vc3JjL2pzL3V0aWxzL3NlbGVjdG9yLmpzIl0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./src/js/utils/selector.js\n");

/***/ }),

/***/ 5:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__("./src/js/templates/home.js");


/***/ })

/******/ });