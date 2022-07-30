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
        <?= $message->content()->get('kirby')->escape() ?>
      </td>
      <td>
        <?= $message->php()->escape() ?>
      </td>
      <td>
        <?= $message->text() ?>

        <?php if ($message->link()->isNotEmpty()): ?>
        <a class="whitespace-nowrap" href="<?= $message->link() ?>">Read more ›</a>
        <?php endif ?>
      </td>
    </tr>
    <?php endforeach ?>
  </table>
</div>
