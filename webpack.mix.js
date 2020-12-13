/* eslint-env node */
/* eslint-disable no-console, no-sync, array-bracket-newline, no-process-env */

const autoprefixer = require("autoprefixer");
const calc = require("postcss-calc");
const extend = require("extend");
const fs = require("fs");
const glob = require("glob");
const mix = require("laravel-mix");
const path = require("path");

/* -------------------------------------------------------------------------- */

const ENV = process.env.NODE_ENV;

/* Load user config if exists */

const defaultConfig = JSON.parse(fs.readFileSync("./config.default.json"));

let config = {};

if (fs.existsSync(path.resolve(__dirname, "./config.json"))) {
  config = extend(defaultConfig, JSON.parse(fs.readFileSync("./config.json"))); // eslint-disable-line global-require
} else {
  config = defaultConfig;
}

/**
 * 1. Make $ENV variable globally available in SASS.
 */
const sassSettings = {
  data: `$ENV: ${ENV};`, /* 1 */
  precision: 10,
};

/**
 * 1. Deactivate integrated autoprefixer, because configuration is
 *    hardcoded (May 28th, 2018) and cannot be changed via
 *    configuration.
 */
mix.options({
  autoprefixer: false, /* 1 */
  postCss: [
    calc({ precision: 10 }),
    autoprefixer({
      browsers: [
        "last 2 versions",
        "not IE < 11",
        "not IE_mob <= 11",
        "not BB <= 10",
      ],
      grid: false,
    })
  ]
});

/* -------------------------------------------------------------------------- */

mix.js("src/js/index.js", "js");
mix.js("src/js/polyfills/respimage.js", "js/polyfills");

/* Search for template-specific JavaScript files */
const templateJS = glob.sync("./src/js/templates/*.js");
for (let i = 0, l = templateJS.length; i < l; i++) {
  mix.js(templateJS[i], "js/templates");
}

mix.sass("src/scss/index.scss", "css", sassSettings);

/* Search for template-specific CSS files */
const templateCSS = glob.sync("./src/scss/templates/*.scss");
for (let i = 0, l = templateCSS.length; i < l; i++) {
  mix.sass(templateCSS[i], "css/templates", sassSettings);
}

/* -------------------------------------------------------------------------- */

mix.browserSync({
  proxy: {
    target: config.host,
  },
  files: [
    "www/assets/css/*.css",
    "www/assets/css/templates/*.css",
    "www/assets/js/*.js",
    "site/snippets/**/*.php",
    "site/templates/**/*.php",
    "www/content/**/*",
  ],
  open: false,
  ghostMode: false,
});

mix.sourceMaps();
mix.disableNotifications();
mix.setPublicPath("www/assets");
mix.setResourceRoot("/assets/");

mix.webpackConfig({
  output: {
    publicPath: "/assets/",
    chunkFilename: "js/bundle-[name].js?id=[chunkhash]",
  },
  plugins: [
  ],
  stats: {
    assets: false,
    chunks: false,
    hash: false,
  },
});

mix.version();
