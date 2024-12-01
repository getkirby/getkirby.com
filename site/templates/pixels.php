<?php layout('empty') ?>

<div v-scope class="editor" @drop.prevent="onDrop">
	<nav class="editor-toolbar">
		<div v-cloak>
			<div class="field">
				<label class="label">Presets</label>
				<div class="select">
					<select @input="setPreset" v-model="settings.preset">
						<option
							v-for="(preset, id) in presets"
							:value="id"
						>
							{{ preset.label }}
						</option>
					</select>
				</div>
			</div>
			<div class="field">
				<label class="label">Headline</label>
				<input class="input" type="text" v-model="settings.headline">
			</div>
			<div class="columns mb-3" style="--columns: 2; --gap: var(--spacing-1)">
				<div class="field">
					<label class="label">Logo</label>
					<div class="checkbox">
						<input type="checkbox" name="logo" v-model="settings.logo">
					</div>
				</div>
				<div class="field">
					<label class="label">Browser</label>
					<div class="checkbox">
						<input type="checkbox" name="browser" v-model="settings.browser">
					</div>
				</div>
			</div>
			<div class="field">
				<label class="label">Image</label>
				<div class="upload">
					<p>Select …</p>
					<input type="file" accept="image/*" @input="onUpload">
				</div>
			</div>
			<div class="field">
				<label class="label">Image scale</label>
				<div class="range">
					<input type="range" v-model="settings.scale" min="100" max="250">
				</div>
			</div>
			<div class="field">
				<label class="label">Image alignment</label>
				<ul class="inputs columns" style="--columns: 3">
					<li v-for="position in positions">
						<label><input type="radio" v-model="settings.position" :value="position"> {{ position.arrow }}</label>
					</li>
				</ul>
			</div>
			<div class="columns" style="--columns: 2; --gap: var(--spacing-1)">
				<div class="field">
					<label class="label">Shadow</label>
					<div class="checkbox">
						<input type="checkbox" name="shadow" v-model="settings.shadow">
					</div>
				</div>
				<div class="field">
					<label class="label">Rounded corners</label>
					<div class="checkbox">
						<input type="checkbox" name="rounded" v-model="settings.rounded">
					</div>
				</div>
			</div>
			<div class="field">
				<label class="label">Background</label>
				<div class="colors">
					<button
						v-for="color in colors"
						type="button"
						:aria-selected="settings.background === color"
						:style="'--color:' + color"
						@click="settings.background = color"
					>
						<span></span>
					</button>
				</div>
			</div>
			<div class="field">
				<label class="label">Pattern</label>
				<div class="select">
					<select @input="setPattern">
						<option value="">
							-
						</option>
						<option
							v-for="pattern in patterns"
							:value="pattern"
							:selected="pattern === settings.pattern"
						>
							{{ pattern }}
						</option>
					</select>
				</div>
			</div>
			<div class="field">
				<label class="label">Text Color</label>
				<div class="colors">
					<button
						type="button"
						:aria-selected="settings.color === 'white'"
						:style="'--color: white'"
						@click="settings.color = 'white'"
					>
						<span></span>
					</button>
					<button
						type="button"
						:aria-selected="settings.color === 'black'"
						:style="'--color: black'"
						@click="settings.color = 'black'"
					>
						<span></span>
					</button>
				</div>
			</div>
			<div class="field">
				<label class="label">Dimensions</label>
				<div class="columns" style="--columns: 2; --gap: var(--spacing-1)">
					<input
						class="input"
						type="number"
						min="100"
						v-model="settings.width"
						placeholder="width"
					>
					<input
						class="input"
						type="number"
						min="100"
						v-model="settings.height"
						placeholder="height"
					>
				</div>
			</div>
			<div class="field">
				<label class="label">Margins</label>
				<div class="columns" style="--columns: 2; --gap: var(--spacing-1)">
					<input
						class="input"
						type="number"
						min="0"
						v-model="settings.mt"
						placeholder="top"
					>
					<input
						class="input"
						type="number"
						min="0"
						v-model="settings.mr"
						placeholder="right"
					>
					<input
						class="input"
						type="number"
						min="0"
						v-model="settings.mb"
						placeholder="bottom"
					>
					<input
						class="input"
						type="number"
						min="0"
						v-model="settings.ml"
						placeholder="left"
					>
				</div>
			</div>
			<button class="btn" @click="exportImage">
				<?= icon('download') ?> Export
			</button>
		</div>
	</nav>

	<div class="editor-main">

		<div v-cloak v-if="isExporting" class="editor-exporter">
			<p>Exporting …</p>
		</div>

		<div v-cloak class="editor-canvas" :data-preset="settings.preset" :style="{
				backgroundColor: settings.background,
				width: settings.width + 'px',
				height: settings.height + 'px',
				color: settings.color
			}">

			<div v-if="settings.pattern" class="editor-pattern" :style="{backgroundImage: `url(/assets/patterns/${settings.pattern}.jpg)`}"></div>

			<header class="editor-header">
				<div
					class="editor-headline"
					:style="{
						color: settings.color,
						fontWeight: settings.fontWeight
					}"
				>
					{{ settings.headline }}
				</div>
				<div v-if="settings.logo" class="editor-logo"><?= icon('icon') ?></div>
			</header>

			<div class="editor-image" :data-rounded="settings.rounded" :data-shadow="settings.shadow" :style="{
					top: settings.mt + 'rem',
					right: settings.mr + 'rem',
					bottom: settings.mb + 'rem',
					left: settings.ml + 'rem',
					...settings.corners,
				}">
				<template v-if="settings.browser">
					<div class="editor-browser bg-black flex items-center" style="--gap: .375rem; padding: .625rem">
						<svg width="10" height="10">
							<circle fill="var(--color-gray-700)" cx="5" cy="5" r="5" />
						</svg>
						<svg width="10" height="10">
							<circle fill="var(--color-gray-700)" cx="5" cy="5" r="5" />
						</svg>
						<svg width="10" height="10">
							<circle fill="var(--color-gray-700)" cx="5" cy="5" r="5" />
						</svg>
					</div>
				</template>
				<template v-if="settings.image">
					<div class="editor-image-wrapper">
						<img :data-y="settings.position.y" :data-x="settings.position.x" :src="settings.image" :style="{ width: settings.scale + '%' }">
					</div>
				</template>
			</div>
		</div>
	</div>
</div>

<?= js('assets/js/libraries/download.js') ?>
<script type="module">
	import { toPng } from '<?= url('assets/js/libraries/html-to-image.js') ?>';

	import {
		createApp,
		reactive
	} from '<?= url('assets/js/libraries/petite-vue.js') ?>';

	const preventDefault = (e) => {
		e.stopPropagation();
		e.preventDefault();
	};

	window.addEventListener("dragenter", preventDefault, false);
	window.addEventListener("dragover", preventDefault, false);
	window.addEventListener("dragexit", preventDefault, false);
	window.addEventListener("dragleave", preventDefault, false);
	window.addEventListener("drop", preventDefault, false);

	const placeholder = "/assets/pixels/panel.png";

	const colors = {
		white: "var(--color-white)",
		light: "var(--color-light)",
		gray: "#5d6166",
		dark: "var(--color-dark)",
		black: "var(--color-black)",
	};

	const positions = {
		topLeft: {
			y: "top",
			x: "left",
			arrow: "↘"
		},
		topCenter: {
			y: "top",
			x: "center",
			arrow: "↓"
		},
		topRight: {
			y: "top",
			x: "right",
			arrow: "↙"
		},
		centerLeft: {
			y: "center",
			x: "left",
			arrow: "→"
		},
		centerCenter: {
			y: "center",
			x: "center",
			arrow: "↔"
		},
		centerRight: {
			y: "center",
			x: "right",
			arrow: "←"
		},
		bottomLeft: {
			y: "bottom",
			x: "left",
			arrow: "↗"
		},
		bottomCenter: {
			y: "bottom",
			x: "center",
			arrow: "↑"
		},
		bottomRight: {
			y: "bottom",
			x: "right",
			arrow: "↖"
		},
	};

	const patterns = [
		"abyss",
		"beach",
		"beetroot",
		"blobs",
		"darkness",
		"deepsea",
		"dragon",
		"gold",
		"lagoon",
		"lava",
		"pinkblue",
		"purple",
		"rainforest",
		"sea",
		"sky",
		"space",
		"turmoil",
		"viscera",
	];

	const presets = {
		social: {
			preset: "social",
			label: "Social media image",
			background: colors.black,
			headline: "Kirby: The CMS that adapts to you",
			color: "white",
			logo: true,
			mt: 10,
			mr: 6,
			ml: 6,
			width: 1200,
			height: 630,
			pattern: "pinkblue",
			rounded: true,
			shadow: true
		},
		kosmos: {
			preset: "kosmos",
			label: "Kosmos Banner",
			background: colors.black,
			headline: "Kirby",
			image: false,
			color: "white",
			logo: true,
			mt: 0,
			mr: 0,
			ml: 0,
			mb: 0,
			width: 960,
			height: 160,
			pattern: "pinkblue",
			rounded: false,
			shadow: false
		},
		instagram: {
			preset: "instagram",
			label: "Instagram",
			background: colors.dark,
			mt: 6,
			mr: 6,
			ml: 6,
			mb: 6,
			width: 1024,
			height: 1024,
			position: positions.centerCenter,
			shadow: true,
		},
		viewPlugin: {
			preset: "viewPlugin",
			label: "Panel view plugin",
			background: colors.gray,
			mt: 6,
			ml: 6,
			rounded: true,
			shadow: true
		},
		fieldPlugin: {
			preset: "fieldPlugin",
			label: "Panel field plugin",
			background: colors.light,
			mt: 4,
			ml: 4,
			mr: 4,
			rounded: false,
			shadow: false
		},
		fullscreen: {
			preset: "fullscreen",
			label: "Fullscreen",
			background: colors.gray,
		},
		logo: {
			preset: "logo",
			label: "Plugin logo",
			background: colors.white,
			mt: 1,
			ml: 1,
			mr: 1,
			mb: 1,
			width: 128,
			height: 128
		},
		showcase: {
			preset: "showcase",
			label: "Showcase",
			background: colors.gray,
			width: 600,
			height: 800,
		}
	};

	const defaults = {
		background: colors.white,
		browser: false,
		color: "white",
		headline: null,
		image: placeholder,
		logo: false,
		mt: 0,
		mr: 0,
		mb: 0,
		ml: 0,
		pattern: null,
		position: positions.topCenter,
		preset: null,
		rounded: false,
		scale: 100,
		shadow: false,
		width: 1024,
		height: 512,
	};

	const settings = reactive({
		...defaults,
		...presets.social,
		get corners() {
			if (this.rounded === false) {
				return {};
			}

			let corners = {
				borderTopLeftRadius: "7px",
				borderTopRightRadius: "7px",
				borderBottomLeftRadius: "7px",
				borderBottomRightRadius: "7px",
			};

			if (this.mt === 0) {
				delete corners.borderTopLeftRadius;
				delete corners.borderTopRightRadius;
			}

			if (this.mr === 0) {
				delete corners.borderTopRightRadius;
				delete corners.borderBottomRightRadius;
			}

			if (this.ml === 0) {
				delete corners.borderTopLeftRadius;
				delete corners.borderBottomLeftRadius;
			}

			if (this.mb === 0) {
				delete corners.borderBottomLeftRadius;
				delete corners.borderBottomRightRadius;
			}

			return corners;

		},
		get fontWeight() {
			return this.color === "black" ? 400 : 300;
		}
	});

	createApp({
		colors,
		patterns,
		placeholder,
		positions,
		presets,
		settings,
		isExporting: false,
		async exportImage() {
			this.isExporting = true;
			const canvas = document.querySelector(".editor-canvas");
			const dataUrl = await toPng(canvas);
			download(dataUrl, "pixels.png");
			this.isExporting = false;
		},
		onDrop(event) {
			if (!event.dataTransfer.files || event.dataTransfer.files.length === 0) {
				return;
			}

			this.selectFile(event.dataTransfer.files[0]);
		},
		onUpload(event) {
			if (!event.target.files || event.target.files.length === 0) {
				return;
			}

			this.selectFile(event.target.files[0]);
		},
		selectFile(file) {
			const reader = new FileReader();

			if (file.type.startsWith("image/") === false) {
				return false;
			}

			reader.onload = () => {
				this.settings.image = reader.result;
			};

			reader.readAsDataURL(file);
		},
		setPattern(event) {
			this.settings.pattern = event.target.value;
		},
		setPreset(event) {
			const newSettings = {
				...defaults,
				...presets[event.target.value],
			};

			for (const key in newSettings) {
				this.settings[key] = newSettings[key];
			}
		}
	}).mount();
</script>

<style>
	[v-cloak] {
		display: none;
	}

	html,
	body {
		height: 100%;
		overflow: hidden;
	}

	.editor {
		display: grid;
		height: 100%;
		grid-template-columns: 20rem 2fr;
	}

	.editor-toolbar {
		background: var(--color-light);
		accent-color: var(--color-blue-700);
		padding: 1.5rem;
		font-size: var(--text-sm);
		max-height: 100%;
		overflow: auto;
	}

	.editor-toolbar .field {
		margin-bottom: var(--spacing-6);
	}

	.editor-toolbar .label {
		font-weight: var(--font-bold);
		margin-bottom: var(--spacing-1);
		display: block;
	}

	.editor-toolbar .input {
		font-size: var(--text-sm);
		padding: .25rem .5rem;
	}

	.editor-toolbar .upload {
		position: relative;
		background: var(--color-white);
		padding: .25rem .5rem;
	}

	.editor-toolbar .upload input {
		position: absolute;
		inset: 0;
		opacity: 0;
		cursor: pointer;
	}

	.editor-toolbar .inputs {
		display: grid;
		grid-template-columns: 1;
		grid-gap: 2px;
	}

	.editor-toolbar .inputs li {
		padding: .25rem .5rem;
		background: var(--color-white);
	}

	.editor-toolbar .inputs label {
		cursor: pointer;
		display: flex;
		align-items: center;
	}

	.editor-toolbar .inputs input {
		margin-right: .5rem;
	}

	.editor-toolbar .checkbox {
		background: var(--color-white);
		padding: .25rem .5rem;
	}

	.editor-toolbar .range {
		line-height: 0;
		background: var(--color-white);
		padding: .25rem .5rem;
	}

	.editor-toolbar .select {
		background: var(--color-white);
	}

	.editor-toolbar .select select {
		border: none;
		font-family: inherit;
		padding: 0.25rem 2rem 0.25rem 0.5rem;
	}

	.editor-toolbar input[type="range"] {
		width: 100%;
	}

	.editor-toolbar .colors {
		display: flex;
		gap: 2px;
	}

	.editor-toolbar .colors button {
		padding: .25rem;
		background: var(--color-white);
	}

	.editor-toolbar .colors button[aria-selected="true"] {
		outline: 2px solid var(--color-blue-700);
	}

	.editor-toolbar .colors button span {
		display: block;
		background: var(--color);
		width: 1.25rem;
		height: 1.25rem;
	}

	.editor-toolbar .btn {
		border: 2px solid currentColor;
		width: 100%;
		padding: .25rem;
		border-radius: var(--rounded);
	}

	.editor-main {
		position: relative;
		display: grid;
		place-items: center;
	}

	.editor-canvas {
		position: relative;
		background-color: var(--color-light);
		overflow: hidden;
		color: var(--color-white);
	}

	.editor-pattern {
		position: absolute;
		inset: 0;
		background-size: cover;
		background-position: center center;
		opacity: .625;
	}

	.editor-header {
		position: absolute;
		top: 4rem;
		left: 6rem;
		right: 6rem;
		z-index: 1;
		display: flex;
		justify-content: space-between;
		align-items: center;
	}

	.editor-headline {
		font-weight: 600;
		font-size: 3rem;
		flex-grow: 1;
		margin-right: 1.5rem;
	}

	.editor-logo svg {
		--size: 4rem;
		width: var(--size);
		height: var(--size);
	}

	.editor-logo svg * {
		fill: currentColor;
	}

	.editor-image {
		--rounded: 7px;
		position: absolute;
		top: 0;
		right: 0;
		bottom: 0;
		left: 0;
		overflow: hidden;
		display: flex;
		flex-direction: column;
	}

	.editor-image[data-shadow="true"] {
		filter: drop-shadow(0 25px 25px rgb(0 0 0 / 0.5));
	}

	.editor-browser {
		flex-shrink: 0;
		z-index: 1;
	}

	.editor-image-wrapper {
		position: relative;
		flex-grow: 1;
	}

	.editor-image img {
		position: absolute;
		max-width: none;
		object-fit: cover;
		object-position: top center;
	}

	.editor-image img[data-x="left"] {
		left: 0;
	}

	.editor-image img[data-x="center"] {
		left: 50%;
		transform: translateX(-50%);
	}

	.editor-image img[data-x="right"] {
		right: 0;
	}

	.editor-image img[data-y="top"] {
		top: 0;
	}

	.editor-image img[data-y="center"] {
		top: 50%;
		transform: translateY(-50%);
	}

	.editor-image img[data-y="bottom"] {
		bottom: 0;
	}

	.editor-image img[data-x="center"][data-y="center"] {
		left: 50%;
		transform: translate(-50%, -50%);
	}

	.editor-exporter {
		position: fixed;
		inset: 0;
		background: rgba(255, 255, 255, .6);
		z-index: 1;
		display: grid;
		place-items: center;
	}

	.editor-exporter p {
		background: white;
		box-shadow: var(--shadow-xl);
		padding: 1rem 2rem;
		font-weight: var(--font-bold);
		border-radius: var(--rounded);
	}


 	[data-preset="kosmos"] .editor-header {
		justify-content: center;
		inset: 0;
		gap: 1.5rem;
	}
	[data-preset="kosmos"] .editor-headline {
		flex-grow: 0;
		width: max-content;
		order: 2;
		font-weight: 700 !important;
	}
	[data-preset="kosmos"] .editor-headline input {
		appearance: none;
		width: 12rem !important;
	}

</style>
