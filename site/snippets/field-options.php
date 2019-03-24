<table>
  <tr>
    <th>Property</th>
    <th>Type</th>
    <th>Required</th>
    <th>Default</th>
    <th style="width: 33.33%">Description</th>
  </tr>
  <?php foreach ($rows as $row): ?>
  <tr>
    <td><code><?= $row['prop'] ?></code></td>
    <td><code><?= $row['type'] ?? 'mixed' ?></code></td>
    <td><code><?= $row['required'] ? 'required' : '' ?></code></td>
    <td><code><?= $row['default'] ?? '' ?></code></td>
    <td style="width: 33.33%"><?= $row['comment'] ?></td>
  </tr>
  <?php endforeach ?>
</table>
