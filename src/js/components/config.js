if ("kirbyConfig" in window && window.kirbyConfig.assetsPath) {
  // Overrides the public path for lazy-loaded/dynamic imports,
  // so they load from the correct CDN location.
  __webpack_public_path__ = window.kirbyConfig.assetsPath; // eslint-disable-line
}
