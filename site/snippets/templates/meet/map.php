<section class="mb-24">

	<header class="flex justify-between items-center mb-6">
		<h2 class="h2">Community map</h2>
		<button
			class="btn btn--filled"
			onclick="document.querySelector('#form').showModal()"
		>
			<?= icon('icon-outline') ?>
			Add yourself
		</button>
	</header>

	<div class="map rounded-xl" id="map"></div>

	<style>
	.map {
		height: 90dvh;
		max-height: 45rem;
	}

	.leaflet-popup-content-wrapper {
		box-shadow: var(--shadow);
	}

	.leaflet-popup {
		--color-text: var(--color-blue-600);
		--color-back: var(--color-blue-200);
	}
	.leaflet-popup:has(.partner) {
		--color-text: var(--color-purple-600);
		--color-back: var(--color-purple-200);
	}
	.leaflet-popup:has(.team) {
		--color-text: var(--color-yellow-700);
		--color-back: var(--color-yellow-200);
	}

	.leaflet-popup-content,
	.leaflet-popup-content p {
		margin: 0;
	}
	.leaflet-popup-content a {
		color: var(--color-text);
	}
	.leaflet-popup-content kbd {
		font-size: 0.65rem;
		padding: var(--spacing-1);
		border-radius: var(--rounded-xs);
		background: var(--color-back);
		margin-inline-end: var(--spacing-2);
	}
	.leaflet-popup-content .flex {
		gap: var(--spacing-2);
	}
	.leaflet-popup-content .text-xs svg {
		width: 14px;
		height: 14px;
	}
	.leaflet-popup-content .contacts,
	.leaflet-popup-tip {
		background: var(--color-back);
	}
	.leaflet-popup-content .contacts li {
		display: flex;
		gap: var(--spacing-2);
	}
	.leaflet-popup-close-button {
		color: var(--color-gray-400) !important;
	}

	.marker-cluster {
		background-clip: padding-box;
		border-radius: 50%;
	}
	.marker-cluster div {
		width: 2rem;
		height: 2rem;
		margin: .25rem;

		text-align: center;
		border-radius: 50%;
		font-size: .7rem;
	}
	.marker-cluster span {
		line-height: 2rem;
	}

	.marker-cluster-small {
		background-color: hsl(var(--color-blue-hs), var(--color-blue-l-300), 0.6);
		}
	.marker-cluster-small div {
		background-color: hsl(var(--color-blue-hs), var(--color-blue-l-400), 0.65);
		}

	.marker-cluster-medium {
		background-color: hsl(var(--color-blue-hs), var(--color-blue-l-400), 0.6);
	}
	.marker-cluster-medium div {
		background-color: hsl(var(--color-blue-hs), var(--color-blue-l-500), 0.75);
		}

	.marker-cluster-large {
		background-color: hsl(var(--color-blue-hs), var(--color-blue-l-500), 0.6);
		}
	.marker-cluster-large div {
		background-color: hsl(var(--color-blue-hs), var(--color-blue-l-600), 0.85);
		}
	</style>

	<script>
	const map = L.map('map', { scrollWheelZoom: false }).setView([40, 5], 2);

	const tiles = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_nolabels/{z}/{x}/{y}{r}.png', {
		attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
		subdomains: 'abcd',
		minZoom: 2,
		maxZoom: 10
	}).addTo(map);

	const iconCommunity = L.DivIcon.extend({
		options: {
			className: "marker",
			html: `<?= icon('icon-outline') ?>`,
			iconSize: [16, 16],
			iconAnchor: [8, 8],
			popupAnchor: [0, -8]
		}
	});

	const iconPartner = iconCommunity.extend({
		options: {
			html: `<?= icon('icon-blank') ?>`,
		}
	});

	const iconTeam = iconCommunity.extend({
		options: {
			html: `<?= icon('icon-fill') ?>`,
		}
	});

	const markers = L.markerClusterGroup({
		showCoverageOnHover: false,
		maxClusterRadius: 30,
		spiderLegPolylineOptions: { weight: 1, color: '#ccc', opacity: 0.75 },
	});

	<?php foreach($people as $person): ?>
		markers.addLayer(
			L.marker(
				[<?= $person->latitude() ?>, <?= $person->longitude() ?>],
				{ icon: new <?= match (true) {
					$person->type() == 'Core team'   => 'iconTeam',
					$person->partner()->isNotEmpty() => 'iconPartner',
					default                          => 'iconCommunity'
				} ?> }
			).bindPopup(
				`
	<div class="p-3 <?= $person->partner()->isNotEmpty() ? 'partner' : '' ?> <?= $person->type() == 'Core team' ? 'team' : '' ?>">
		<header class="mb-3">
			<h4 class="h5"><?= $person->name() ?></h4>

			<?php if ($person->partner()->isNotEmpty()): ?>
			<div class="flex text-xs">
				<?= match ($person->partner()->value()) {
					'Certified Partner' => icon('verified'),
					default             => icon('icon-blank')
				 } ?>
				<?= $person->partner() ?>
			</div>
			<?php endif ?>

			<?php if ($person->business()->isNotEmpty()): ?>
			<div class="flex text-xs">
				<?= match ($person->type()->value) {
					'Core team'          => icon('icon-fill'),
					'Freelancer'         => icon('user'),
					'Agency/Studio/Team' => icon('users'),
					default              => icon('store')
				} ?>
				<?= $person->business() ?>
			</div>
			<?php endif ?>

			<div class="flex text-xs">
				<?= icon('map') ?>
				<?= $person->place() ?>, <?= $person->country() ?>
			</div>
		</header>

		<aside class="mb-1">
			<?php foreach ($person->interests()->split() as $interest): ?>
			<kbd><?= $interest ?></kbd>
			<?php endforeach ?>
		</aside>
	</div>

	<?php if ($person->hasPlatforms()): ?>
	<ul class="contacts p-3">
		<?php if ($person->website()->isNotEmpty()): ?>
		<li title="Website: <?= $url = parse_url($person->website(), PHP_URL_HOST) ?? $person->website() ?>"><?= icon('url') ?> <a href="<?= $person->website()->toUrl() ?>"><?= $url ?></a></li>
		<?php endif ?>

		<?php if ($person->email()->isNotEmpty()): ?>
		<li title="Email: <?= $person->email() ?>"><?= icon('email') ?> <a href="mailto:<?= $person->email() ?>"><?= $person->email() ?></a></li>
		<?php endif ?>

		<?php if ($person->forum()->isNotEmpty()): ?>
		<li title="Forum: <?= $person->forum() ?>"><?= icon('chat') ?> <a href="https://forum.getkirby.com/u/<?= $person->forum() ?>"><?= $person->forum() ?></a></li>
		<?php endif ?>

		<?php if ($person->discord()->isNotEmpty()): ?>
		<li title="Discord: <?= $person->discord() ?>"><?= icon('discord') ?> <?= $person->discord() ?></li>
		<?php endif ?>

		<?php if ($person->github()->isNotEmpty()): ?>
		<li title="GitHub: <?= $person->github() ?>"><?= icon('github') ?> <a href="https://github.com/<?= $person->github() ?>"><?= $person->github() ?></a></li>
		<?php endif ?>

		<?php if ($person->mastodon()->isNotEmpty()): ?>
		<li title="Mastodon: <?= $person->mastodon() ?>"><?= icon('mastodon') ?> <?= $person->mastodon() ?></li>
		<?php endif ?>

		<?php if ($person->instagram()->isNotEmpty()): ?>
		<li title="Instagram: <?= $person->instagram() ?>"><?= icon('instagram') ?> <a href="https://instagram.com/<?= $person->instagram() ?>"><?= $person->instagram() ?></a></li>
		<?php endif ?>

		<?php if ($person->linkedin()->isNotEmpty()): ?>
		<li title="LinkedIn: <?= $person->linkedin() ?>"><?= icon('linkedin') ?> <?= $person->linkedin() ?></li>
		<?php endif ?>
	</ul>
	<?php endif ?>
				`
			)
		);
	<?php endforeach ?>

	map.addLayer(markers);
	</script>
</section>
