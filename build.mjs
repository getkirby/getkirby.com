import * as esbuild from "esbuild";

await esbuild.build({
	// print status information to the terminal
	logLevel: "info",

	entryPoints: [
		"assets/css/index.css",
		"assets/css/layouts/*.css",
		"assets/js/index.js",
		"assets/js/layouts/*.js",
		"assets/js/libraries/*.js",
		"assets/js/templates/*.js",
	],

	// export JS files as modules
	format: "esm",

	// handle imports
	bundle: true,

	// strip whitespace and comments
	minify: true,

	// create external sourcemaps and link them with a comment
	sourcemap: true,

	// embed SVG files (icons) into the output
	loader: {".svg": "dataurl"},

	// store output files in the dist folder, keep folder hierarchy
	outdir: "assets/dist",
	outbase: "assets",
});
