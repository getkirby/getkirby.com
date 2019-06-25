<table class="properties">
  <thead>
    <tr>
      <th>Property</th>
      <th>Type</th>
      <th>Default</th>
      <th>Description</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($rows as $row): ?>
    <tr>
      <td><code><?= $row['prop'] ?></code><?= formatRequired($row['required']) ?></td>
      <td><?= formatDatatype($row['type'] ?? null) ?></td><?php /* <code class="code-<?= $row['type'] ? strip_tags($row['type']) :  'default' ?>"><?= $row['type'] ?? 'mixed' ?></code> */ ?>
      <td data-property-label="Default:"><?= formatDefault($row['default'] ?? null) ?></td>
      <td class="text"><?= kti($row['comment']) ?></td>
    </tr>
    <?php endforeach ?>
  </tbody>
</table>

