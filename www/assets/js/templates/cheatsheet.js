/******/ (function(modules) { // webpackBootstrap
/******/ 	// install a JSONP callback for chunk loading
/******/ 	var parentJsonpFunction = window["webpackJsonp"];
/******/ 	window["webpackJsonp"] = function webpackJsonpCallback(chunkIds, moreModules, executeModules) {
/******/ 		// add "moreModules" to the modules object,
/******/ 		// then flag all "chunkIds" as loaded and fire callback
/******/ 		var moduleId, chunkId, i = 0, resolves = [], result;
/******/ 		for(;i < chunkIds.length; i++) {
/******/ 			chunkId = chunkIds[i];
/******/ 			if(installedChunks[chunkId]) {
/******/ 				resolves.push(installedChunks[chunkId][0]);
/******/ 			}
/******/ 			installedChunks[chunkId] = 0;
/******/ 		}
/******/ 		for(moduleId in moreModules) {
/******/ 			if(Object.prototype.hasOwnProperty.call(moreModules, moduleId)) {
/******/ 				modules[moduleId] = moreModules[moduleId];
/******/ 			}
/******/ 		}
/******/ 		if(parentJsonpFunction) parentJsonpFunction(chunkIds, moreModules, executeModules);
/******/ 		while(resolves.length) {
/******/ 			resolves.shift()();
/******/ 		}
/******/
/******/ 	};
/******/
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// objects to store loaded and loading chunks
/******/ 	var installedChunks = {
/******/ 		7: 0
/******/ 	};
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
/******/ 	// This file contains only the entry chunk.
/******/ 	// The chunk loading function for additional chunks
/******/ 	__webpack_require__.e = function requireEnsure(chunkId) {
/******/ 		var installedChunkData = installedChunks[chunkId];
/******/ 		if(installedChunkData === 0) {
/******/ 			return new Promise(function(resolve) { resolve(); });
/******/ 		}
/******/
/******/ 		// a Promise means "currently loading".
/******/ 		if(installedChunkData) {
/******/ 			return installedChunkData[2];
/******/ 		}
/******/
/******/ 		// setup Promise in chunk cache
/******/ 		var promise = new Promise(function(resolve, reject) {
/******/ 			installedChunkData = installedChunks[chunkId] = [resolve, reject];
/******/ 		});
/******/ 		installedChunkData[2] = promise;
/******/
/******/ 		// start chunk loading
/******/ 		var head = document.getElementsByTagName('head')[0];
/******/ 		var script = document.createElement('script');
/******/ 		script.type = "text/javascript";
/******/ 		script.charset = 'utf-8';
/******/ 		script.async = true;
/******/ 		script.timeout = 120000;
/******/
/******/ 		if (__webpack_require__.nc) {
/******/ 			script.setAttribute("nonce", __webpack_require__.nc);
/******/ 		}
/******/ 		script.src = __webpack_require__.p + "js/bundle-" + ({"0":"code"}[chunkId]||chunkId) + ".js?id=" + {"0":"0d7ff91d3acd8f62013a"}[chunkId] + "";
/******/ 		var timeout = setTimeout(onScriptComplete, 120000);
/******/ 		script.onerror = script.onload = onScriptComplete;
/******/ 		function onScriptComplete() {
/******/ 			// avoid mem leaks in IE.
/******/ 			script.onerror = script.onload = null;
/******/ 			clearTimeout(timeout);
/******/ 			var chunk = installedChunks[chunkId];
/******/ 			if(chunk !== 0) {
/******/ 				if(chunk) {
/******/ 					chunk[1](new Error('Loading chunk ' + chunkId + ' failed.'));
/******/ 				}
/******/ 				installedChunks[chunkId] = undefined;
/******/ 			}
/******/ 		};
/******/ 		head.appendChild(script);
/******/
/******/ 		return promise;
/******/ 	};
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
/******/ 	// on error function for async loading
/******/ 	__webpack_require__.oe = function(err) { console.error(err); throw err; };
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 3);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./src/js/components/code.js":
/***/ (function(module, exports, __webpack_require__) {

"use strict";
eval("\n\nObject.defineProperty(exports, \"__esModule\", {\n  value: true\n});\n\nvar _slicedToArray = function () { function sliceIterator(arr, i) { var _arr = []; var _n = true; var _d = false; var _e = undefined; try { for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i[\"return\"]) _i[\"return\"](); } finally { if (_d) throw _e; } } return _arr; } return function (arr, i) { if (Array.isArray(arr)) { return arr; } else if (Symbol.iterator in Object(arr)) { return sliceIterator(arr, i); } else { throw new TypeError(\"Invalid attempt to destructure non-iterable instance\"); } }; }();\n\n/* global Prism */\n\nvar initPrismLanguages = function initPrismLanguages(_ref) {\n  var _ref2 = _slicedToArray(_ref, 2),\n      ClipboardJS = _ref2[1];\n\n  Prism.languages.kirbytext = Prism.languages.extend(\"markdown\", {});\n\n  Prism.languages.insertBefore(\"kirbytext\", \"prolog\", {\n    \"kirbytag\": {\n      pattern: /\\([a-z0-9_-]+:.*?\\)/i,\n      inside: {\n        \"kirbytag-bracket\": /^\\(|\\)$/,\n\n        \"kirbytag-name\": {\n          pattern: /^[a-z0-9_-]+:/i\n        },\n\n        \"kirbytag-attr\": {\n          pattern: /([^:]\\s+)[a-z0-9_-]+:/i,\n          lookbehind: true\n        }\n      }\n    }\n  });\n\n  Prism.languages.kirbycontent = {\n    \"delimiter\": /\\n----\\s*\\n*/,\n    \"property\": {\n      pattern: /(^\\n*|\\n----\\s*\\n*)[a-zA-Z0-9_\\-\\u0020]+:/,\n      lookbehind: true\n    }\n  };\n\n  Prism.plugins.customClass.prefix(\"code-\");\n\n  Prism.plugins.toolbar.registerButton(\"copy-to-clipboard\", function (env) {\n\n    var linkCopy = document.createElement(\"a\");\n    linkCopy.classList.add(\"link-reset\");\n    linkCopy.insertAdjacentHTML(\"beforeend\", '<svg viewBox=\"0 0 16 16\" width=\"16\" height=\"16\" class=\"icon\"><path d=\"M10,4H2C1.4,4,1,4.4,1,5v10c0,0.6,0.4,1,1,1h8c0.6,0,1-0.4,1-1V5C11,4.4,10.6,4,10,4z\"></path> <path data-color=\"color-2\" d=\"M14,0H4v2h9v11h2V1C15,0.4,14.6,0,14,0z\"></path></svg>');\n\n    var linkText = document.createElement(\"span\");\n    linkText.textContent = \"Copy\";\n    linkCopy.appendChild(linkText);\n\n    function registerClipboard() {\n\n      var clip = new ClipboardJS(linkCopy, {\n        \"text\": function text() {\n          return env.code;\n        }\n      });\n\n      clip.on(\"success\", function () {\n        linkText.textContent = \"Copied!\";\n        resetText();\n      });\n\n      clip.on(\"error\", function () {\n        linkText.textContent = \"Press Ctrl+C/⌘+C to copy\";\n        resetText();\n      });\n    }\n\n    function resetText() {\n      setTimeout(function () {\n        linkText.textContent = \"Copy\";\n      }, 5000);\n    }\n\n    registerClipboard();\n\n    return linkCopy;\n  });\n};\n\nexports.default = function () {\n\n  var codeBlocks = document.querySelectorAll('pre code[class^=\"language-\"], pre code[class*=\" language-\"], pre.code > code');\n  var languageClassPattern = /(?:^| )language(-[a-z])( |$)*/i;\n\n  if (codeBlocks.length > 0) {\n\n    for (var code, i = 0, l = codeBlocks.length; i < l && (code = codeBlocks[i]); i++) {\n      if (!languageClassPattern.test(code.className)) {\n        code.classList.add(\"language-plaintext\");\n      }\n    }\n\n    Promise.all([__webpack_require__.e/* import() */(0).then(__webpack_require__.bind(null, \"./src/js/vendor/prism.js\")), __webpack_require__.e/* import() */(0).then(__webpack_require__.bind(null, \"./node_modules/clipboard/dist/clipboard.js\"))]).then(initPrismLanguages);\n  }\n};//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9zcmMvanMvY29tcG9uZW50cy9jb2RlLmpzP2NiY2IiXSwibmFtZXMiOlsiaW5pdFByaXNtTGFuZ3VhZ2VzIiwiQ2xpcGJvYXJkSlMiLCJQcmlzbSIsImxhbmd1YWdlcyIsImtpcmJ5dGV4dCIsImV4dGVuZCIsImluc2VydEJlZm9yZSIsInBhdHRlcm4iLCJpbnNpZGUiLCJsb29rYmVoaW5kIiwia2lyYnljb250ZW50IiwicGx1Z2lucyIsImN1c3RvbUNsYXNzIiwicHJlZml4IiwidG9vbGJhciIsInJlZ2lzdGVyQnV0dG9uIiwiZW52IiwibGlua0NvcHkiLCJkb2N1bWVudCIsImNyZWF0ZUVsZW1lbnQiLCJjbGFzc0xpc3QiLCJhZGQiLCJpbnNlcnRBZGphY2VudEhUTUwiLCJsaW5rVGV4dCIsInRleHRDb250ZW50IiwiYXBwZW5kQ2hpbGQiLCJyZWdpc3RlckNsaXBib2FyZCIsImNsaXAiLCJjb2RlIiwib24iLCJyZXNldFRleHQiLCJzZXRUaW1lb3V0IiwiY29kZUJsb2NrcyIsInF1ZXJ5U2VsZWN0b3JBbGwiLCJsYW5ndWFnZUNsYXNzUGF0dGVybiIsImxlbmd0aCIsImkiLCJsIiwidGVzdCIsImNsYXNzTmFtZSIsIlByb21pc2UiLCJhbGwiLCJ0aGVuIl0sIm1hcHBpbmdzIjoiOzs7Ozs7OztBQUFBOztBQUVBLElBQU1BLHFCQUFxQixTQUFyQkEsa0JBQXFCLE9BQXFCO0FBQUE7QUFBQSxNQUFqQkMsV0FBaUI7O0FBRTlDQyxRQUFNQyxTQUFOLENBQWdCQyxTQUFoQixHQUE0QkYsTUFBTUMsU0FBTixDQUFnQkUsTUFBaEIsQ0FBdUIsVUFBdkIsRUFBbUMsRUFBbkMsQ0FBNUI7O0FBRUFILFFBQU1DLFNBQU4sQ0FBZ0JHLFlBQWhCLENBQTZCLFdBQTdCLEVBQTBDLFFBQTFDLEVBQW9EO0FBQ2xELGdCQUFZO0FBQ1ZDLGVBQVMsc0JBREM7QUFFVkMsY0FBUTtBQUNOLDRCQUFvQixTQURkOztBQUdOLHlCQUFpQjtBQUNmRCxtQkFBUztBQURNLFNBSFg7O0FBT04seUJBQWlCO0FBQ2ZBLG1CQUFTLHdCQURNO0FBRWZFLHNCQUFZO0FBRkc7QUFQWDtBQUZFO0FBRHNDLEdBQXBEOztBQWtCQVAsUUFBTUMsU0FBTixDQUFnQk8sWUFBaEIsR0FBK0I7QUFDN0IsaUJBQWEsY0FEZ0I7QUFFN0IsZ0JBQVk7QUFDVkgsZUFBUywyQ0FEQztBQUVWRSxrQkFBWTtBQUZGO0FBRmlCLEdBQS9COztBQVFBUCxRQUFNUyxPQUFOLENBQWNDLFdBQWQsQ0FBMEJDLE1BQTFCLENBQWlDLE9BQWpDOztBQUVBWCxRQUFNUyxPQUFOLENBQWNHLE9BQWQsQ0FBc0JDLGNBQXRCLENBQXFDLG1CQUFyQyxFQUEwRCxVQUFTQyxHQUFULEVBQWM7O0FBRXRFLFFBQUlDLFdBQVdDLFNBQVNDLGFBQVQsQ0FBdUIsR0FBdkIsQ0FBZjtBQUNBRixhQUFTRyxTQUFULENBQW1CQyxHQUFuQixDQUF1QixZQUF2QjtBQUNBSixhQUFTSyxrQkFBVCxDQUE0QixXQUE1QixFQUF5Qyx1UEFBekM7O0FBRUEsUUFBSUMsV0FBV0wsU0FBU0MsYUFBVCxDQUF1QixNQUF2QixDQUFmO0FBQ0FJLGFBQVNDLFdBQVQsR0FBdUIsTUFBdkI7QUFDQVAsYUFBU1EsV0FBVCxDQUFxQkYsUUFBckI7O0FBRUEsYUFBU0csaUJBQVQsR0FBNkI7O0FBRTNCLFVBQUlDLE9BQU8sSUFBSTFCLFdBQUosQ0FBZ0JnQixRQUFoQixFQUEwQjtBQUNuQyxnQkFBUSxnQkFBWTtBQUNsQixpQkFBT0QsSUFBSVksSUFBWDtBQUNEO0FBSGtDLE9BQTFCLENBQVg7O0FBTUFELFdBQUtFLEVBQUwsQ0FBUSxTQUFSLEVBQW1CLFlBQU07QUFDdkJOLGlCQUFTQyxXQUFULEdBQXVCLFNBQXZCO0FBQ0FNO0FBQ0QsT0FIRDs7QUFLQUgsV0FBS0UsRUFBTCxDQUFRLE9BQVIsRUFBaUIsWUFBTTtBQUNyQk4saUJBQVNDLFdBQVQsR0FBdUIsMEJBQXZCO0FBQ0FNO0FBQ0QsT0FIRDtBQUlEOztBQUVELGFBQVNBLFNBQVQsR0FBcUI7QUFDbkJDLGlCQUFXLFlBQU07QUFDZlIsaUJBQVNDLFdBQVQsR0FBdUIsTUFBdkI7QUFDRCxPQUZELEVBRUcsSUFGSDtBQUdEOztBQUVERTs7QUFFQSxXQUFPVCxRQUFQO0FBRUQsR0F2Q0Q7QUF5Q0QsQ0F6RUQ7O2tCQTJFZSxZQUFNOztBQUVuQixNQUFNZSxhQUFhZCxTQUFTZSxnQkFBVCxDQUEwQiw4RUFBMUIsQ0FBbkI7QUFDQSxNQUFNQyx1QkFBdUIsZ0NBQTdCOztBQUVBLE1BQUlGLFdBQVdHLE1BQVgsR0FBb0IsQ0FBeEIsRUFBMkI7O0FBRXpCLFNBQUssSUFBSVAsSUFBSixFQUFVUSxJQUFJLENBQWQsRUFBaUJDLElBQUlMLFdBQVdHLE1BQXJDLEVBQTZDQyxJQUFJQyxDQUFKLEtBQVVULE9BQU9JLFdBQVdJLENBQVgsQ0FBakIsQ0FBN0MsRUFBOEVBLEdBQTlFLEVBQW1GO0FBQ2pGLFVBQUksQ0FBQ0YscUJBQXFCSSxJQUFyQixDQUEwQlYsS0FBS1csU0FBL0IsQ0FBTCxFQUFnRDtBQUM5Q1gsYUFBS1IsU0FBTCxDQUFlQyxHQUFmLENBQW1CLG9CQUFuQjtBQUNEO0FBQ0Y7O0FBRURtQixZQUFRQyxHQUFSLENBQVksQ0FDUix1R0FEUSxFQU1SLHlIQU5RLENBQVosRUFXS0MsSUFYTCxDQVdVMUMsa0JBWFY7QUFZRDtBQUVGLEMiLCJmaWxlIjoiLi9zcmMvanMvY29tcG9uZW50cy9jb2RlLmpzLmpzIiwic291cmNlc0NvbnRlbnQiOlsiLyogZ2xvYmFsIFByaXNtICovXG5cbmNvbnN0IGluaXRQcmlzbUxhbmd1YWdlcyA9IChbLCBDbGlwYm9hcmRKU10pID0+IHtcblxuICBQcmlzbS5sYW5ndWFnZXMua2lyYnl0ZXh0ID0gUHJpc20ubGFuZ3VhZ2VzLmV4dGVuZChcIm1hcmtkb3duXCIsIHt9KTtcblxuICBQcmlzbS5sYW5ndWFnZXMuaW5zZXJ0QmVmb3JlKFwia2lyYnl0ZXh0XCIsIFwicHJvbG9nXCIsIHtcbiAgICBcImtpcmJ5dGFnXCI6IHtcbiAgICAgIHBhdHRlcm46IC9cXChbYS16MC05Xy1dKzouKj9cXCkvaSxcbiAgICAgIGluc2lkZToge1xuICAgICAgICBcImtpcmJ5dGFnLWJyYWNrZXRcIjogL15cXCh8XFwpJC8sXG5cbiAgICAgICAgXCJraXJieXRhZy1uYW1lXCI6IHtcbiAgICAgICAgICBwYXR0ZXJuOiAvXlthLXowLTlfLV0rOi9pLFxuICAgICAgICB9LFxuXG4gICAgICAgIFwia2lyYnl0YWctYXR0clwiOiB7XG4gICAgICAgICAgcGF0dGVybjogLyhbXjpdXFxzKylbYS16MC05Xy1dKzovaSxcbiAgICAgICAgICBsb29rYmVoaW5kOiB0cnVlLFxuICAgICAgICB9LFxuICAgICAgfVxuICAgIH0sXG4gIH0pO1xuXG4gIFByaXNtLmxhbmd1YWdlcy5raXJieWNvbnRlbnQgPSB7XG4gICAgXCJkZWxpbWl0ZXJcIjogL1xcbi0tLS1cXHMqXFxuKi8sXG4gICAgXCJwcm9wZXJ0eVwiOiB7XG4gICAgICBwYXR0ZXJuOiAvKF5cXG4qfFxcbi0tLS1cXHMqXFxuKilbYS16QS1aMC05X1xcLVxcdTAwMjBdKzovLFxuICAgICAgbG9va2JlaGluZDogdHJ1ZSxcbiAgICB9XG4gIH07XG5cbiAgUHJpc20ucGx1Z2lucy5jdXN0b21DbGFzcy5wcmVmaXgoXCJjb2RlLVwiKTtcblxuICBQcmlzbS5wbHVnaW5zLnRvb2xiYXIucmVnaXN0ZXJCdXR0b24oXCJjb3B5LXRvLWNsaXBib2FyZFwiLCBmdW5jdGlvbihlbnYpIHtcblxuICAgIHZhciBsaW5rQ29weSA9IGRvY3VtZW50LmNyZWF0ZUVsZW1lbnQoXCJhXCIpO1xuICAgIGxpbmtDb3B5LmNsYXNzTGlzdC5hZGQoXCJsaW5rLXJlc2V0XCIpO1xuICAgIGxpbmtDb3B5Lmluc2VydEFkamFjZW50SFRNTChcImJlZm9yZWVuZFwiLCAnPHN2ZyB2aWV3Qm94PVwiMCAwIDE2IDE2XCIgd2lkdGg9XCIxNlwiIGhlaWdodD1cIjE2XCIgY2xhc3M9XCJpY29uXCI+PHBhdGggZD1cIk0xMCw0SDJDMS40LDQsMSw0LjQsMSw1djEwYzAsMC42LDAuNCwxLDEsMWg4YzAuNiwwLDEtMC40LDEtMVY1QzExLDQuNCwxMC42LDQsMTAsNHpcIj48L3BhdGg+IDxwYXRoIGRhdGEtY29sb3I9XCJjb2xvci0yXCIgZD1cIk0xNCwwSDR2Mmg5djExaDJWMUMxNSwwLjQsMTQuNiwwLDE0LDB6XCI+PC9wYXRoPjwvc3ZnPicpO1xuXG4gICAgdmFyIGxpbmtUZXh0ID0gZG9jdW1lbnQuY3JlYXRlRWxlbWVudChcInNwYW5cIik7XG4gICAgbGlua1RleHQudGV4dENvbnRlbnQgPSBcIkNvcHlcIjtcbiAgICBsaW5rQ29weS5hcHBlbmRDaGlsZChsaW5rVGV4dCk7XG5cbiAgICBmdW5jdGlvbiByZWdpc3RlckNsaXBib2FyZCgpIHtcblxuICAgICAgdmFyIGNsaXAgPSBuZXcgQ2xpcGJvYXJkSlMobGlua0NvcHksIHtcbiAgICAgICAgXCJ0ZXh0XCI6IGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICByZXR1cm4gZW52LmNvZGU7XG4gICAgICAgIH1cbiAgICAgIH0pO1xuXG4gICAgICBjbGlwLm9uKFwic3VjY2Vzc1wiLCAoKSA9PiB7XG4gICAgICAgIGxpbmtUZXh0LnRleHRDb250ZW50ID0gXCJDb3BpZWQhXCI7XG4gICAgICAgIHJlc2V0VGV4dCgpO1xuICAgICAgfSk7XG5cbiAgICAgIGNsaXAub24oXCJlcnJvclwiLCAoKSA9PiB7XG4gICAgICAgIGxpbmtUZXh0LnRleHRDb250ZW50ID0gXCJQcmVzcyBDdHJsK0Mv4oyYK0MgdG8gY29weVwiO1xuICAgICAgICByZXNldFRleHQoKTtcbiAgICAgIH0pO1xuICAgIH1cblxuICAgIGZ1bmN0aW9uIHJlc2V0VGV4dCgpIHtcbiAgICAgIHNldFRpbWVvdXQoKCkgPT4ge1xuICAgICAgICBsaW5rVGV4dC50ZXh0Q29udGVudCA9IFwiQ29weVwiO1xuICAgICAgfSwgNTAwMCk7XG4gICAgfVxuXG4gICAgcmVnaXN0ZXJDbGlwYm9hcmQoKTtcblxuICAgIHJldHVybiBsaW5rQ29weTtcblxuICB9KTtcblxufVxuXG5leHBvcnQgZGVmYXVsdCAoKSA9PiB7XG5cbiAgY29uc3QgY29kZUJsb2NrcyA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoJ3ByZSBjb2RlW2NsYXNzXj1cImxhbmd1YWdlLVwiXSwgcHJlIGNvZGVbY2xhc3MqPVwiIGxhbmd1YWdlLVwiXSwgcHJlLmNvZGUgPiBjb2RlJyk7XG4gIGNvbnN0IGxhbmd1YWdlQ2xhc3NQYXR0ZXJuID0gLyg/Ol58IClsYW5ndWFnZSgtW2Etel0pKCB8JCkqL2k7XG5cbiAgaWYgKGNvZGVCbG9ja3MubGVuZ3RoID4gMCkge1xuXG4gICAgZm9yIChsZXQgY29kZSwgaSA9IDAsIGwgPSBjb2RlQmxvY2tzLmxlbmd0aDsgaSA8IGwgJiYgKGNvZGUgPSBjb2RlQmxvY2tzW2ldKTsgaSsrKSB7XG4gICAgICBpZiAoIWxhbmd1YWdlQ2xhc3NQYXR0ZXJuLnRlc3QoY29kZS5jbGFzc05hbWUpKSB7XG4gICAgICAgIGNvZGUuY2xhc3NMaXN0LmFkZChcImxhbmd1YWdlLXBsYWludGV4dFwiKTtcbiAgICAgIH1cbiAgICB9XG5cbiAgICBQcm9taXNlLmFsbChbXG4gICAgICAgIGltcG9ydChcbiAgICAgICAgICAvKiB3ZWJwYWNrQ2h1bmtOYW1lOiBcImNvZGVcIiAqL1xuICAgICAgICAgIC8qIHdlYnBhY2tNb2RlOiBcImxhenlcIiAqL1xuICAgICAgICAgIFwiLi4vdmVuZG9yL3ByaXNtXCJcbiAgICAgICAgKSxcbiAgICAgICAgaW1wb3J0KFxuICAgICAgICAgIC8qIHdlYnBhY2tDaHVua05hbWU6IFwiY29kZVwiICovXG4gICAgICAgICAgLyogd2VicGFja01vZGU6IFwibGF6eVwiICovXG4gICAgICAgICAgXCJjbGlwYm9hcmRcIlxuICAgICAgICApLFxuICAgICAgXSkudGhlbihpbml0UHJpc21MYW5ndWFnZXMpO1xuICB9XG5cbn07XG5cblxuXG4vLyBXRUJQQUNLIEZPT1RFUiAvL1xuLy8gLi9zcmMvanMvY29tcG9uZW50cy9jb2RlLmpzIl0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./src/js/components/code.js\n");

/***/ }),

/***/ "./src/js/templates/cheatsheet.js":
/***/ (function(module, exports, __webpack_require__) {

"use strict";
eval("\n\nvar _selector = __webpack_require__(\"./src/js/utils/selector.js\");\n\n__webpack_require__(\"./src/js/components/code.js\");\n\n/* global Prism */\nvar cheatsheet = (0, _selector.$)(\".cheatsheet\");\n\nvar buttons = function buttons() {\n\n  (0, _selector.$$)(\".cheatsheet-panel-header button\").forEach(function (button) {\n\n    button.addEventListener(\"click\", function () {\n      var show = button.getAttribute(\"data-show\");\n      cheatsheet.setAttribute(\"data-show\", show);\n    });\n  });\n};\n\nvar load = function load(link) {\n\n  // start loading\n  cheatsheet.classList.add(\"is-loading\");\n\n  fetch(link.href + \"?plain=true\").then(function (response) {\n    return response.text();\n  }).then(function (html) {\n    (0, _selector.$)(\".cheatsheet-article\").innerHTML = html;\n    (0, _selector.$)(\".cheatsheet-entries a[aria-current]\").removeAttribute(\"aria-current\");\n\n    // change the currently active link\n    link.setAttribute(\"aria-current\", \"page\");\n\n    // stop loading\n    cheatsheet.classList.remove(\"is-loading\");\n\n    // stop showing the menu or overview\n    cheatsheet.removeAttribute(\"data-show\");\n\n    // get the title\n    var title = link.getAttribute(\"data-title\");\n\n    document.title = title + \" | Kirby\";\n\n    // highlight all code blocks\n    Prism.highlightAll();\n\n    // link header buttons\n    buttons();\n  });\n};\n\nwindow.addEventListener(\"popstate\", function (e) {\n  if (e.state && e.state.slug) {\n    var link = (0, _selector.$)(\"a[data-slug='\" + e.state.slug + \"']\");\n\n    if (link) {\n      load(link);\n    }\n  }\n});\n\n(0, _selector.$$)(\".cheatsheet-entries a\").forEach(function (link) {\n\n  link.addEventListener(\"click\", function (e) {\n    e.preventDefault();\n    load(link);\n\n    // change the browser history\n    history.pushState({\n      link: link.href,\n      slug: link.getAttribute(\"data-slug\")\n    }, \"\", link.href);\n  }, true);\n});\n\nbuttons();\n\nvar currentSection = (0, _selector.$)(\".cheatsheet-sections a[aria-current]\");\nvar currentEntry = (0, _selector.$)(\".cheatsheet-entries a[aria-current]\");\n\nif (currentSection && currentSection.scrollIntoView) {\n  currentSection.scrollIntoView();\n}\n\nif (currentEntry && currentEntry.scrollIntoView) {\n  currentEntry.scrollIntoView();\n}//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9zcmMvanMvdGVtcGxhdGVzL2NoZWF0c2hlZXQuanM/ZTRmYiJdLCJuYW1lcyI6WyJjaGVhdHNoZWV0IiwiYnV0dG9ucyIsImZvckVhY2giLCJidXR0b24iLCJhZGRFdmVudExpc3RlbmVyIiwic2hvdyIsImdldEF0dHJpYnV0ZSIsInNldEF0dHJpYnV0ZSIsImxvYWQiLCJsaW5rIiwiY2xhc3NMaXN0IiwiYWRkIiwiZmV0Y2giLCJocmVmIiwidGhlbiIsInJlc3BvbnNlIiwidGV4dCIsImh0bWwiLCJpbm5lckhUTUwiLCJyZW1vdmVBdHRyaWJ1dGUiLCJyZW1vdmUiLCJ0aXRsZSIsImRvY3VtZW50IiwiUHJpc20iLCJoaWdobGlnaHRBbGwiLCJ3aW5kb3ciLCJlIiwic3RhdGUiLCJzbHVnIiwicHJldmVudERlZmF1bHQiLCJoaXN0b3J5IiwicHVzaFN0YXRlIiwiY3VycmVudFNlY3Rpb24iLCJjdXJyZW50RW50cnkiLCJzY3JvbGxJbnRvVmlldyJdLCJtYXBwaW5ncyI6Ijs7QUFDQTs7QUFDQTs7QUFGQTtBQUlBLElBQU1BLGFBQWEsaUJBQUUsYUFBRixDQUFuQjs7QUFFQSxJQUFNQyxVQUFVLFNBQVZBLE9BQVUsR0FBTTs7QUFFcEIsb0JBQUcsaUNBQUgsRUFBc0NDLE9BQXRDLENBQThDLFVBQUNDLE1BQUQsRUFBWTs7QUFFeERBLFdBQU9DLGdCQUFQLENBQXdCLE9BQXhCLEVBQWlDLFlBQU07QUFDckMsVUFBTUMsT0FBT0YsT0FBT0csWUFBUCxDQUFvQixXQUFwQixDQUFiO0FBQ0FOLGlCQUFXTyxZQUFYLENBQXdCLFdBQXhCLEVBQXFDRixJQUFyQztBQUNELEtBSEQ7QUFLRCxHQVBEO0FBU0QsQ0FYRDs7QUFhQSxJQUFNRyxPQUFPLFNBQVBBLElBQU8sQ0FBQ0MsSUFBRCxFQUFVOztBQUVyQjtBQUNBVCxhQUFXVSxTQUFYLENBQXFCQyxHQUFyQixDQUF5QixZQUF6Qjs7QUFFQUMsUUFBTUgsS0FBS0ksSUFBTCxHQUFZLGFBQWxCLEVBQ0VDLElBREYsQ0FDTyxVQUFDQyxRQUFELEVBQWM7QUFDakIsV0FBT0EsU0FBU0MsSUFBVCxFQUFQO0FBQ0QsR0FISCxFQUlFRixJQUpGLENBSU8sVUFBQ0csSUFBRCxFQUFVO0FBQ2IscUJBQUUscUJBQUYsRUFBeUJDLFNBQXpCLEdBQXFDRCxJQUFyQztBQUNBLHFCQUFFLHFDQUFGLEVBQXlDRSxlQUF6QyxDQUF5RCxjQUF6RDs7QUFFQTtBQUNBVixTQUFLRixZQUFMLENBQWtCLGNBQWxCLEVBQWtDLE1BQWxDOztBQUVBO0FBQ0FQLGVBQVdVLFNBQVgsQ0FBcUJVLE1BQXJCLENBQTRCLFlBQTVCOztBQUVBO0FBQ0FwQixlQUFXbUIsZUFBWCxDQUEyQixXQUEzQjs7QUFFQTtBQUNBLFFBQU1FLFFBQVFaLEtBQUtILFlBQUwsQ0FBa0IsWUFBbEIsQ0FBZDs7QUFFQWdCLGFBQVNELEtBQVQsR0FBaUJBLFFBQVEsVUFBekI7O0FBRUE7QUFDQUUsVUFBTUMsWUFBTjs7QUFFQTtBQUNBdkI7QUFFRCxHQTVCSDtBQThCRCxDQW5DRDs7QUFxQ0F3QixPQUFPckIsZ0JBQVAsQ0FBd0IsVUFBeEIsRUFBb0MsVUFBQ3NCLENBQUQsRUFBTztBQUN6QyxNQUFJQSxFQUFFQyxLQUFGLElBQVdELEVBQUVDLEtBQUYsQ0FBUUMsSUFBdkIsRUFBNkI7QUFDM0IsUUFBTW5CLE9BQU8saUJBQUUsa0JBQWtCaUIsRUFBRUMsS0FBRixDQUFRQyxJQUExQixHQUFpQyxJQUFuQyxDQUFiOztBQUVBLFFBQUluQixJQUFKLEVBQVU7QUFDUkQsV0FBS0MsSUFBTDtBQUNEO0FBQ0Y7QUFDRixDQVJEOztBQVVBLGtCQUFHLHVCQUFILEVBQTRCUCxPQUE1QixDQUFvQyxVQUFDTyxJQUFELEVBQVU7O0FBRTVDQSxPQUFLTCxnQkFBTCxDQUFzQixPQUF0QixFQUErQixVQUFDc0IsQ0FBRCxFQUFPO0FBQ3BDQSxNQUFFRyxjQUFGO0FBQ0FyQixTQUFLQyxJQUFMOztBQUVBO0FBQ0FxQixZQUFRQyxTQUFSLENBQWtCO0FBQ2hCdEIsWUFBTUEsS0FBS0ksSUFESztBQUVoQmUsWUFBTW5CLEtBQUtILFlBQUwsQ0FBa0IsV0FBbEI7QUFGVSxLQUFsQixFQUdHLEVBSEgsRUFHT0csS0FBS0ksSUFIWjtBQUtELEdBVkQsRUFVRyxJQVZIO0FBWUQsQ0FkRDs7QUFnQkFaOztBQUVBLElBQU0rQixpQkFBaUIsaUJBQUUsc0NBQUYsQ0FBdkI7QUFDQSxJQUFNQyxlQUFpQixpQkFBRSxxQ0FBRixDQUF2Qjs7QUFFQSxJQUFJRCxrQkFBa0JBLGVBQWVFLGNBQXJDLEVBQXFEO0FBQ25ERixpQkFBZUUsY0FBZjtBQUNEOztBQUVELElBQUlELGdCQUFnQkEsYUFBYUMsY0FBakMsRUFBaUQ7QUFDL0NELGVBQWFDLGNBQWI7QUFDRCIsImZpbGUiOiIuL3NyYy9qcy90ZW1wbGF0ZXMvY2hlYXRzaGVldC5qcy5qcyIsInNvdXJjZXNDb250ZW50IjpbIi8qIGdsb2JhbCBQcmlzbSAqL1xuaW1wb3J0IHsgJCwgJCQgfSBmcm9tIFwiLi4vdXRpbHMvc2VsZWN0b3IuanNcIjtcbmltcG9ydCBcIi4uL2NvbXBvbmVudHMvY29kZS5qc1wiO1xuXG5jb25zdCBjaGVhdHNoZWV0ID0gJChcIi5jaGVhdHNoZWV0XCIpO1xuXG5jb25zdCBidXR0b25zID0gKCkgPT4ge1xuXG4gICQkKFwiLmNoZWF0c2hlZXQtcGFuZWwtaGVhZGVyIGJ1dHRvblwiKS5mb3JFYWNoKChidXR0b24pID0+IHtcblxuICAgIGJ1dHRvbi5hZGRFdmVudExpc3RlbmVyKFwiY2xpY2tcIiwgKCkgPT4ge1xuICAgICAgY29uc3Qgc2hvdyA9IGJ1dHRvbi5nZXRBdHRyaWJ1dGUoXCJkYXRhLXNob3dcIik7XG4gICAgICBjaGVhdHNoZWV0LnNldEF0dHJpYnV0ZShcImRhdGEtc2hvd1wiLCBzaG93KTtcbiAgICB9KTtcblxuICB9KTtcblxufTtcblxuY29uc3QgbG9hZCA9IChsaW5rKSA9PiB7XG5cbiAgLy8gc3RhcnQgbG9hZGluZ1xuICBjaGVhdHNoZWV0LmNsYXNzTGlzdC5hZGQoXCJpcy1sb2FkaW5nXCIpO1xuXG4gIGZldGNoKGxpbmsuaHJlZiArIFwiP3BsYWluPXRydWVcIikuXG4gICAgdGhlbigocmVzcG9uc2UpID0+IHtcbiAgICAgIHJldHVybiByZXNwb25zZS50ZXh0KCk7XG4gICAgfSkuXG4gICAgdGhlbigoaHRtbCkgPT4ge1xuICAgICAgJChcIi5jaGVhdHNoZWV0LWFydGljbGVcIikuaW5uZXJIVE1MID0gaHRtbDtcbiAgICAgICQoXCIuY2hlYXRzaGVldC1lbnRyaWVzIGFbYXJpYS1jdXJyZW50XVwiKS5yZW1vdmVBdHRyaWJ1dGUoXCJhcmlhLWN1cnJlbnRcIik7XG5cbiAgICAgIC8vIGNoYW5nZSB0aGUgY3VycmVudGx5IGFjdGl2ZSBsaW5rXG4gICAgICBsaW5rLnNldEF0dHJpYnV0ZShcImFyaWEtY3VycmVudFwiLCBcInBhZ2VcIik7XG5cbiAgICAgIC8vIHN0b3AgbG9hZGluZ1xuICAgICAgY2hlYXRzaGVldC5jbGFzc0xpc3QucmVtb3ZlKFwiaXMtbG9hZGluZ1wiKTtcblxuICAgICAgLy8gc3RvcCBzaG93aW5nIHRoZSBtZW51IG9yIG92ZXJ2aWV3XG4gICAgICBjaGVhdHNoZWV0LnJlbW92ZUF0dHJpYnV0ZShcImRhdGEtc2hvd1wiKTtcblxuICAgICAgLy8gZ2V0IHRoZSB0aXRsZVxuICAgICAgY29uc3QgdGl0bGUgPSBsaW5rLmdldEF0dHJpYnV0ZShcImRhdGEtdGl0bGVcIik7XG5cbiAgICAgIGRvY3VtZW50LnRpdGxlID0gdGl0bGUgKyBcIiB8IEtpcmJ5XCI7XG5cbiAgICAgIC8vIGhpZ2hsaWdodCBhbGwgY29kZSBibG9ja3NcbiAgICAgIFByaXNtLmhpZ2hsaWdodEFsbCgpO1xuXG4gICAgICAvLyBsaW5rIGhlYWRlciBidXR0b25zXG4gICAgICBidXR0b25zKCk7XG5cbiAgICB9KTtcblxufTtcblxud2luZG93LmFkZEV2ZW50TGlzdGVuZXIoXCJwb3BzdGF0ZVwiLCAoZSkgPT4ge1xuICBpZiAoZS5zdGF0ZSAmJiBlLnN0YXRlLnNsdWcpIHtcbiAgICBjb25zdCBsaW5rID0gJChcImFbZGF0YS1zbHVnPSdcIiArIGUuc3RhdGUuc2x1ZyArIFwiJ11cIik7XG5cbiAgICBpZiAobGluaykge1xuICAgICAgbG9hZChsaW5rKTtcbiAgICB9XG4gIH1cbn0pO1xuXG4kJChcIi5jaGVhdHNoZWV0LWVudHJpZXMgYVwiKS5mb3JFYWNoKChsaW5rKSA9PiB7XG5cbiAgbGluay5hZGRFdmVudExpc3RlbmVyKFwiY2xpY2tcIiwgKGUpID0+IHtcbiAgICBlLnByZXZlbnREZWZhdWx0KCk7XG4gICAgbG9hZChsaW5rKTtcblxuICAgIC8vIGNoYW5nZSB0aGUgYnJvd3NlciBoaXN0b3J5XG4gICAgaGlzdG9yeS5wdXNoU3RhdGUoe1xuICAgICAgbGluazogbGluay5ocmVmLFxuICAgICAgc2x1ZzogbGluay5nZXRBdHRyaWJ1dGUoXCJkYXRhLXNsdWdcIilcbiAgICB9LCBcIlwiLCBsaW5rLmhyZWYpO1xuXG4gIH0sIHRydWUpO1xuXG59KTtcblxuYnV0dG9ucygpO1xuXG5jb25zdCBjdXJyZW50U2VjdGlvbiA9ICQoXCIuY2hlYXRzaGVldC1zZWN0aW9ucyBhW2FyaWEtY3VycmVudF1cIik7XG5jb25zdCBjdXJyZW50RW50cnkgICA9ICQoXCIuY2hlYXRzaGVldC1lbnRyaWVzIGFbYXJpYS1jdXJyZW50XVwiKTtcblxuaWYgKGN1cnJlbnRTZWN0aW9uICYmIGN1cnJlbnRTZWN0aW9uLnNjcm9sbEludG9WaWV3KSB7XG4gIGN1cnJlbnRTZWN0aW9uLnNjcm9sbEludG9WaWV3KCk7XG59XG5cbmlmIChjdXJyZW50RW50cnkgJiYgY3VycmVudEVudHJ5LnNjcm9sbEludG9WaWV3KSB7XG4gIGN1cnJlbnRFbnRyeS5zY3JvbGxJbnRvVmlldygpO1xufVxuXG5cblxuLy8gV0VCUEFDSyBGT09URVIgLy9cbi8vIC4vc3JjL2pzL3RlbXBsYXRlcy9jaGVhdHNoZWV0LmpzIl0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./src/js/templates/cheatsheet.js\n");

/***/ }),

/***/ "./src/js/utils/selector.js":
/***/ (function(module, exports, __webpack_require__) {

"use strict";
eval("\n\nObject.defineProperty(exports, \"__esModule\", {\n  value: true\n});\nvar $ = function $(selector) {\n  return document.querySelector(selector);\n};\n\nvar $$ = function $$(selector) {\n  return [].slice.call(document.querySelectorAll(selector));\n};\n\nexports.$ = $;\nexports.$$ = $$;//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9zcmMvanMvdXRpbHMvc2VsZWN0b3IuanM/N2ZhZiJdLCJuYW1lcyI6WyIkIiwic2VsZWN0b3IiLCJkb2N1bWVudCIsInF1ZXJ5U2VsZWN0b3IiLCIkJCIsInNsaWNlIiwiY2FsbCIsInF1ZXJ5U2VsZWN0b3JBbGwiXSwibWFwcGluZ3MiOiI7Ozs7O0FBQUEsSUFBTUEsSUFBSSxTQUFKQSxDQUFJLENBQUNDLFFBQUQsRUFBYztBQUN0QixTQUFPQyxTQUFTQyxhQUFULENBQXVCRixRQUF2QixDQUFQO0FBQ0QsQ0FGRDs7QUFJQSxJQUFNRyxLQUFLLFNBQUxBLEVBQUssQ0FBQ0gsUUFBRCxFQUFjO0FBQ3ZCLFNBQU8sR0FBR0ksS0FBSCxDQUFTQyxJQUFULENBQWNKLFNBQVNLLGdCQUFULENBQTBCTixRQUExQixDQUFkLENBQVA7QUFDRCxDQUZEOztRQUlTRCxDLEdBQUFBLEM7UUFBR0ksRSxHQUFBQSxFIiwiZmlsZSI6Ii4vc3JjL2pzL3V0aWxzL3NlbGVjdG9yLmpzLmpzIiwic291cmNlc0NvbnRlbnQiOlsiY29uc3QgJCA9IChzZWxlY3RvcikgPT4ge1xuICByZXR1cm4gZG9jdW1lbnQucXVlcnlTZWxlY3RvcihzZWxlY3Rvcik7XG59O1xuXG5jb25zdCAkJCA9IChzZWxlY3RvcikgPT4ge1xuICByZXR1cm4gW10uc2xpY2UuY2FsbChkb2N1bWVudC5xdWVyeVNlbGVjdG9yQWxsKHNlbGVjdG9yKSk7XG59O1xuXG5leHBvcnQgeyAkLCAkJCB9O1xuXG5cblxuLy8gV0VCUEFDSyBGT09URVIgLy9cbi8vIC4vc3JjL2pzL3V0aWxzL3NlbGVjdG9yLmpzIl0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./src/js/utils/selector.js\n");

/***/ }),

/***/ 3:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__("./src/js/templates/cheatsheet.js");


/***/ })

/******/ });