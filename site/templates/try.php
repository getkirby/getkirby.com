<?php layout() ?>

<article>
	<header class="mb-24">
		<div class="max-w-xl">
			<h1 class="h1 mb-6">
				Try Kirby
			</h1>

			<p class="text-xl leading-snug color-gray-700">
				Explore our online demo, or download Kirby and try it out yourself. Ready to launch? <a class="color-black link" href="/buy">Buy a license.</a>
			</p>
		</div>

		<?php if ($message): ?>
		<aside class="pt-6">
			<a href="/try" class="block box box--<?= $status ?>">
				<?php snippet('kirbytext/box', [
					'type' => $status,
					'text' => $message
				]) ?>
			</a>
		</aside>
		<?php endif ?>
	</header>

	<div class="columns mb-36" style="--columns: 1; --columns-lg: 2; --gap: var(--spacing-24)">

		<form id="demo" class="demo mb-6" action="<?= $host ?>" method="post">
			<h2 class="h2 mb-6">
				Instant online demo
			</h2>

			<p class="text-lg color-gray-700 leading-snug mb-6">
				You are one click away from your personal demo. Explore the Panel and get to know Kirby with our six example projects.
			</p>

			<button aria-label="Start the demo" class="block rounded shadow-2xl w-100% mb-6">
				<?php if ($image = image('home/company/panel.png')): ?>
				<figure class="bg-light" style="--aspect-ratio: <?= $image->width() ?>/<?= $image->height() ?>">
					<?= img($image, [
						'alt' => 'A screenshot of the Panel',
						'src' => [
							'width' => 576,
						],
						'lazy' => false,
						// sizes generated with https://ausi.github.io/respimagelint/
						'sizes' => '(min-width: 1520px) 576px, (min-width: 1160px) calc(41.18vw - 42px), (min-width: 480px) calc(100vw - 96px), 90vw',
						'srcset' => [
							400,
							576,
							800,
							1152,
						]
					]) ?>
				</figure>
				<?php endif ?>
			</button>

			<button class="btn btn--filled">
				<?= icon('bolt') ?>
				Start Demo
			</button>
		</form>

		<section id="kits">
			<h2 class="h2 mb-6">On your computer</h2>

			<p class="text-lg color-gray-700 leading-snug mb-6">
				Install Kirby on your computer or a test server and
				evaluate it as long as you need. How? <a class="color-black link" href="/docs/guide/quickstart">Get up and running …</a>
			</p>

			<div class="columns" style="--columns: 1; --columns-lg: 1; --gap: var(--spacing-6)">
				<article class="p-6 bg-white shadow-2xl rounded">
					<h2 class="font-bold mb-1">Starterkit</h2>
					<p class="mb-6">Fully annotated sample site for everyone who wants to learn about Kirby's capabilities. </p>
					<p class="flex flex-wrap" style="--gap: var(--spacing-3)">
						<a aria-label="Download the Starterkit" class="btn btn--filled" href="<?= option('github.url') ?>/starterkit/archive/main.zip">
							<?= icon('download') ?>
							Download ZIP
						</a>
						<a aria-label="Install the Starterkit" class="btn btn--filled" href="https://herd.laravel.com/new/getkirby/starterkit">
							<?= icon('bolt') ?>
							Install with Herd
						</a>
					</p>
				</article>

				<article class="p-6 bg-white shadow-2xl rounded">
					<h2 class="font-bold mb-1">Plainkit</h2>
					<p class="mb-6">No templates, no content, no styles – just you, Kirby and your imagination.</p>
					<p class="flex flex-wrap" style="--gap: var(--spacing-3)">
						<a aria-label="Download the Plainkit" class="btn btn--filled" href="<?= option('github.url') ?>/plainkit/archive/main.zip">
							<?= icon('download') ?>
							Download ZIP
						</a>
						<a aria-label="Install the Starterkit" class="btn btn--filled" href="https://herd.laravel.com/new/getkirby/plainkit">
							<?= icon('bolt') ?>
							Install with Herd
						</a>
					</p>
				</article>
			</div>
		</section>
	</div>

	<section class="mb-42">
		<h2 class="h2 mb-6">Frequently asked questions</h2>
		<?php snippet('faq') ?>
	</section>

	<?php snippet('templates/home/brands') ?>
</article>

<dialog
	id="loader"
	aria-label="Preparing your demo"
	aria-modal="true"
	class="overlay"
>
	<div class="bg-white rounded text-center shadow-xl p-12">
		<p class="font-bold">We are preparing your demo 🎉</p>
		<p>This can take a few seconds. Please don't close this window!<br>You will be redirected automatically ...</p>
	</div>
</dialog>

<script>
<?php if ($detectHost === true): ?>
// select fastest demo server
const zones = <?= json_encode($zones) ?>;
const hosts = zones.reduce((acc, zone) => {
	return {...acc, ["https://" + zone + ".trykirby.com"]: []}
}, {});

const resourceObserver = new PerformanceObserver((list) => {
	for (const host in hosts) {
		list.getEntriesByName(host + "/ping", "resource").forEach((resource) => {
			hosts[host].push(resource.responseEnd - resource.connectStart);
		});
	}

	processResultsIfReady();
});
resourceObserver.observe({type: "resource"});

// perform three test requests per server to average them;
// use a short timeout of 1 second so we have a quick decision
const controller = new AbortController();
const options    = {mode: "no-cors", signal: controller.signal};
setTimeout(() => controller.abort(), 1000);
for (const host in hosts) {
	sendFetchRequest(host);
	setTimeout(() => sendFetchRequest(host), 25);
	setTimeout(() => sendFetchRequest(host), 50);
}

function sendFetchRequest(host) {
	fetch(host + "/ping", options).catch(() => {
		// request failed or timed out
		hosts[host].push(1000);
		processResultsIfReady();
	});
}

function processResultsIfReady() {
	// all hosts need to have three results
	for (const host in hosts) {
		if (hosts[host].length < 3) {
			return;
		}
	}

	// stop collecting events
	resourceObserver.disconnect();

	console.info("Got demo host results:", hosts);

	// calculate the average for each host
	const averages = {};
	for (const host in hosts) {
		averages[host] = hosts[host].reduce((a, b) => (a + b)) / hosts[host].length;
	}

	// find the host with the smallest value
	const winner = Object.keys(averages).reduce((host, winner) => averages[winner] < averages[host] ? winner : host);
	console.info("Deciding on host " + winner);

	document.querySelector("#demo").action = winner;
}
<?php endif ?>

// loading overlay when the demo form is submitted
const loader = document.querySelector("#loader");
loader.addEventListener("cancel", (e) => e.preventDefault());
document.querySelector("#demo").addEventListener("submit", (e) => {
	loader.showModal();
	document.body.style.cursor = "progress";
});
</script>
