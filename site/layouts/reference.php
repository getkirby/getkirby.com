<!DOCTYPE html>
<html lang="en">
<head>
	<?php snippet('layouts/head') ?>
	<?= css('assets/css/layouts/reference.css') ?>
</head>

<div class="hidden">
	<?= svg($kirby->root('panel') . '/dist/img/icons.svg') ?>
</div>

<body class="reference">

	<header class="reference-header header">
		<?php snippet('layouts/skipper') ?>
		<div class="header-content relative flex items-center">
			<?php snippet('layouts/logo') ?>
			<?php snippet('layouts/menu') ?>
			<?php snippet('layouts/search', ['area' => 'reference']) ?>
		</div>
	</header>

	<?php snippet('templates/reference/menu') ?>

	<main class="reference-panels">

		<nav class="reference-sidebar reference-panel sidebar">
			<?php snippet('sidebar/menu', [
				'menu' => collection('reference'),
				'open' => true
			]) ?>
		</nav>

		<?php if ($page->hasEntries()): ?>
		<?php snippet('templates/reference/entries', [
			'entries' => $entries ?? $page->siblings()->listed()
		]) ?>
		<?php endif ?>

		<article id="main" class="reference-content reference-panel">
			<header class="mb-12">
				<h1 class="h1 mb-6"><?= $page->title() ?></h1>
				<?php if ($page->intro()->isNotEmpty()): ?>
				<div class="prose mb-12">
					<div class="intro color-gray-700">
						<?= $page->intro()->kt() ?>
					</div>
				</div>
				<?php endif ?>
				<?php snippet('templates/reference/entry/meta', [
					'filter' => $filter ?? false
				]) ?>
			</header>

			<?php if ($toc = $slots->toc()): ?>
				<?= $toc ?>
			<?php else: ?>
				<?php snippet('toc') ?>
			<?php endif ?>

			<?= $slot ?>

			<?php snippet('templates/reference/footer') ?>
			<?php snippet('layouts/footer', ['separator' => false]) ?>
		</article>
	</main>

	<script>
	class ReferenceScrollRestore {

		constructor() {
			this.storage  = "getkirby$reference$scroll";
			this.$sidebar = document.querySelector(".reference-sidebar");
			this.$entries = document.querySelector(".reference-entries");
			this.$links   = document.querySelectorAll("a");

			this.restore();
			this.reset();

			for (let i = 0; i < this.$links.length; i++) {
				this.$links[i].onclick = this.store.bind(this);
			}
		}

		restore() {
			const data = JSON.parse(sessionStorage.getItem(this.storage));

			if (data) {
				this.scrollTo(data);
			} else {
				this.scrollToActive();
			}
		}

		scrollTo(offsets) {
			this.$sidebar.scrollTop = offsets.sidebar;

			if (this.$entries) {
				this.$entries.scrollTop = offsets.entries;
			}

			this.reset();
		}

		scrollToActive() {
			<?php
			$reference = page('docs/reference');
			$reference = $reference->parents()->add($reference);
			$sidebar   = $page->parents()->not($reference)->last() ?? $reference;
			?>

			const data = {
				sidebar: 0,
				entries: 0
			};

			const sidebar = this.$sidebar.querySelector(`li[data-id="<?= $sidebar->id() ?>"]`);
			if (sidebar) {
				data.sidebar = sidebar.offsetTop - this.$sidebar.offsetTop - 10;
			}

			if (this.$entries) {
				const entries = this.$entries.querySelector(`li[data-id="<?= ($entry ??$page)->id() ?>"]`);
				if (entries) {
					data.entries = entries.offsetTop - this.$entries.offsetTop;
				}
			}

			this.scrollTo(data);
		}

		store(e) {
			// Make sure to get link tag
			let target = e.target;
			while (target.tagName !== "A") {
				target = target.parentElement;
			}

			// If linking outside of reference, skip
			if (target.href.includes("docs/reference") === false) {
				return this.reset();
			}

			const data = { sidebar: this.$sidebar.scrollTop };

			if (this.$entries) {
				data.entries = this.$entries.scrollTop;
			}

			sessionStorage.setItem(this.storage, JSON.stringify(data));
		}

		reset() {
			sessionStorage.removeItem(this.storage);
		}
	}

	new ReferenceScrollRestore();
	</script>

	<script type="module">
	import  { Menu } from "<?= url('/assets/js/layouts/reference.js') ?>";
	new Menu();
	</script>
</body>
</html>
