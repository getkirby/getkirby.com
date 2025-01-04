<?php

$minDate = new DateTime('January 1 - 3 years');
$maxDate = new DateTime('January 1 + 4 years');

$filteredVersions = $versions->flip()->filterBy('endOfLife', 'date >=', date('Y-m-d', $minDate->getTimestamp()));

/**
 * Converts an input date (or the current time) into a timestamp
 */
$normalizeTimestamp = function(DateTime|string|null $date = null): int
{
	if ($date instanceof DateTime) {
		return $date->getTimestamp();
	}

	if ($date !== null) {
		return strtotime($date);
	}

	return time();
};

/**
 * Returns the SVG X coordinate of a given timestamp
 * or of the current day
 */
$calendarPosition = function(DateTime|string|null $date = null) use($normalizeTimestamp, $minDate, $maxDate): float {
	$time     = $normalizeTimestamp($date);
	$position = max(0, min(1, ($time - $minDate->getTimestamp()) / ($maxDate->getTimestamp() - $minDate->getTimestamp())));

	return 90 + 800 * $position;
};

/**
 * Returns the label text of a given timestamp
 * or of the current day
 */
$calendarText = function(DateTime|string|null $date = null) use($normalizeTimestamp): string {
	$time = $normalizeTimestamp($date);
	return date('M j, Y', $time);
};

$calendarHeight = 30 * count($filteredVersions) + 30;
$calendarWidth  = $calendarPosition($maxDate) + 45;
?>
<style>
.security-versions-table {
	margin-bottom: var(--spacing-6);
}

.security-versions-table table {
	min-width: 36rem;
}
.security-versions-table td,
.security-versions-table th {
	font-size: var(--text-sm);
}
.security-versions-table .symbol {
	text-align: center;
	vertical-align: middle;
	width: 1px;
}

.security-versions-table .status-end-of-life {
	background: var(--color-red);
}
.security-versions-table .status-security-support {
	background: var(--color-yellow);
}
.security-versions-table .status-active-support {
	background: var(--color-green);
}

.security-versions-calendar {
	overflow-x: auto;
}

.security-versions-calendar svg {
	max-width: 100%;
	min-width: 45rem;
	height: auto;
}

.security-versions-calendar text {
	fill: var(--prose-color-text);
	font-size: 16px; /* dependent on the native SVG coordinates */
}

.security-versions-calendar .labels text {
	fill: var(--prose-color-highlight);
	dominant-baseline: middle;
	text-anchor: middle;
}

.security-versions-calendar .status-end-of-life {
	fill: var(--color-red);
}

.security-versions-calendar .status-security-support {
	fill: var(--color-yellow);
}

.security-versions-calendar .status-active-support {
	fill: var(--color-green);
}

.security-versions-calendar .status-gradient {
	fill: url(#statusGradient);
}

.security-versions-calendar .year-marks line {
	stroke: var(--color-black);
}

.security-versions-calendar .year-marks text {
	text-anchor: middle;
}

.security-versions-calendar .today line {
	stroke: var(--color-black);
	stroke-dasharray: 10;
	stroke-width: 3px;
}

.security-versions-calendar .today text {
	fill: var(--prose-color-highlight);
	text-anchor: middle;
}
</style>

<div class="security-versions-table table">
	<table>
		<tr>
			<th style="width: 1px">Kirby Version</th>
			<th style="width: 1px">Supported</th>
			<th>Initial Release</th>
			<th>Feature Updates Until</th>
			<th>Security Updates Until</th>
		</tr>
		<?php foreach ($versions as $entry): ?>
		<tr>
			<td style="width: 1px"><?= esc($entry['shortName']) ?></td>
			<td class="symbol">
				<?= match ($entry['status']) {
					'active-support'   => '<span title="Actively supported">✅</span>',
					'security-support' => '<span title="Supported with security updates only">⚠️</span>',
					'end-of-life'      => '<span title="Version has reached its end of life">❌</span>',
					default            => '<span title="Unknown">❓️</span>'
				} ?>
			</td>
			<td><?= date('F j, Y', strtotime($entry['initialRelease'])) ?></td>
			<td>
				<?php if ($entry['endOfActiveSupport'] !== null): ?>
				<?= date('F j, Y', strtotime($entry['endOfActiveSupport'])) ?>
				<?php else: ?>
				<em>Next major release</em>
				<?php endif ?>
			</td>
			<td><?= date('F j, Y', strtotime($entry['endOfLife'])) ?></td>
		</tr>
		<?php endforeach ?>
	</table>
</div>

<div class="security-versions-calendar">
	<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 <?= $calendarWidth ?> <?= $calendarHeight + 30 ?>" width="<?= $calendarWidth ?>" height="<?= $calendarHeight + 30 ?>">
		<defs>
			<linearGradient id="statusGradient">
				<stop offset="0%" stop-color="var(--color-green)"/>
				<stop offset="100%" stop-color="var(--color-yellow)"/>
			</linearGradient>
		</defs>

		<g class="labels">
			<?php $i = 0; foreach ($filteredVersions as $version): ?>
			<rect class="status-<?= $version['status'] ?>" x="0" y="<?= 30 + $i * 30 ?>" width="46" height="30"/>
			<text x="23" y="<?= 45 + $i * 30 ?>"><?= $version['shortName'] ?></text>
			<?php $i++; endforeach ?>
		</g>

		<g class="versions">
			<?php $i = 0; foreach ($filteredVersions as $version): ?>
				<?php if ($version['endOfActiveSupport'] !== null): ?>
				<rect class="status-active-support" x="<?= $calendarPosition($version['initialRelease']) ?>" y="<?= 30 + $i * 30 ?>" width="<?= $calendarPosition($version['endOfActiveSupport']) - $calendarPosition($version['initialRelease']) ?>" height="30"/>
				<rect class="status-security-support" x="<?= $calendarPosition($version['endOfActiveSupport']) ?>" y="<?= 30 + $i * 30 ?>" width="<?= $calendarPosition($version['endOfLife']) - $calendarPosition($version['endOfActiveSupport']) ?>" height="30"/>
				<?php else: ?>
				<rect class="status-active-support" x="<?= $calendarPosition($version['initialRelease']) ?>" y="<?= 30 + $i * 30 ?>" width="<?= $calendarPosition() - $calendarPosition($version['initialRelease']) ?>" height="30"/>
				<rect class="status-gradient" x="<?= $calendarPosition() ?>" y="<?= 30 + $i * 30 ?>" width="<?= $calendarPosition($version['endOfLife']) - $calendarPosition() ?>" height="30"/>
				<?php endif ?>
			<?php $i++; endforeach ?>
		</g>

		<g class="year-marks">
			<?php foreach (new DatePeriod($minDate, new DateInterval('P1Y'), $maxDate, DatePeriod::INCLUDE_END_DATE) as $year): ?>
				<line x1="<?= $calendarPosition($year) ?>" y1="30" x2="<?= $calendarPosition($year) ?>" y2="<?= $calendarHeight ?>"/>
				<text x="<?= $calendarPosition($year) ?>" y="20"><?= $calendarText($year) ?></text>
			<?php endforeach ?>
		</g>

		<g class="today">
			<line x1="<?= $calendarPosition() ?>" y1="30" x2="<?= $calendarPosition() ?>" y2="<?= $calendarHeight ?>"/>
			<text x="<?= $calendarPosition() ?>" y="<?= $calendarHeight + 20 ?>">Today: <?= $calendarText() ?></text>
		</g>
	</svg>
</div>

<div class="security-versions-table table">
	<table>
		<tr>
			<td class="status-active-support symbol">✅</td>
			<td>This marks the major release with <strong>active support</strong>. This release receives functionality updates, improvements and bug fixes.</td>
		</tr>
		<tr>
			<td class="status-security-support symbol">⚠️</td>
			<td>Releases with this symbol <em>only</em> receive <strong>security updates</strong>. <a href="<?= url('license#technical-support') ?>">Read more ›</a></td>
		</tr>
		<tr>
			<td class="status-end-of-life symbol">❌</td>
			<td>Releases with this symbol have reached their <strong>end of life</strong> and should <em>not</em> be used in production any longer. <a href="<?= url('security/end-of-life') ?>">Read more ›</a></td>
		</tr>
	</table>
</div>
