<style>
.security-versions.table table {
	min-width: 36rem;
}
.security-versions td,
.security-versions th {
	font-size: var(--text-sm);
}
.security-versions td:nth-child(2) {
	text-align: center;
}
</style>

<div class="security-versions table">
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
			<td style="width: 1px">
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
