export default class {
	constructor() {
		this.init();
	}

	async init() {
		await import("../libraries/prism.js");
		this.setClass();
		this.setLanguages();
		this.setToolbar();
		Prism.highlightAll();
	}

	setClass() {
		Prism.plugins.customClass.prefix("code-");
	}

	setLanguages() {
		Prism.languages.kirbytext = Prism.languages.extend("markdown", {});

		Prism.languages.insertBefore("kirbytext", "prolog", {
			kirbytag: {
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
				},
			},
		});

		Prism.languages.kirbycontent = {
			delimiter: /\n----\s*\n*/,
			property: {
				pattern: /(^\n*|\n----\s*\n*)[a-zA-Z0-9_\-\u0020]+:/,
				lookbehind: true,
			},
		};
	}

	setToolbar() {
		Prism.plugins.toolbar.registerButton("select-code", (env) => {
			const button = document.createElement("button");
			button.insertAdjacentHTML(
				"beforeend",
				'<svg viewBox="0 0 16 16" class="icon" ara-hidden="true"><path d="M10,4H2C1.4,4,1,4.4,1,5v10c0,0.6,0.4,1,1,1h8c0.6,0,1-0.4,1-1V5C11,4.4,10.6,4,10,4z"></path> <path data-color="color-2" d="M14,0H4v2h9v11h2V1C15,0.4,14.6,0,14,0z"></path></svg>'
			);

			const text = document.createElement("span");
			text.textContent = "Copy";
			button.appendChild(text);

			button.addEventListener("click", async () => {
				const { default: clipboard } = await import(
					"../libraries/clipboard.js"
				);
				try {
					await clipboard(env.code);
					text.textContent = "Copied!";
				} catch (error) {
					text.textContent = "Press Ctrl+C/⌘+C to copy";
				} finally {
					setTimeout(() => {
						text.textContent = "Copy";
					}, 5000);
				}
			});

			return button;
		});
	}
}
