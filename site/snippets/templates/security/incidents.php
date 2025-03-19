<style>
.security-incidents.table table {
	min-width: 36rem;
}
.security-incidents td,
.security-incidents th {
	font-size: var(--text-sm);
}
.security-incidents .column-fixed * {
	white-space: nowrap;
}
</style>

<div class="table security-incidents">
	<table>
		<tr>
			<th>Affected</th>
			<th class="w-100%">Description</th>
			<th>Severity</th>
			<th>CVE ID</th>
			<th>Fixed in</th>
		</tr>
		<?php foreach ($incidents as $incident): ?>
		<tr>
			<td class="column-fixed">
				<span>
					<?= str_replace(
						['||', ' - '],
						['</span><br><span>', '&nbsp;-&nbsp;'],
						Str::esc($incident['affected'])
					) ?>
				</span>
			</td>
			<td>
				<?= markdown($incident['description'], ['inline' => true]) ?>

				<?php if (empty($incident['link']) === false): ?>
				<a class="whitespace-nowrap" href="<?= $incident['link'] ?>">Read more ›</a>
				<?php endif ?>
			</td>
			<td class="whitespace-nowrap">
				<?php if (empty($incident['cvss']) === false): ?>
				<a href="https://www.first.org/cvss/calculator/3.1#<?= $incident['cvss'] ?>"><?= $incident['severity'] ?></a>
				<?php else: ?>
				<?= $incident['severity'] ?>
				<?php endif ?>
			</td>
			<td class="whitespace-nowrap">
				<?php if (empty($incident['cve']) === false): ?>
				<a href="https://nvd.nist.gov/vuln/detail/<?= $incident['cve'] ?>"><?= $incident['cve'] ?></a>
				<?php else: ?>
				CVE ID pending
				<?php endif ?>
			</td>
			<td class="column-fixed">
				<?php foreach (Str::split($incident['fixed']) as $version): ?>
				<?php $major = Str::before($version, '.');
					$majorOrg = $major < 3 ? '-v' . $major : '' ?>
				<a href="https://github.com/getkirby<?= $majorOrg ?>/kirby/releases/tag/<?= $version ?>">
					<?= $version ?>
				</a>
				<?php endforeach ?>
			</td>
		</tr>
		<?php endforeach ?>
	</table>
</div>
