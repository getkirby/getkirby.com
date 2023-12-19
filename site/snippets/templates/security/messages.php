<style>
.security-messages.table table {
	min-width: 36rem;
}
.security-messages td,
.security-messages th {
	font-size: var(--text-sm);
}
</style>

<div class="table security-messages">
	<table>
		<tr>
			<th>Kirby Version</th>
			<th>PHP Version</th>
			<th class="w-100%">Text</th>
		</tr>
		<?php foreach ($messages as $message): ?>
		<tr>
			<td>
				<?= Str::escape($message['content']['kirby']) ?>
			</td>
			<td>
				<?= Str::escape($message['php']) ?>
			</td>
			<td>
				<?= $message['text'] ?>

				<?php if (empty($message['link']) === false): ?>
				<a class="whitespace-nowrap" href="<?= $message['link'] ?>">Read more ›</a>
				<?php endif ?>
			</td>
		</tr>
		<?php endforeach ?>
	</table>
</div>
