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
	  <th>Kirby Version</th>
	  <th>Supported</th>
	  <th class="w-100%">Support Status</th>
	</tr>
	<?php foreach ($supported as $entry): ?>
	<tr>
	  <td><?= $entry->version()->escape() ?></td>
	  <td><?= $entry->supported()->isTrue() ? '✅' : '❌' ?></td>
	  <td class="w-100%"><?= $entry->description() ?></td>
	</tr>
	<?php endforeach ?>
  </table>
</div>
